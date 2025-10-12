<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\ViewUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\DemoWidgets\MiniChart;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Popover\Infolists\PopoverEntry;
use LaraZeus\Popover\Tables\PopoverColumn;
use LaraZeus\Qr\Facades\Qr;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 1;

    //protected static string | \BackedEnum | null $navigationIcon = 'tabler-users-group';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCpuChip;

    public static function getNavigationLabel(): string
    {
        return 'Users';
    }

    public static function getPluralLabel(): string
    {
        return 'users';
    }

    public static function getLabel(): string
    {
        return 'user';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'App';
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('User Info')->columns()->schema([
                PopoverEntry::make('name')
                    // main options
                    ->trigger('click')
                    ->placement('right')
                    // ->offset(10)
                    ->popOverMaxWidth('none')
                    ->icon('heroicon-o-chevron-right')
                    // ->content(fn ($record) => view('filament.test.user-card', ['record' => $record]))
                    ->content(Qr::render(data: 'dataOrUrl')), // , downloadable:false

                // TextEntry::make('name'),
                TextEntry::make('email'),
            ]),
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('email')
                ->unique(ignoreRecord: true)
                ->required()
                ->email(),
            TextInput::make('password')
                ->password()
                ->visibleOn('create')
                ->required(fn (string $operation): bool => $operation === 'create')
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_url'),
                PopoverColumn::make('name')
                    ->content(Qr::render(
                        data: 'https://larazeus.com',
                        options: [
                            'margin' => '1',
                            'color' => 'rgba(74, 74, 74, 1)',
                            'back_color' => 'rgba(252, 252, 252, 1)',
                            'style' => 'square',
                            'hasGradient' => true,
                            'gradient_type' => 'vertical',
                            'hasEyeColor' => false,
                            'eye_color_inner' => 'rgb(241, 148, 138)',
                            'eye_color_outer' => 'rgb(69, 179, 157)',
                            'eye_style' => 'square',
                            'correction' => 'H',
                            'percentage' => '.2',

                            'size' => '100',
                            'type' => 'png',
                            'gradient_form' => 'rgb(69, 179, 157,1)',
                            'gradient_to' => 'rgb(241, 148, 138,1)',
                        ],
                    )),

                ColumnGroup::make('main-info', [
                    TextColumn::make('email')
                        ->sortable()
                        ->toggleable()
                        ->icon('heroicon-o-envelope')
                        ->searchable(),
                ])
                    ->alignment(Alignment::Center)
                    ->wrapHeader(),
                ColumnGroup::make('other-info', [
                    TextColumn::make('email_verified_at')
                        ->sortable()
                        ->toggleable()
                        ->searchable(),
                ])
                    ->alignment(Alignment::Center)
                    ->wrapHeader(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    /*Impersonate::make()
                        ->grouped()
                        ->redirectTo(url('/admin')),*/
                ]),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('verified')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Filter::make('unverified')
                    ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
            ]);
    }

    public static function canDelete(Model $record): bool
    {
        return app()->isLocal();
    }

    public static function canDeleteAny(): bool
    {
        return app()->isLocal();
    }

    public static function canEdit(Model $record): bool
    {
        return app()->isLocal();
    }

    public static function getWidgets(): array
    {
        return [
            MiniChart::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
