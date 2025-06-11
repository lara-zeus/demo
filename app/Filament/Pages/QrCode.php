<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use LaraZeus\Qr\Components\Qr;

class QrCode extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-m-qr-code';

    protected string $view = 'filament.pages.qrcode';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    protected static ?string $navigationLabel = 'QR maker';

    protected static ?string $title = 'QR maker';

    public string $qrcode;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->heading('Use it as a direct form')
                    ->schema([
                        ...\LaraZeus\Qr\Facades\Qr::getFormSchema('text', 'text-options'),
                    ]),

                \Filament\Schemas\Components\Section::make()
                    ->heading('Use it as an action')
                    ->schema([
                        Qr::make('qr-code')
                            ->actionIcon('heroicon-o-adjustments-vertical')
                            ->asSlideOver()
                            ->optionsColumn(),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
