<?php

declare(strict_types=1);

namespace App\Actions\Message;

use App\Models\Message;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final readonly class RetriveMessage
{
    /**
     * @return ?Collection<int ,Message>
     */
    public function handle(int $sender_id, int $receiver_id): ?Collection
    {
        return Message::query()->with('sender:id,name', 'receiver:id,name')->where(function (Builder $query) use ($sender_id, $receiver_id): void {
            $query->where('sender_id', $sender_id)
                ->where('receiver_id', $receiver_id);
        })->orWhere(function (Builder $query) use ($sender_id, $receiver_id): void {
            $query->where('sender_id', $receiver_id)
                ->where('receiver_id', $sender_id);
        })->get();
    }
}
