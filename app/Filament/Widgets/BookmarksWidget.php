<?php

namespace App\Filament\Widgets;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Schemas\Schema;
use Filament\Widgets\Widget;
use LaraZeus\Delia\Models\Bookmark;
use LaraZeus\ListGroup\Infolists\ListEntry;
use LaraZeus\ListGroup\Item\ListItem;

class BookmarksWidget extends Widget implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = '1/2';

    protected string $view = 'filament.widgets.bookmarks-widget';

    public function bookmarkInfolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                ListEntry::make('items')
                    ->state(function () {
                        return Bookmark::query()
                            ->where('user_id', auth()->user()->id)
                            ->get()
                            ->map(function ($item) {
                                return ListItem::make()
                                    ->id($item->id)
                                    ->url($item->url)
                                    ->icon($item->icon)
                                    ->label($item->title);
                            });
                    }),
            ]);
    }
}
