<?php

declare(strict_types=1);

namespace App\Actions\Message;

use App\Models\Message;

final readonly class CreateMessage
{
    /**
     * Create a new message.
     */
    public function handle(int $sender_id, int $receiver_id, string $message): Message
    {
        return Message::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message,
        ]);
    }
}
