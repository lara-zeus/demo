<?php

namespace App\Filament\Guests\Pages;

use App\Models\Guests\SelectTreeBlog;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\HtmlString;
use LaraZeus\Sky\Models\Post;

class SelectTree extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.guests.pages.select-tree';

    public function form(Form $form): Form
    {
        return $form
            ->model(SelectTreeBlog::class)
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories')
                            ->label('with count')
                            ->placeholder(__('Please select a category'))
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->withCount()
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id'),

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories')
                            ->placeholder(__('Please select a category'))
                            ->label('independent')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id')
                            ->independent(false),

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories')
                            ->placeholder(__('Please select a category'))
                            ->label('expand selected')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id')
                            ->expandSelected(false)
                        ,

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories')
                            ->placeholder(__('Please select a category'))
                            ->label('expand selected')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id')
                            ->defaultOpenLevel(2)
                        ,

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories')
                            ->placeholder(__('Please select a category'))
                            ->label('disabled options')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id')
                            ->disabledOptions([2, 3, 4])
                        ,

                        Placeholder::make('br')->hiddenLabel()->content(new HtmlString('<br><br><br><br><br><br><br><br>')),

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories')
                            ->placeholder(__('Please select a category'))
                            ->label('always open')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->columnSpanFull()
                            ->relationship('categories', 'name', 'parent_id')
                            ->alwaysOpen()
                        ,
                    ]),
            ]);
    }
}
