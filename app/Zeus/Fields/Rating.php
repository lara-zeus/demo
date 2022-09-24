<?php

namespace App\Zeus\Fields;

use Filament\Forms\Components\Toggle;
use LaraZeus\Bolt\Fields\FieldsContract;

class Rating extends FieldsContract
{
    public string $renderClass = '\Yepsua\Filament\Forms\Components\Rating';

    public int $sort = 99;

    public function title()
    {
        return __('Rating');
    }

    public static function getOptions()
    {
        return [
            Toggle::make('options.is_required')->label(__('Is Required')),
        ];
    }
}
