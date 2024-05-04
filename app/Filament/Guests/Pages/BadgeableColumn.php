<?php

namespace App\Filament\Guests\Pages;

use App\Models\User;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class BadgeableColumn extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string $view = 'filament.guests.pages.badgeable-column';

    protected static ?string $navigationIcon = 'carbon-badge';

    protected static ?string $navigationGroup = 'Plugins';

    protected static ?int $navigationSort = 3;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->paginated(false)
            ->columns([
                \Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn::make('name')
                    ->suffixBadges([
                        Badge::make('hot')
                            ->label('Hot')
                            ->color('danger'),
                        Badge::make('old')
                            ->label('Old')
                            ->color('info'),
                    ])
                    ->prefixBadges([
                        Badge::make('brand_name')
                            ->label(fn (User $record) => $record->id),
                    ]),
            ]);
    }
}
