<?php

namespace App\Zeus\CustomSchema;

use Filament\Forms\Components\TextInput;
use LaraZeus\Bolt\Contracts\CustomFormSchema;

class Form implements CustomFormSchema
{
    public function make(): \Filament\Schemas\Components\Tabs\Tab
    {
        return \Filament\Schemas\Components\Tabs\Tab::make('custom-form-options')
            ->schema([
                TextInput::make('options.custom-data')
                    ->label('form custom data'),
            ]);
    }
}
