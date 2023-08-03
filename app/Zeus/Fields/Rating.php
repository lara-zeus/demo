<?php

namespace App\Zeus\Fields;

use LaraZeus\Bolt\Fields\FieldsContract;

class Rating extends FieldsContract
{
    public string $renderClass = \Yepsua\Filament\Forms\Components\Rating::class;

    public int $sort = 99;

    public bool $disabled = true;

    public function title(): string
    {
        return __('Rating');
    }

    public static function getOptions(): array
    {
        return [
            self::required(),
            self::htmlID(),
            self::visibility(),
        ];
    }
}
