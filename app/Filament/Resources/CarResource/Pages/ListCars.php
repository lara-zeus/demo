<?php

namespace App\Filament\Resources\CarResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\CarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCars extends ListRecords
{
    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
