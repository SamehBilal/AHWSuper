<?php

namespace Modules\Developers\Services;

use Modules\Developers\Models\AppTester;
use Modules\Developers\Models\App;
use Modules\Developers\Emails\AppTesterInvitation;
use Modules\Developers\Notifications\TesterStatusChanged;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TesterService
{
    public function inviteTester(App $app, User $invitedBy, string $email, ?string $message = null): AppTester
    {
        $user = User::where('email', $email)->firstOrFail();

        if (!$user->email_verified_at) {
            throw new \Exception('The invited user must have a verified email address.');
        }

        if (!$app->canAddMoreTesters()) {
            throw new \Exception('Maximum number of testers reached.');
        }

        // Check if already invited
        if ($app->testers()->where('user_id', $user->id)->exists()) {
            throw new \Exception('This user has already been invited.');
        }

        $tester = $app->testers()->create([
            'user_id' => $user->id,
            'invited_by' => $invitedBy->id,
            'email' => $email,
            'message' => $message,
            'invitation_token' => Str::random(40),
        ]);

        Mail::to($email)->send(new AppTesterInvitation($tester, $app));

        return $tester;
    }

    public function acceptInvitation(string $token, User $user): AppTester
    {
        $tester = AppTester::where('invitation_token', $token)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $tester->accept();

        // Notify app owner
        $tester->invitedBy->notify(new TesterStatusChanged($tester, 'accepted'));

        return $tester;
    }

    public function rejectInvitation(string $token, User $user): AppTester
    {
        $tester = AppTester::where('invitation_token', $token)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $tester->reject();

        // Notify app owner
        $tester->invitedBy->notify(new TesterStatusChanged($tester, 'rejected'));

        return $tester;
    }

    public function removeTester(AppTester $tester): bool
    {
        return $tester->delete();
    }

    public function resendInvitation(AppTester $tester): void
    {
        if ($tester->status !== 'pending') {
            throw new \Exception('Can only resend pending invitations.');
        }

        Mail::to($tester->email)->send(new AppTesterInvitation($tester, $tester->app));
    }
}
