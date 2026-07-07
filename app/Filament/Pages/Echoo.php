<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use App\Models\User;
use Filament\Pages\Page;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use LaraZeus\Echoo\Infolists\Components\EchooEntry;
use LaraZeus\Echoo\Tables\Columns\EchooColumn;

class Echoo extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.echoo';

    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | BackedEnum | null $navigationIcon = 'tabler-table-filled';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    protected static ?string $navigationLabel = 'Echoo';

    protected static ?string $title = 'Echoo';

    public function mount(): void
    {
        $this->form->fill([
            'voice_note' => 'voice/6_Channel_ID.wav'
        ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                EchooEntry::make('voice_note')
                    ->state('voice/6_Channel_ID.wav'),
            ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                \LaraZeus\Echoo\Forms\Components\Echoo::make('voice_note'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginated([1])
            ->query(User::query())
            ->columns([
                TextColumn::make('name'),
                EchooColumn::make('voice_note')
                    ->state('voice/6_Channel_ID.wav'),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return 'New';
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'danger';
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
