<?php

namespace App\Models;

use Database\Factories\MediaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends \Spatie\MediaLibrary\MediaCollections\Models\Media
{
    /** @use HasFactory<MediaFactory> */
    use HasFactory;
}
