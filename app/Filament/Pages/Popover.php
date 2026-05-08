<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use LaraZeus\Popover\Form\PopoverForm;
use LaraZeus\Popover\Infolists\PopoverEntry;
use LaraZeus\Popover\Tables\PopoverColumn;

class Popover extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | BackedEnum | null $navigationIcon = 'tabler-stack-pop';

    protected string $view = 'filament.pages.popover';

    protected static ?int $navigationSort = 3;

    public function mount(): void
    {
        $this->form->fill([
            'name' => 'Zeus',
        ]);
    }

    public static function getNavigationLabel(): string
    {
        return 'Popover';
    }

    protected static ?string $title = 'Popover';

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                PopoverColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->trigger('hover')
                    ->placement('bottom')
                    ->offset(10)
                    ->popOverMaxWidth('none')
                    ->icon('heroicon-o-chevron-right')
                    ->content(fn ($record) => view('filament.test.user-card', ['record' => $record, 'type' => 'name'])),

                PopoverColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->offset(10)
                    ->trigger('click')
                    ->placement('right')
                    ->popOverMaxWidth('none')
                    ->icon('heroicon-o-chevron-right')
                    ->content(fn ($record) => view('filament.test.user-card', ['record' => $record, 'type' => 'email'])),
            ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make()
                    ->schema([
                        PopoverForm::make('name')
                            ->trigger('hover')
                            ->icon('tabler-chart-donut-4')
                            ->content('Adam'),
                    ]),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->record(User::first())
            ->components([
                Section::make()
                    ->schema([
                        PopoverEntry::make('name')
                            ->trigger('hover')
                            ->placement('top-start')
                            ->popOverMaxWidth('none')
                            ->icon('heroicon-o-chevron-right')
                            ->content(fn ($record) => view('filament.test.user-card', ['record' => $record, 'type' => 'name'])),
                        PopoverEntry::make('email')
                            ->placement('bottom')
                            ->popOverMaxWidth('none')
                            ->icon('heroicon-o-chevron-right')
                            ->content(fn ($record) => view('filament.test.user-card', ['record' => $record, 'type' => 'name'])),
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
