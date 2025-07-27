<?php

namespace Modules\Developers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Developers\Models\AppTester;
use Illuminate\Support\Facades\Auth;

class AppTesterController extends Controller
{
    public function accept(string $token)
    {
        $tester = AppTester::where('invitation_token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        // Check if the current user is the invited user
        if (!Auth::check() || Auth::id() !== $tester->user_id) {
            return redirect()->route('login')->with('message',
                'Please log in with the invited account to accept this invitation.');
        }

        $tester->accept();

        return redirect()->route('developer.dashboard')->with('success',
            "You've successfully joined as a tester for {$tester->oauthApp->name}!");
    }

    public function reject(string $token)
    {
        $tester = AppTester::where('invitation_token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        // Check if the current user is the invited user
        if (!Auth::check() || Auth::id() !== $tester->user_id) {
            return redirect()->route('login')->with('message',
                'Please log in with the invited account to manage this invitation.');
        }

        $tester->reject();

        return redirect()->route('developer.dashboard')->with('info',
            'You have declined the testing invitation.');
    }

    public function show(string $token)
    {
        $tester = AppTester::with(['oauthApp', 'invitedBy'])
            ->where('invitation_token', $token)
            ->firstOrFail();

        if ($tester->status !== 'pending') {
            return redirect()->route('developer.dashboard')->with('info',
                'This invitation has already been ' . $tester->status . '.');
        }

        return view('developers::app-tester.show', compact('tester'));
    }
}
