<?php

namespace Modules\Developers\Policies;

use Modules\Developers\Models\App;
use App\Models\User;

class AppPolicy
{
    public function view(User $user, App $app): bool
    {
        return $user->id === $app->developer_id;
    }

    public function update(User $user, App $app): bool
    {
        return $user->id === $app->developer_id;
    }

    public function delete(User $user, App $app): bool
    {
        return $user->id === $app->developer_id;
    }
}
