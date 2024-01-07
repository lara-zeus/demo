<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Popover\Infolists\PopoverEntry;
use LaraZeus\Popover\Tables\PopoverColumn;
use LaraZeus\Qr\Facades\Qr;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('User Info')->columns()->schema([
                PopoverEntry::make('name')
                    // main options
                    ->trigger('click')
                    ->placement('right')
                    ->offset([0, 10])
                    ->popOverMaxWidth('none')
                    ->icon('heroicon-o-chevron-right')
                    //->content(fn ($record) => view('filament.test.user-card', ['record' => $record]))
                    ->content(Qr::render(data: 'dataOrUrl')), //, downloadable:false

                //TextEntry::make('name'),
                TextEntry::make('email'),
            ]),
        ]);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
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
                /*RightClick::make('name')
                    ->actions(fn(User $record): array => [
                        Action::make('edit')
                            ->icon('heroicon-o-pencil-square')
                            ->color('info')
                            ->grouped()
                            ->requiresConfirmation(),
                        Action::make('view')
                            ->icon('heroicon-o-eye')
                            ->color('info')
                            ->grouped()
                            ->requiresConfirmation(),
                        Action::make('delete')
                            ->icon('heroicon-o-trash')
                            ->color('danger')
                            ->grouped()
                            ->requiresConfirmation(),
                        Action::make('permissions')
                            ->icon('heroicon-o-key')
                            ->color('warning')
                            ->grouped()
                            ->requiresConfirmation(),
                        Action::make('Impersonate')
                            ->icon('heroicon-o-user')
                            ->color('secondary')
                            ->grouped()
                            ->requiresConfirmation()



                        //ViewAction::make()->record($record),
                        //EditAction::make(),
                        /*Impersonate::make()
                            ->grouped()
                            ->redirectTo(url('/admin')),* /
                    ]),*/

                PopoverColumn::make('name')
                    // most of filament methods will work
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    // main options
                    ->trigger('click')
                    ->placement('right')
                    ->offset([0, 10])
                    ->popOverMaxWidth('none')
                    ->icon('heroicon-o-chevron-right')

                    // direct HTML content
                    //->content(fn($record) => new HtmlString($record->name.'<br>'.$record->email))

                    // or blade content
                    ->content(fn ($record) => view('filament.test.user-card', ['record' => $record]))

                // or livewire component
                //->content(fn($record) => new HtmlString(Blade::render('@livewire(\App\Filament\Widgets\DemoStats::class, ["lazy" => true])')))
                ,

                /*TextColumn::make('name')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),*/

                TextColumn::make('email')
                    ->sortable()
                    ->toggleable()
                    ->icon('heroicon-o-envelope')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('remember_token')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    Impersonate::make()
                        ->grouped()
                        ->redirectTo(url('/admin')),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
