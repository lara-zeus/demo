<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Resources\CarResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\Hades\Concerns\UseDraftable;

class CreateCar extends CreateRecord
{
    use UseDraftable;

    public ?array $excludedInputs = ['image'];

    protected static string $resource = CarResource::class;
}
