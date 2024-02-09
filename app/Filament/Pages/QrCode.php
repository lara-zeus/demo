<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;
use LaraZeus\Qr\Components\Qr;

class QrCode extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'heroicon-m-qr-code';

    protected static string $view = 'filament.pages.qrcode';

    protected static ?int $navigationSort = 2;

    public ?array $data;

    public string $qrcode;

    public function mount(): void
    {
        $this->form->fill();
    }

    public static function getNavigationLabel(): string
    {
        return 'QR maker';
    }

    public function getTitle(): string
    {
        return 'QR maker';
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()
                    ->schema([
                        Placeholder::make('')->content('Use it as a direct form'),
                        ...\LaraZeus\Qr\Facades\Qr::getFormSchema('text', 'text-options'),

                        Placeholder::make('')->content('Use it as an action'),
                        Qr::make('qr-code')
                            ->actionIcon('heroicon-o-adjustments-vertical')
                            ->asSlideOver()
                            ->optionsColumn('options'),
                    ]),
            ]);
    }
}
