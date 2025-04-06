<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use LaraZeus\Delia\Filament\Actions\BookmarkHeaderAction;
use LaraZeus\MatrixChoice\Components\Matrix as MatrixAlias;

class Matrix extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | \BackedEnum | null $navigationIcon = 'tabler-list-check';

    protected string $view = 'filament.pages.qrcode';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    protected static ?string $navigationLabel = 'Matrix Grid';

    protected static ?string $title = 'Matrix Grid';

    public ?string $qrcode;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getHeaderActions(): array
    {
        return [
            BookmarkHeaderAction::make(),
            DemoHeaderAction::make(),
        ];
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()
                    ->schema([
                        MatrixAlias::make('options')
                            // ->disabled()
                            ->formatStateUsing(fn() => [
                                'companies' => ['c' => true],
                                'clients' => ['m' => true, 'p' => true],
                            ])
                            ->disableOptionWhen(fn(string $value
                            ): bool => $value === 'm' || $value === 'p' || $value === 'users')
                            ->rowSelectRequired(false)
                            ->helperText('you can disable any options, like in the users row, the Manage and Approve are disabled')
                            ->label('Resources Operations')
                            ->asCheckbox()
                            ->columnData([
                                'c' => 'Create',
                                'r' => 'Read',
                                'u' => 'Update',
                                'd' => 'Delete',
                                'm' => 'Manage',
                                'p' => 'Approve',
                            ])
                            ->rowData([
                                'users' => 'Users',
                                'companies' => 'Companies',
                                'clients' => 'Clients',
                            ]),

                        MatrixAlias::make('question1')
                            ->disableOptionWhen(fn(string $value): bool => $value === 0)
                            ->rowSelectRequired(false)
                            ->label('Tell us about your mod')
                            ->asCheckbox()
                            ->columnData([
                                '🙂',
                                '😐',
                                '🙁',
                            ])
                            ->rowData([
                                'Saturday',
                                'Sunday',
                                'Monday',
                            ]),

                        MatrixAlias::make('question2')
                            ->label('Tell us about your mod')
                            ->asRadio()
                            ->columnData([
                                '🙂',
                                '😐',
                                '🙁',
                            ])
                            ->rowData([
                                'Saturday',
                                'Sunday',
                                'Monday',
                            ]),
                    ]),
            ]);
    }
}
