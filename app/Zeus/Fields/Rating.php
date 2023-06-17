<?php

namespace App\Zeus\Fields;

use Filament\Forms\Components\Toggle;
use LaraZeus\Bolt\Fields\FieldsContract;

class Rating extends FieldsContract
{
    public string $renderClass = \Yepsua\Filament\Forms\Components\Rating::class;

    public int $sort = 99;

    public function title(): string
    {
        return __('Rating');
    }

    public static function getOptions(): array
    {
        return [
            Toggle::make('options.is_required')->label(__('Is Required')),
        ];
    }
}
