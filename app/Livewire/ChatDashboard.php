<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

final class ChatDashboard extends Component
{
    /**
     * @var Collection<int , User>|null
     */
    public ?Collection $users = null;

    public function mount(): void
    {
        $this->users = User::where('id', '!=', auth()->id())->get();

    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('livewire.chat-dashboard');
    }
}
