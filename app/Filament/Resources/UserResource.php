<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Tables\Columns\Popover;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use LaraZeus\MatrixChoice\Components\Matrix;
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
                ->required(fn(string $operation): bool => $operation === 'create')
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Popover::make('name')
                    // most of filament methods will work
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    // main options
                    ->trigger('click')
                    ->placement('right')
                    ->offset([0, 10])
                    ->maxWidth('none')
                    ->icon('heroicon-o-chevron-right')

                    // direct HTML content
                    //->content(fn($record) => new HtmlString($record->name.'<br>'.$record->email))

                    // or blade content
                    ->content(fn($record) => view('filament.test.user-card', ['record' => $record]))

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
                EditAction::make(),
                Impersonate::make()
                    ->redirectTo(url('/admin')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('verified')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Filter::make('unverified')
                    ->query(fn(Builder $query): Builder => $query->whereNull('email_verified_at')),
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
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
