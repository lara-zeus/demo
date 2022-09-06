<?php

namespace App\Filament\Pages\Auth;

use Filament\Http\Livewire\Auth\Login as BasePage;

class Login extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'info@larazeus.com',
            'password' => 'zeus#larazeus',
            'remember' => true,
        ]);
    }
}
