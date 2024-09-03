<?php

namespace App\Filament\Widgets;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Widgets\Widget;
use LaraZeus\Delia\Models\Bookmark;
use LaraZeus\ListGroup\Infolists\ListEntry;
use LaraZeus\ListGroup\Item\ListItem;

class BookmarksWidget extends Widget implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.bookmarks-widget';

    public function bookmarkInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ListEntry::make('items')
                    ->state(function () {
                        return Bookmark::query()
                            ->where('user_id', auth()->user()->id)
                            ->get()
                            ->map(function($item){
                                $resource = app($item->bookmarkable_resource);
                                return ListItem::make()
                                    ->id($item->id)
                                    ->url($resource->getUrl())
                                    ->icon($resource->getNavigationIcon())
                                    ->tooltip($resource->getNavigationLabel())
                                    ->label($resource->getNavigationLabel());
                            });
                    }),
            ]);
    }
}
