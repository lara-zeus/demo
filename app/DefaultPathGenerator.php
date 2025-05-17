<?php

namespace App;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator as Base;

class DefaultPathGenerator extends Base
{
    protected function getBasePath(Media $media): string
    {
        return '';
    }
}
