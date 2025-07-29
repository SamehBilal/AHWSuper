<?php

namespace Modules\Developers\Services;

use App\Models\User;
use Modules\Developers\Models\App;
use Illuminate\Support\Str;

class AppService
{
    public function createApp(User $developer, array $data): App
    {
        $data['developer_id'] = $developer->id;
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(8);
        $data['status'] = 'pending';

        return App::create($data);
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
}