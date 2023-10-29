<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Page;
use Filament\Forms\Components\Wizard as WizardField;

class Wizard extends Page
{
    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.wizard';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            WizardField::make([
                WizardField\Step::make('Lang')
                    ->id('lang-step')
                    ->live()
                    ->schema([
                        Select::make('lang')
                            ->live()
                            ->options([
                                'en' => 'en',
                                'es' => 'es',
                            ])
                    ]),
                WizardField\Step::make('details En')
                    ->id('lang-en')
                    ->live()
                    ->visible(function (Get $get) {
                        return $get('lang') === 'en';
                    })
                    ->schema([
                        TextInput::make('nameEn')
                    ]),
                WizardField\Step::make('details Es')
                    ->id('lang-es')
                    ->live()
                    ->visible(function (Get $get) {
                        return $get('lang') === 'es';
                    })
                    ->schema([
                        TextInput::make('nameEs')
                    ]),
            ])
                ->live()
                ->statePath('data')
        ]);
    }
}
