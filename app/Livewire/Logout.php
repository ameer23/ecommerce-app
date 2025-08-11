<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return $this->redirect('/');
    }

    public function render()
    {
        return <<<'HTML'
            <button wire:click="logout" class="text-gray-600 hover:text-black">
                Log Out
            </button>
        HTML;
    }
}