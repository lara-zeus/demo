<?php

namespace App\Filament\Guests\Pages;

use App\Models\Guests\SelectTreeBlog;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;

class SelectTree extends Page
{
    protected static string $view = 'filament.guests.pages.select-tree';

    protected static ?string $navigationIcon = 'clarity-tree-view-line';

    protected static ?int $navigationSort = 1;

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
                            ->expandSelected(false),

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories')
                            ->placeholder(__('Please select a category'))
                            ->label('expand selected')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id')
                            ->defaultOpenLevel(2),

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories')
                            ->placeholder(__('Please select a category'))
                            ->label('disabled options')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id')
                            ->disabledOptions([2, 3, 4]),
                    ]),
            ]);
    }
}
