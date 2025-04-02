<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use LaraZeus\Mark\Traits\Mark;

class Emoji extends MorphPivot
{
    use Mark;

    protected $casts = [
        'metadata' => 'array',
    ];
}
