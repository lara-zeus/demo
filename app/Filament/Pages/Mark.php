<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
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
                    ->isLike(),
                MarkForm::make('user_fav')
                    ->helperText('user fav')
                    ->label('Bookmark')
                    ->isBookMark(),
                MarkForm::make('user_rate')
                    ->label('Rating')
                    ->isRating(),
            ]);
    }

    public function create(): void
    {
        abort_if(app()->isProduction(), 404);

        dd($this->form->getState());
    }
}
