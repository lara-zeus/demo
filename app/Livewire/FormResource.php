<?php

namespace App\Livewire;

use Closure;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use LaraZeus\Bolt\BoltPlugin;
use LaraZeus\Bolt\Concerns\HasOptions;
use LaraZeus\Bolt\Concerns\Schemata;
use LaraZeus\Bolt\Filament\Actions\ReplicateFormAction;
use LaraZeus\Bolt\Filament\Resources\BoltResource;
use LaraZeus\Bolt\Filament\Resources\FormResource\Pages\CreateForm;
use LaraZeus\Bolt\Filament\Resources\FormResource\Pages\EditForm;
use LaraZeus\Bolt\Filament\Resources\FormResource\Pages\ListForms;
use LaraZeus\Bolt\Filament\Resources\FormResource\Pages\ViewForm;
use LaraZeus\Bolt\Models\Form as ZeusForm;

class FormResource extends \LaraZeus\Bolt\Filament\Resources\FormResource
{
    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('ordering')
            ->columns([
                TextColumn::make('name')->searchable()->sortable()->label(__('Form Name'))->toggleable(),
                TextColumn::make('category.name')->searchable()->label(__('Category'))->sortable()->toggleable(),
                IconColumn::make('is_active')->boolean()->label(__('Is Active'))->sortable()->toggleable(),
                TextColumn::make('start_date')->dateTime()->searchable()->sortable()->label(__('Start Date'))->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('end_date')->dateTime()->searchable()->sortable()->label(__('End Date'))->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('responses_exists')->boolean()->exists('responses')->label(__('Responses Exists'))->sortable()->toggleable(),
                TextColumn::make('responses_count')->counts('responses')->label(__('Responses Count'))->sortable()->toggleable(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make('edit'),
                    DeleteAction::make(),
                    ForceDeleteAction::make(),
                    RestoreAction::make(),
                    ReplicateFormAction::make(),

                    ActionGroup::make([
                        Action::make('entries')
                            ->color('info')
                            ->label(__('Entries'))
                            ->icon('clarity-data-cluster-line')
                            ->tooltip(__('view all entries'))
                            ->url(fn(ZeusForm $record): string => url('admin/responses?form_id='.$record->id)),
                    ])->dropdown(false)->label('ssss'),
                    ActionGroup::make([
                        Action::make('prefilledLink')
                            ->label(__('Prefilled Link'))
                            ->icon('heroicon-o-link')
                            ->tooltip(__('Get Prefilled Link - BOLT PRO'))
                            ->visible(class_exists(\LaraZeus\BoltPro\BoltProServiceProvider::class))
                            ->url(fn(ZeusForm $record
                            ): string => \LaraZeus\Bolt\Filament\Resources\FormResource::getUrl('prefilled', [$record])),

                        (class_exists(\LaraZeus\Helen\HelenServiceProvider::class)) => \LaraZeus\Helen\Actions\ShortUrlAction::make('get-link')
                            ->tooltip('Create short link with QR code - BOLT PRO')
                            ->distUrl(fn(ZeusForm $record) => route('bolt.form.show', $record)),
                    ])->dropdown(false)->label('ssss'),
                ])
            ])
            ->filters([
                TrashedFilter::make(),
                Filter::make('is_active')
                    ->toggle()
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true))
                    ->label(__('Is Active')),

                Filter::make('not_active')
                    ->toggle()
                    ->query(fn(Builder $query): Builder => $query->where('is_active', false))
                    ->label(__('Inactive')),

                SelectFilter::make('category_id')
                    ->options(BoltPlugin::getModel('Category')::pluck('name', 'id'))
                    ->label(__('Category')),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
            ]);
    }
}
