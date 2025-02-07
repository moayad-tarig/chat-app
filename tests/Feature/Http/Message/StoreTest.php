<?php

declare(strict_types=1);

use App\Models\Message;
use App\Models\User;

use function Pest\Laravel\post;

it('test can send message ', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    $this->actingAs($sender);

    $response = post('/messages', [
        'receiver_id' => $receiver->id,
        'message' => 'Hello',
    ]);

    $this->expect($response->status())->toBe(302);
    $this->expect(Message::count())->toBe(1);

});
