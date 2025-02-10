<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class UnreadMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public int $reciverId, public int $senderId, public int $unreadMessageCount) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('unread-message-channel.'.$this->reciverId),
        ];
    }

    /**
     * brodcast with
     *
     * @return array<string, int>
     */
    public function brodcastsWith(): array
    {
        return [
            'senderId' => $this->senderId,
            'reciverId' => $this->reciverId,
            'unreadMessageCount' => $this->unreadMessageCount,
        ];
    }
}
