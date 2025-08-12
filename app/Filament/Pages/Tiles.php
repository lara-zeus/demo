<?php

namespace App\Filament\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use LaraZeus\Tiles\Forms\Components\TileLayout;
use LaraZeus\Tiles\Forms\Components\TileSelect;
use LaraZeus\Tiles\Infolists\Components\TileEntry;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class Tiles extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | \BackedEnum | null $navigationIcon = 'tabler-photo-circle';

    protected string $view = 'filament.pages.tiles';

    protected static ?int $navigationSort = 3;

    public ?array $data = [];

    protected static ?string $navigationLabel = 'Tiles';

    protected static ?string $title = 'Tiles';

    public User $user;

    public function mount()
    {
        $this->user = User::first();
        $this->form->fill();
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

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('')
                    ->schema([
                        TileLayout::make('name')
                            ->label('Created By')
                            ->icon('tabler-dots-vertical')
                            ->description(fn () => $this->user->email)
                            ->popover(fn () => view('filament.test.user-card', ['record' => $this->user]))
                            ->tooltip(fn () => $this->user->id)
                            ->image(fn () => $this->user->avatar_url),

                        TileSelect::make('user_id')
                            ->default(1)
                            ->model(User::class)
                            ->searchable(['name', 'email'])
                            ->titleKey('name')
                            ->imageKey('avatar_url')
                            ->descriptionKey('email')
                            ->label('User'),
                    ]),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->record(User::first())
            ->components([
                Section::make('')
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

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
