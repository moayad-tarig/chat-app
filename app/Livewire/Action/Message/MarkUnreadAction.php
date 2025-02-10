<?php

declare(strict_types=1);

namespace App\Livewire\Action\Message;

use App\Models\Message;

final class MarkUnreadAction
{
    public function handle(int $SenderId, int $receiver_id): void
    {
        Message::where('sender_id', $SenderId)->where('receiver_id', $receiver_id)->update(['is_read' => false]);
    }
}
