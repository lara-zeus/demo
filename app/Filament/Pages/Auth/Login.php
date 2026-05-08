<?php

namespace App\Filament\Pages\Auth;

class Login extends \Filament\Auth\Pages\Login
{
    // use HasCustomLayout;

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
