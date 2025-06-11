<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\DemoWidgets\MiniChart;
use App\Filament\Pages\Actions\DemoHeaderAction;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class InlineChart extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-chart-bar-square';

    protected string $view = 'filament.pages.inline-chart';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Inline Chart';

    protected static ?string $title = 'Inline Chart';

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
                    ->maxWidth(150)
                    ->icon('heroicon-o-chevron-right'),

                TextColumn::make('email')
                    ->sortable()
                    ->toggleable()
                    ->icon('heroicon-o-envelope')
                    ->searchable(),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
