<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use LaraZeus\Tiles\Forms\Components\TileLayout;
use LaraZeus\Tiles\Forms\Components\TileSelect;
use LaraZeus\Tiles\Infolists\Components\TileEntry;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class Tiles extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'carbon-image';

    protected static string $view = 'filament.pages.tiles';

    protected static ?int $navigationSort = 3;

    public array $data;

    public User $user;

    public function mount()
    {
        $this->user = User::first();
    }

    public static function getNavigationLabel(): string
    {
        return 'Tiles';
    }

    public function getTitle(): string
    {
        return 'Tiles';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('id'),
                TileColumn::make('name')
                    ->icon('tabler-dots-vertical')
                    ->description(fn (User $record) => $record->email)
                    ->popover(fn (User $record) => view('filament.test.user-card', ['record' => $record]))
                    ->tooltip(fn (User $record) => $record->id)
                    ->image(fn (User $record) => $record->avatar_url),
                TextColumn::make('created_at'),
            ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make('using popover in forms')
                    ->schema([
                        TileLayout::make('id')
                            ->columnSpanFull()
                            ->label('Created By')
                            ->icon('tabler-dots-vertical')
                            ->description(fn () => $this->user->email)
                            ->popover(fn () => view('filament.test.user-card', ['record' => $this->user]))
                            ->tooltip(fn () => $this->user->id)
                            ->image(fn () => $this->user->avatar_url),

                        TileSelect::make('user_id')
                            ->model(User::class)
                            ->searchable(['name', 'email'])
                            ->titleKey('name')
                            ->imageKey('avatar_url')
                            ->descriptionKey('email')
                            ->label('User'),
                    ]),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record(User::first())
            ->schema([
                \Filament\Infolists\Components\Section::make('using popover in infolist')
                    ->schema([
                        TileEntry::make('name')
                            ->icon('tabler-dots-vertical')
                            ->description(fn (User $record) => $record->email)
                            ->popover(fn (User $record) => view('filament.test.user-card', ['record' => $record]))
                            ->tooltip(fn (User $record) => $record->id)
                            ->image(fn (User $record) => $record->avatar_url),
                    ]),
            ]);
    }
}
