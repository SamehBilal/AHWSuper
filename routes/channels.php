<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('users.{id}', function ($user, $id) {
    return auth()->check() && (int) $user->id === (int) $id;
});

Broadcast::channel('Live-Updates', function () {
    return true; // Public channel
});

/* Broadcast::routes(['middleware' => ['auth']]); */