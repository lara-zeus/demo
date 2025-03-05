<?php

namespace App\Mason;

use Awcodes\Mason\Bricks\Section;

class BrickCollection
{
    public static function make(): array
    {
        return [
            Batman::make(),
            NewsletterSignup::make(),
            Section::make(),
            Cards::make(),
            SupportCenter::make(),
            Code::make(),
        ];
    }
}