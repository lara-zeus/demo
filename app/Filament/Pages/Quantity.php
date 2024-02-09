<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Page;
use LaraZeus\Quantity\Components\Quantity as QuantityAlias;

class Quantity extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'iconoir-input-field';

    protected static string $view = 'filament.pages.quantity';

    protected static ?int $navigationSort = 6;

    public ?array $data = [];

    public static function getNavigationLabel(): string
    {
        return 'Quantity';
    }

    public function getTitle(): string
    {
        return 'Quantity Input Number';
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()
                    ->schema([

                        QuantityAlias::make('name1')
                            ->label('select quantity')
                            ->default(3)
                            ->required()
                            ->helperText('between 2 and 10')
                            ->maxValue(10)
                            ->minValue(2)
                            ->hiddenLabel()
                            ->live()
                            ->prefix(fn (Get $get) => 'stop at 0')
                            ->suffix(fn (Get $get) => 'stop at 10')
                            ->columnSpanFull(),

                        QuantityAlias::make('name2')
                            ->label('select quantity')
                            ->default(10)
                            ->required()
                            ->prefix(fn (Get $get) => 'stop at 0')

                            ->heading('select quantity')
                            ->hiddenLabel()
                            ->live(),

                        QuantityAlias::make('name3')
                            ->label('select quantity')
                            ->default(100)
                            ->required()
                            ->suffix(fn (Get $get) => 'stop at 0')
                            ->suffixAction(
                                Action::make('copyCostToPrice')
                                    ->icon('heroicon-m-clipboard')
                                    ->requiresConfirmation()
                                    ->modalHeading('nothing will happen after ...')
                                    ->modalDescription('just want to let you know')
                            )
                            ->live()
                            ->stacked()
                            ->columnSpanFull(),

                        QuantityAlias::make('name4')
                            ->label('select quantity')
                            ->default(404)
                            ->required()
                            ->inlineLabel()
                            ->heading('select quantity')
                            ->live()
                            ->stacked()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
