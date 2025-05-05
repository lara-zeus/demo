<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Actions\Action;
use Filament\Pages\Page;
use BackedEnum;
use Filament\Schemas\Components\View;

class Embed extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | BackedEnum | null $navigationIcon = 'tabler-chart-donut-4';

    protected string $view = 'filament.pages.embed';

    protected static ?int $navigationSort = 7;

    public function openAction(): Action
    {
        return Action::make('open')
            ->label('create a ticket')
            ->icon('tabler-chart-donut-4')
            ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->schema([
                View::make('bolt')
                    ->columnSpanFull()
                    ->view('filament.pages.bolt'),
            ])
            ->action(fn () => dd('ya we heard that issue a million time'));
    }

    public function getTitle(): string
    {
        return 'Embed Bolt with Thunder';
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
