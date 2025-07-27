<?php

namespace Modules\Developers\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Modules\Developers\Models\AppTester;
use Modules\Developers\Models\Client as OAuthApp;
use Modules\Developers\Services\TesterService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TesterApiController extends Controller
{
    public function __construct(
        private TesterService $testerService
    ) {}

    public function index(OAuthApp $app): JsonResponse
    {
        $this->authorize('view', $app);

        $testers = $app->testers()->with(['user', 'invitedBy'])->get();

        return response()->json([
            'testers' => $testers,
            'count' => $testers->count(),
            'max_testers' => 50,
            'remaining_slots' => 50 - $testers->count(),
        ]);
    }

    public function store(Request $request, OAuthApp $app): JsonResponse
    {
        $this->authorize('update', $app);

        $request->validate([
            'email' => 'required|email',
            'message' => 'nullable|string|max:500',
        ]);

        try {
            $tester = $this->testerService->inviteTester(
                $app,
                $request->user(),
                $request->email,
                $request->message
            );

            return response()->json([
                'message' => 'Invitation sent successfully',
                'tester' => $tester->load(['user', 'invitedBy']),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy(OAuthApp $app, AppTester $tester): JsonResponse
    {
        $this->authorize('update', $app);

        if ($tester->oauth_app_id !== $app->id) {
            return response()->json(['message' => 'Tester not found'], 404);
        }

        $this->testerService->removeTester($tester);

        return response()->json([
            'message' => 'Tester removed successfully',
        ]);
    }

    public function resend(OAuthApp $app, AppTester $tester): JsonResponse
    {
        $this->authorize('update', $app);

        try {
            $this->testerService->resendInvitation($tester);

            return response()->json([
                'message' => 'Invitation resent successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function accept(Request $request, string $token): JsonResponse
    {
        try {
            $tester = $this->testerService->acceptInvitation($token, $request->user());

            return response()->json([
                'message' => 'Invitation accepted successfully',
                'tester' => $tester->load(['oauthApp', 'user']),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function reject(Request $request, string $token): JsonResponse
    {
        try {
            $tester = $this->testerService->rejectInvitation($token, $request->user());

            return response()->json([
                'message' => 'Invitation rejected successfully',
                'tester' => $tester->load(['oauthApp', 'user']),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
