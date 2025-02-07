<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Events\MessageSentEvent;
use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

final class Chat extends Component
{
    public $receiver;

    public $messages = [];

    public $message = '';

    public $receiverId;

    public $senderId;

    public function mount($receiver_id, $messages, $sender_id): void
    {
        // dd($messages);
        $this->receiver = User::find($receiver_id);
        $this->senderId = $sender_id;
        $this->receiverId = $receiver_id;
        $this->messages = $messages;
    }

    public function sendMessage(): void
    {
        $sentMessage = $this->saveMessage();
        $this->messages[] = $sentMessage;
        $this->message = null;
        // dd($this->message);
        broadcast(new MessageSentEvent($sentMessage))->toOthers();

    }

    #[On('echo-private:chat-channel.{senderId},MessageSentEvent')]
    public function listenMessage(array $event): void
    {
        // Convert the event message array into an Eloquent model with relationships
        $newMessage = Message::find($event['message']['id'])->load('sender:id,name', 'receiver:id,name');

        $this->messages[] = $newMessage;
    }

    public function saveMessage()
    {
        return Message::create([
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
        ]);

    }

    public function render()
    {
        return view('livewire.chat');
    }
}
