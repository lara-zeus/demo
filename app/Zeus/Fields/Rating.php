<?php

namespace App\Zeus\Fields;

use LaraZeus\Bolt\Fields\FieldsContract;

class Rating extends FieldsContract
{
    public $disabled = false;

    public function __construct()
    {
        $this->definition = [
            'type' => '\Yepsua\Filament\Forms\Components\Rating',
            'title' => __('Rating'),
            'order' => 4,
        ];
    }
}
