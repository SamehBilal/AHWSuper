<?php

namespace Modules\Developers\Policies;

use Modules\Developers\Models\Client as OAuthApp;
use App\Models\User;

class ClientPolicy
{
    public function view(User $user, OAuthApp $app): bool
    {
        return $user->id === $app->user_id ||
               $app->testers()->where('user_id', $user->id)->where('status', 'accepted')->exists();
    }

    public function update(User $user, OAuthApp $app): bool
    {
        return $user->id === $app->user_id;
    }

    public function delete(User $user, OAuthApp $app): bool
    {
        return $user->id === $app->user_id;
    }

    public function manageTester(User $user, OAuthApp $app): bool
    {
        return $user->id === $app->user_id;
    }
}
