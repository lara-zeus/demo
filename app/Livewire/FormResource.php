<?php

namespace App\Livewire;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use LaraZeus\Bolt\Filament\Actions\ReplicateFormAction;
use LaraZeus\Bolt\Models\Form as ZeusForm;

class FormResource extends \LaraZeus\Bolt\Filament\Resources\FormResource
{
    public static function table(Table $table): Table
    {
        return parent::table($table)
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
                    ])
                        ->dropdown(false),

                    ActionGroup::make([
                        Action::make('prefilledLink')
                            ->label(__('Prefilled Link'))
                            ->icon('heroicon-o-link')
                            ->tooltip(__('Get Prefilled Link - BOLT PRO'))
                            ->visible(class_exists(\LaraZeus\BoltPro\BoltProServiceProvider::class))
                            ->url(fn(
                                ZeusForm $record
                            ): string => \LaraZeus\Bolt\Filament\Resources\FormResource::getUrl('prefilled',
                                [$record])),

                        (class_exists(\LaraZeus\Helen\HelenServiceProvider::class)) => \LaraZeus\Helen\Actions\ShortUrlAction::make('get-link')
                            ->tooltip('Create short link with QR code - BOLT PRO')
                            ->distUrl(fn(ZeusForm $record) => route('bolt.form.show', $record)),
                    ])
                        ->dropdown(false),
                ]),
            ]);
    }
}
