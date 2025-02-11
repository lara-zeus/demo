<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Models\Like;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use \LaraZeus\Mark\Forms\Components\Mark as MarkForm;

class Mark extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'tabler-star-half-filled';

    protected static string $view = 'filament.pages.mark';

    protected static ?int $navigationSort = 4;

    public array $data;

    public static function getNavigationLabel(): string
    {
        return 'Mark';
    }

    public function getTitle(): string
    {
        return 'Mark';
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                TextInput::make('name'),
                MarkForm::make(Like::class)
                    ->label('Like')
                    ->isLike(),
                MarkForm::make(Like::class)
                    ->label('Bookmark')
                    ->isBookMark(),
                MarkForm::make(Like::class)
                    ->label('Rating')
                    ->isRating(),
            ]);
    }

    public function create(): void
    {
        dd($this->form->getState());
    }
}
