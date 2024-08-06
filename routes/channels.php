<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function(){
    return true;
});

Broadcast::channel('room', function (User $user) {
    return $user->only('id', 'name');
});
