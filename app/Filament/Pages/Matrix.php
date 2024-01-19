<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;

class Matrix extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'carbon-scatter-matrix';

    protected static string $view = 'filament.pages.qrcode';

    protected static ?int $navigationSort = 1;

    public array $data;

    public string $qrcode;

    public static function getNavigationLabel(): string
    {
        return 'Matrix Grid';
    }

    public function getTitle(): string
    {
        return 'Matrix Grid';
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
                            ]),

                        \LaraZeus\MatrixChoice\Components\Matrix::make('question')
                            ->label('Tell us about your mod')
                            ->asRadio()
                            ->columnData([
                                '🙂',
                                '😐',
                                '🙁',
                            ])
                            ->rowData([
                                'Saturday',
                                'Sunday',
                                'Monday',
                            ]),
                    ]),
            ]);
    }
}
