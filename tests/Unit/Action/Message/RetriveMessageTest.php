<?php

declare(strict_types=1);

namespace Tests\Unit\Action\Message;

use App\Actions\Message\RetriveMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * @covers \App\Actions\Message\RetriveMessage
 */
it('should return collection when messages exist', function () {
    $message = Message::factory()->create();

    $messageAction = new RetriveMessage();
    $messages = $messageAction->handle($message->sender->id, $message->receiver->id);

    $this->expect($messages)->toBeInstanceOf(Collection::class);
    $this->expect($messages)->not->toBeEmpty();
});

it('should return an empty collection when no messages exist', function () {
    $sender_id = User::factory()->create()->id;
    $receiver_id = User::factory()->create()->id;

    $messageAction = new RetriveMessage();
    $messages = $messageAction->handle($sender_id, $receiver_id);

    $this->expect($messages)->toBeInstanceOf(Collection::class);
    $this->expect($messages)->toBeEmpty();
});

it('returns a same message when sender and receiver are swapped', function () {
    $message = Message::factory()->create();

    $messageAction = new RetriveMessage();
    $messagesfromSender = $messageAction->handle($message->sender_id, $message->receiver_id);
    $messagesfromReceiver = $messageAction->handle($message->receiver_id, $message->sender_id);
    $this->expect($messagesfromSender->first()->id)->toBe($messagesfromReceiver->first()->id);
});
