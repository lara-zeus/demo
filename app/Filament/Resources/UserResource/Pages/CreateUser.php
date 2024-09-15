<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Concerns\UseDraftable;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\Action;

class CreateUser extends CreateRecord
{
    use UseDraftable;

    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($data['password']);

        return $data;
    }
}
