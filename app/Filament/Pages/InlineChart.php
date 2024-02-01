<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\DemoWidgets\MiniChart;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class InlineChart extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static string $view = 'filament.pages.inline-chart';

    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return 'Inline Chart';
    }

    public function getTitle(): string
    {
        return 'Inline Chart';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                \LaraZeus\InlineChart\Tables\Columns\InlineChart::make('name')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->chart(MiniChart::class)
                    ->maxWidth('!w-[150px]')
                    ->icon('heroicon-o-chevron-right'),

                TextColumn::make('email')
                    ->sortable()
                    ->toggleable()
                    ->icon('heroicon-o-envelope')
                    ->searchable(),
            ]);
    }
}
