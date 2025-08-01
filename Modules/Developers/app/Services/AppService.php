<?php

namespace Modules\Developers\Services;

use App\Models\User;
use Modules\Developers\Models\ApiKey;
use Modules\Developers\Models\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AppService
{
     public function createApp(User $developer, array $data): App
    {
        return DB::transaction(function () use ($developer, $data) {
            $data['developer_id'] = $developer->id;
            $data['slug'] = Str::slug($data['name']) . '-' . Str::random(8);
            $data['status'] = 'pending';

            $app = App::create($data);

            // Create default API key
            ApiKey::create([
                'app_id' => $app->id,
                'name' => 'Default API Key',
                'rate_limit' => 1000,
            ]);

            return $app;
        });
    }

    public function approveApp(App $app): App
    {
        $app->update(['status' => 'approved']);
        $app->createOAuthClient();

        // Send approval notification
        // event(new AppApproved($app));

        return $app;
    }

    public function suspendApp(App $app, string $reason = null): App
    {
        $app->update(['status' => 'suspended']);

        // Revoke OAuth client if exists
        if ($app->oauthClient) {
            $app->oauthClient->update(['revoked' => true]);
        }

        return $app;
    }

    public function getAppStats(App $app): array
    {
        return [
            'total_users' => $app->analytics()->distinct('user_id')->count(),
            'total_requests' => $app->analytics()->sum('requests_count'),
            'monthly_active_users' => $app->analytics()
                ->where('created_at', '>=', now()->subMonth())
                ->distinct('user_id')
                ->count(),
        ];
    }

    public function getAppAnalytics(App $app, string $period = '30d'): array
    {
        $startDate = match($period) {
            '7d' => now()->subDays(7),
            '30d' => now()->subDays(30),
            '90d' => now()->subDays(90),
            default => now()->subDays(30)
        };

        return [
            'total_requests' => $app->analytics()
                ->where('created_at', '>=', $startDate)
                ->count(),
            'unique_users' => $app->analytics()
                ->where('created_at', '>=', $startDate)
                ->distinct('user_id')
                ->count('user_id'),
            'average_response_time' => $app->analytics()
                ->where('created_at', '>=', $startDate)
                ->avg('response_time_ms'),
            'error_rate' => $app->analytics()
                ->where('created_at', '>=', $startDate)
                ->where('status_code', '>=', 400)
                ->count() / max($app->analytics()->where('created_at', '>=', $startDate)->count(), 1) * 100,
            'daily_requests' => $app->analytics()
                ->where('created_at', '>=', $startDate)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as requests')
                ->groupBy('date')
                ->orderBy('date')
                ->get()
        ];
    }
}
