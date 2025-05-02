<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use LaraZeus\Mark\Forms\Components\Mark as MarkForm;

class Mark extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'tabler-star-half-filled';

    protected static string $view = 'filament.pages.mark';

    protected static ?int $navigationSort = 4;

    public ?array $data = [];

    protected static ?string $navigationLabel = 'Mark';

    protected static ?string $title = 'Mark';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                TextInput::make('name'),
                MarkForm::make('likes')
                    ->label('Like')
                    ->colors([
                        true => 'green',
                        false => 'secondary',
                    ])
                    ->like(),
                MarkForm::make('user_bookmark')
                    ->helperText('user Bookmark?')
                    ->label('Bookmark')
                    ->colors([
                        true => 'info',
                    ])
                    ->bookMark(),

                MarkForm::make('user_fav')
                    ->helperText('or user Favorite?')
                    ->label('Favorite')
                    ->colors([
                        true => 'violet',
                    ])
                    ->icons([
                        true => 'heroicon-o-star',
                    ])
                    ->selectedIcons([
                        true => 'heroicon-s-star',
                    ]),

                MarkForm::make('user_rate')
                    ->default(3)
                    ->colors([
                        1 => 'yellow',
                        2 => 'yellow',
                        3 => 'yellow',
                        4 => 'yellow',
                        5 => 'yellow',
                    ])
                    ->label('Rating')
                    ->rating(),

                MarkForm::make('user_mode')
                    ->icons([
                        true => 'tabler-mood-smile',
                        false => 'tabler-mood-sad',
                    ])
                    ->colors([
                        true => 'sky',
                        false => 'rose',
                    ])
                    ->selectedIcons([
                        true => 'tabler-mood-smile-filled',
                        false => 'tabler-mood-sad-filled',
                    ]),
            ]);
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
