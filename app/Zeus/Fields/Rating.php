<?php

namespace App\Zeus\Fields;

use LaraZeus\Bolt\Fields\FieldsContract;

class Rating extends FieldsContract
{
    public $renderClass = '\Yepsua\Filament\Forms\Components\Rating';
    public $sort = 99;

    public function title()
    {
        return __('Rating');
    }
}
