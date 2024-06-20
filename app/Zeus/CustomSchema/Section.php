<?php

namespace App\Zeus\CustomSchema;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use LaraZeus\Accordion\Forms\Accordion;
use LaraZeus\Bolt\Contracts\CustomSchema;
use LaraZeus\Bolt\Fields\FieldsContract;

class Section implements CustomSchema
{
    public function make(?FieldsContract $field = null): Accordion
    {
        return Accordion::make('custom-section-options')
            ->schema([
                TextInput::make('options.custom.data')
                    ->label('section data'),
            ]);
    }

    public function hidden(?FieldsContract $field = null): array
    {
        return [
            Hidden::make('options.custom.data'),
        ];
    }
}
