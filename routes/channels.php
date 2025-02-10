<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-channel.{reciverId}', function (User $user, $reciverId) {
    return (int) $user->id === (int) $reciverId;
});

Broadcast::channel('unread-message-channel.{reciverId}', function (User $user, $reciverId) {
    return (int) $user->id === (int) $reciverId;
});
Broadcast::channel('typing-channel.{senderId}', function (User $user, $senderId) {
    return (int) $user->id === (int) $senderId;
});
