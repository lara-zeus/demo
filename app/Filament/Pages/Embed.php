<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Forms\Components\View;
use Filament\Pages\Page;
use Filament\Actions\Action;

class Embed extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'tabler-chart-donut-4';

    protected static string $view = 'filament.pages.embed';

    protected static ?int $navigationSort = 7;

    public array $data;

    public string $qrcode;

    public function openAction(): Action
    {
        return Action::make('open')
            ->label('create a ticket')
            ->icon('tabler-chart-donut-4')
            ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->form([
                View::make('bolt')
                    ->columnSpanFull()
                    ->view('filament.pages.bolt')
            ])
            ->action(fn()=>dd('ya we heard that issue a million time'));
    }

    public static function getNavigationLabel(): string
    {
        return 'Embed Bolt';
    }

    public function getTitle(): string
    {
        return 'Embed Bolt with Thunder';
    }
}
