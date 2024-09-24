<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;
use LaraZeus\Delia\Filament\Actions\BookmarkHeaderAction;
use LaraZeus\MatrixChoice\Components\Matrix as MatrixAlias;

class Matrix extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'tabler-list-check';

    protected static string $view = 'filament.pages.qrcode';

    protected static ?int $navigationSort = 1;

    public array $data;

    public string $qrcode;

    public static function getNavigationLabel(): string
    {
        return 'Matrix Grid';
    }

    public function getTitle(): string
    {
        return 'Matrix Grid';
    }

    protected function getHeaderActions(): array
    {
        return [
            BookmarkHeaderAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()
                    ->schema([
                        MatrixAlias::make('options')
                            //->disabled()
                            ->disableOptionWhen(fn (string $value): bool => $value === 'm' || $value === 'p' || $value === 'users')
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
                            ->disableOptionWhen(fn (string $value): bool => $value === 0)
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
