<?php

namespace App\Zeus\CustomSchema;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use LaraZeus\Accordion\Forms\Accordion;
use LaraZeus\Bolt\Contracts\CustomSchema;
use LaraZeus\Bolt\Fields\FieldsContract;

class Field implements CustomSchema
{
    public function make(?FieldsContract $field = null): Accordion
    {
        return Accordion::make('custom-field-options')
            ->schema([
                TextInput::make('options.meta.data_binding')
                    ->label('field custom-data'),
            ]);
    }

    public function hidden(?FieldsContract $field = null): array
    {
        return [
            Hidden::make('options.meta.data_binding'),
        ];
    }
}
