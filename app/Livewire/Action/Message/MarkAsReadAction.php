<?php

declare(strict_types=1);

namespace App\Livewire\Action\Message;

use App\Events\UnreadMessageEvent;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

final class MarkAsReadAction
{
    /**
     * Mark Messages Collection As Read and emit unread message event
     *
     * @param  Collection<int , Message>  $messages
     * @param  int  $receiverId
     * @param  int  $senderId
     * @return Collection<int , Message>
     */
    public function handle(Collection $messages, $receiverId, $senderId): Collection
    {
        $messagesUpdated = $messages->each(function (Message $message): void {
            if (! $message->is_read) {
                $message->is_read = true;
                $message->save();
            }
        });
        broadcast(new UnreadMessageEvent($receiverId, $senderId, 0))->toOthers();

        return $messagesUpdated;
    }
}
