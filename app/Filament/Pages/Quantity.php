<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use LaraZeus\Quantity\Components\Quantity as QuantityAlias;

class Quantity extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | BackedEnum | null $navigationIcon = 'tabler-input-search';

    protected string $view = 'filament.pages.quantity';

    protected static ?int $navigationSort = 6;

    public ?array $data = [];

    protected static ?string $navigationLabel = 'Quantity';

    protected static ?string $title = 'Quantity Input Number';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make()
                    ->schema([
                        QuantityAlias::make('name9')
                            ->label('quantity with steps')
                            ->default(1)
                            ->steps(2)
                            ->required()
                            ->helperText('steps 2')
                            ->maxValue(1000000)
                            ->minValue(1)
                            ->hiddenLabel()
                            ->live()
                            ->columnSpanFull(),

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

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }

    public function create(): void
    {
        dd($this->form->getState());
    }
}
