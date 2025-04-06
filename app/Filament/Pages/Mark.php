<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use LaraZeus\Mark\Forms\Components\Mark as MarkForm;

class Mark extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | \BackedEnum | null $navigationIcon = 'tabler-star-half-filled';

    protected string $view = 'filament.pages.mark';

    protected static ?int $navigationSort = 4;

    public ?array $data = [];

    protected static ?string $navigationLabel = 'Mark';

    protected static ?string $title = 'Mark';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->statePath('data')
            ->schema([
                TextInput::make('name'),
                MarkForm::make('likes')
                    ->label('Like')
                    ->like(),
                MarkForm::make('user_fav')
                    ->helperText('user fav')
                    ->label('Bookmark')
                    ->bookMark(),
                MarkForm::make('user_rate')
                    ->label('Rating')
                    ->rating(),


                MarkForm::make('user_mode')
                    ->icons([
                        true => 'tabler-mood-smile',
                        false => 'tabler-mood-sad',
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
