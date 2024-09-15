<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Concerns\UseDraftable;
use App\Filament\Resources\CarResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCar extends CreateRecord
{
    use UseDraftable;

    protected static string $resource = CarResource::class;
}
