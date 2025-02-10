<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Message;
use App\Models\User;

it('user have keys ', function () {
    $arrayKeys = ['name', 'email', 'email_verified_at', 'updated_at', 'created_at', 'id'];
    $user = User::factory()->create()->toArray();
    expect(array_keys($user))->toBe($arrayKeys);
});

it('have count of 0 unread messages ', function () {
    $user = User::factory()->create();
    expect($user->unreadMessages())->toBe(0);
});

it('have a couple of unread messages ', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    $message = Message::factory()->create([
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'message' => 'Hello',
        'is_read' => false,
    ]);
    expect($receiver->unreadMessages())->toBe(1);
});

it('have a unread message from one sender', function () {
    $sender1 = User::factory()->create();
    $sender2 = User::factory()->create();
    $receiver = User::factory()->create();
    $messageFromSender1 = Message::factory()->create([
        'sender_id' => $sender1->id,
        'receiver_id' => $receiver->id,
        'message' => 'Hello',
        'is_read' => false,
    ]);
    $messageFromSender1 = Message::factory()->create([
        'sender_id' => $sender2->id,
        'receiver_id' => $receiver->id,
        'message' => 'Hello',
        'is_read' => false,
    ]);
    $messages = Message::where('receiver_id', $receiver->id)->where('sender_id', $sender1->id)->where(
        'is_read', false)->get();

    expect($messages->count())->toBe(1);
});
