<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Events\ChatTypingEvent;
use App\Events\MessageSentEvent;
use App\Events\UnreadMessageEvent;
use App\Livewire\Action\Message\MarkAsReadAction;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

final class Chat extends Component
{
    public User $receiver;

    /**
     * @var Collection<int, Message>|null
     */
    public ?Collection $messages = null;

    public ?string $message = '';

    public int $receiverId;

    public int $senderId;

    public bool $isTyping = false;

    private ?MarkAsReadAction $markAsReadAction = null;

    /**
     * Mount the component with the receiver, messages, and sender id.
     *
     * @param  Collection<int , Message>  $messages
     */
    public function mount(int $receiver_id, Collection $messages, int $sender_id): void
    {
        $this->markAsReadAction = new MarkAsReadAction();
        $this->receiver = User::find($receiver_id);
        $this->senderId = $sender_id;
        $this->receiverId = $receiver_id;
        $this->messages = $messages;
        $this->markAsReadAction->handle($messages, $this->senderId, $this->receiverId);
    }

    /**
     * Listen to the message sent event.
     *
     * @param  array{message: array{id : int}}  $event
     */
    #[On('echo-private:chat-channel.{senderId},MessageSentEvent')]
    public function listenMessage(array $event): void
    {
        $newMessage = Message::find($event['message']['id'])->load('sender:id,name', 'receiver:id,name');
        $this->messages[] = $newMessage;
    }

    public function saveMessage(): Message
    {
        return Message::create([
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
        ]);
    }

    public function userTyping(): void
    {
        broadcast(new ChatTypingEvent($this->receiverId))->toOthers();
    }

    public function sendMessage(): void
    {
        $sentMessage = $this->saveMessage();
        $this->messages[] = $sentMessage;
        $this->message = null;
        $this->unreadMessage();
        broadcast(new MessageSentEvent($sentMessage))->toOthers();
    }

    public function unreadMessage(): void
    {
        $meesageUnReadCount = $this->getUnreadMessageCount();
        broadcast(new UnreadMessageEvent($this->receiverId, $this->senderId, $meesageUnReadCount))->toOthers();
    }

    public function getUnreadMessageCount(): int
    {
        return Message::where('receiver_id', $this->receiverId)->where('sender_id', $this->senderId)->where('is_read', false)->count();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {

        return view('livewire.chat');
    }
}
