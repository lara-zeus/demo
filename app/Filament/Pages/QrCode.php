<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;
use LaraZeus\Qr\Components\Qr;

class QrCode extends Page
{
    protected static ?string $navigationIcon = 'heroicon-m-qr-code';

    protected static string $view = 'filament.pages.qrcode';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'App';

    public array $data;

    public string $qrcode;

    public static function getNavigationLabel(): string
    {
        return 'QR maker';
    }

    public function getTitle(): string
    {
        return 'QR maker (Demo)';
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()
                    ->schema([
                        Qr::make('qr-code')
                            ->actionIcon('heroicon-o-adjustments-vertical')
                            ->asSlideOver()
                            ->optionsColumn('options'),
                    ]),
            ]);
    }
}
