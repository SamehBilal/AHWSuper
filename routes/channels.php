<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::routes(['middleware' => ['auth:api']]);

Broadcast::channel('users.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Live-Updates', function () {
    return true;
});
