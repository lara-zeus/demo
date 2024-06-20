<?php

namespace App\Livewire;

use Livewire\Component;

class UserCard extends Component
{
    public $record;

    public function render()
    {
        return view('livewire.user-card');
    }
}
