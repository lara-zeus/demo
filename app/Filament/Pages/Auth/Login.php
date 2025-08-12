<?php

namespace App\Filament\Pages\Auth;

use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;

class Login extends \Filament\Auth\Pages\Login
{
    //use HasCustomLayout; // todo

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
