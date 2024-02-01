<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
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
                            //->inlineLabel()
                            //->disabled()
                            //->heading('select quantity')
                            ->helperText('between 2 and 10')
                            ->maxValue(10)
                            ->minValue(2)
                            ->hiddenLabel()
                            ->live()
                            //->stacked()
                            ->columnSpanFull(),

                        QuantityAlias::make('name2')
                            ->label('select quantity')
                            ->default(10)
                            ->required()
                            //->inlineLabel()
                            //->disabled()
                            ->heading('select quantity')
                            ->hiddenLabel()
                            ->live()
                        //->stacked()
                        ,

                        QuantityAlias::make('name3')
                            ->label('select quantity')
                            ->default(100)
                            ->required()
                            //->inlineLabel()
                            //->disabled()
                            //->heading('select quantity')
                            //->hiddenLabel()
                            ->live()
                            ->stacked()
                            ->columnSpanFull(),

                        QuantityAlias::make('name4')
                            ->label('select quantity')
                            ->default(404)
                            ->required()
                            ->inlineLabel()
                            //->disabled()
                            ->heading('select quantity')
                            //->hiddenLabel()
                            ->live()
                            ->stacked()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
