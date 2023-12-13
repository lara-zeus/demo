<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;

class Matrix extends Page
{
    protected static ?string $navigationIcon = 'heroicon-m-qr-code';

    protected static string $view = 'filament.pages.qrcode';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'App';

    public array $data;

    public string $qrcode;

    public static function getNavigationLabel(): string
    {
        return 'Matrix Grid';
    }

    public function getTitle(): string
    {
        return 'Matrix Grid (Demo)';
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()
                    ->schema([
                        \LaraZeus\MatrixChoice\Components\Matrix::make('question')
                            ->label('Tell us about your mod')
                            ->asRadio()
                            // or
                            ->asCheckbox()
                            ->columnData([
                                '🙂',
                                '😐',
                                '🙁',
                            ])
                            ->rowData([
                                'Saturday',
                                'Sunday',
                                'Monday',
                            ])

                            //set the row selection optional
                            ->rowSelectRequired(false)
                        ,
                    ]),
            ]);
    }
}
