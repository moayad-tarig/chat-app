<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

final class ChatDashboard extends Component
{
    public $users;

    public function mount(): void
    {
        $this->users = User::where('id', '!=', auth()->id())->get();

    }

    public function render()
    {
        return view('livewire.chat-dashboard');
    }
}
