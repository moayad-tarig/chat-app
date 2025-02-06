<?php

declare(strict_types=1);

use App\Models\Message;

it('Can Create Message', function () {
    $message = Message::factory()->create();
    expect($message->id)->toBe(1);
});

it('Messgae have keys ', function () {
    $keys = ['sender_id', 'receiver_id', 'message', 'is_read', 'file_name', 'file_name_original', 'file_path', 'file_type'];
    $message = Message::factory()->make()->toArray();
    expect(array_keys($message))->toBe($keys);
});

it('Message have sender relation', function () {
    $message = Message::factory()->make();
    expect($message->sender())->toBeInstanceOf(Illuminate\Database\Eloquent\Relations\BelongsTo::class);
});

it('Message have receiver relation', function () {
    $message = Message::factory()->make();
    expect($message->receiver())->toBeInstanceOf(Illuminate\Database\Eloquent\Relations\BelongsTo::class);
});
