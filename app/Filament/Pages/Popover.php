<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use LaraZeus\Popover\Tables\PopoverColumn;

class Popover extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'grommet-tip';

    protected static string $view = 'filament.pages.popover';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return 'Popover';
    }

    public function getTitle(): string
    {
        return 'Popover';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                PopoverColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->trigger('click')
                    ->placement('right')
                    //->offset(10)
                    ->popOverMaxWidth('none')
                    ->icon('heroicon-o-chevron-right')
                    ->content(fn ($record) => view('filament.test.user-card', ['record' => $record])),

                TextColumn::make('email')
                    ->sortable()
                    ->toggleable()
                    ->icon('heroicon-o-envelope')
                    ->searchable(),
            ]);
    }
}
