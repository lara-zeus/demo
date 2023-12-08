<?php

namespace App\Livewire\FormResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListForms extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = \App\Livewire\FormResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make('create'),
            Action::make('open')
                ->label(__('Open'))
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->tooltip(__('open all forms'))
                ->color('warning')
                ->url(fn () => route('bolt.forms.list'))
                ->openUrlInNewTab(),
        ];

        if (class_exists(\LaraZeus\BoltPro\Facades\BoltPro::class)) {
            //@phpstan-ignore-next-line
            $actions[] = \LaraZeus\BoltPro\Actions\PresetAction::make('new from preset')
                ->visible(config('zeus-bolt.show_presets'));
        }

        return $actions;
    }
}
