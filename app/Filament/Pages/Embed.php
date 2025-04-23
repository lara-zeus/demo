<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Actions\Action;
use Filament\Forms\Components\View;
use Filament\Pages\Page;

class Embed extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | \BackedEnum | null $navigationIcon = 'tabler-chart-donut-4';

    protected string $view = 'filament.pages.embed';

    protected static ?int $navigationSort = 7;

    public string $qrcode;

    public function openAction(): Action
    {
        return Action::make('open')
            ->label('create a ticket')
            ->icon('tabler-chart-donut-4')
            ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->schema([
                \Filament\Schemas\Components\View::make('bolt')
                    ->columnSpanFull()
                    ->view('filament.pages.bolt'),
            ])
            ->action(fn () => dd('ya we heard that issue a million time'));
    }

    public ?array $data = [];

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
