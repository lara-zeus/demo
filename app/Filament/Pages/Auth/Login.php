<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
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
