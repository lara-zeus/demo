<?php

namespace App\Filament\Guests\Pages;

use App\Models\Guests\SelectTreeBlog;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use UnitEnum;

class SelectTree extends Page
{
    protected string $view = 'filament.guests.pages.select-tree';

    protected static string | BackedEnum | null $navigationIcon = 'tabler-binary-tree-2';

    protected static ?int $navigationSort = 1;

    protected static string | UnitEnum | null $navigationGroup = 'Plugins';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->model(SelectTreeBlog::class)
            ->statePath('data')
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories_1')
                            ->label('with count')
                            ->placeholder(__('Please select a category'))
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->withCount()
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id'),

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories_2')
                            ->placeholder(__('Please select a category'))
                            ->label('independent')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id')
                            ->independent(false),

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories_3')
                            ->placeholder(__('Please select a category'))
                            ->label('expand selected')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id')
                            ->expandSelected(false),

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories_4')
                            ->placeholder(__('Please select a category'))
                            ->label('expand selected')
                            ->enableBranchNode()
                            ->emptyLabel(__('Oops, no results have been found!'))
                            ->searchable()
                            ->relationship('categories', 'name', 'parent_id')
                            ->defaultOpenLevel(2),

                        \CodeWithDennis\FilamentSelectTree\SelectTree::make('categories_5')
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
