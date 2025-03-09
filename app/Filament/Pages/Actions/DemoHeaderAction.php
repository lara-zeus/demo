<?php

namespace App\Filament\Pages\Actions;

use Filament\Actions\Action;
use Livewire\Component;

class DemoHeaderAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'demo-code';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->icon('tabler-code')
            ->badge()
            ->tooltip('check the code of this page on github')
            ->color('info')
            ->url(
                function (Component $livewire) {
                    return 'https://github.com/lara-zeus/demo/blob/v3/app/Filament/Pages/'
                        . str(
                            str($livewire->getRouteName())
                                ->explode('.')
                                ->last()
                        )->studly()->toString() . '.php';
                },
                shouldOpenInNewTab: true
            );
    }
}
