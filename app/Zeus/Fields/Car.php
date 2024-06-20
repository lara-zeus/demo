<?php

namespace App\Zeus\Fields;

use LaraZeus\Bolt\Fields\FieldsContract;
use LaraZeus\Bolt\Models\Field;
use LaraZeus\Bolt\Models\FieldResponse;

class Car extends FieldsContract
{
    public string $renderClass = \App\Forms\Components\Car::class;

    public int $sort = 20;

    public function title(): string
    {
        return __('Car');
    }

    public static function getOptions(): array
    {
        return [
            self::htmlID(),
            self::required(),
            self::columnSpanFull(),
        ];
    }

    public static function getOptionsHidden(): array
    {
        return [
            self::hiddenHtmlID(),
            self::hiddenRequired(),
            self::hiddenColumnSpanFull(),
        ];
    }

    public function getResponse(Field $field, FieldResponse $resp): string
    {
        return view('zeus.fields.car')
            ->with('field', $field)
            ->with('resp', $resp)
            ->with('car', \App\Models\Car::find($resp->response))
            ->render();
    }
}
