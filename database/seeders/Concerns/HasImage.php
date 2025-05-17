<?php

namespace Database\Seeders\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait HasImage
{
    public function getImage(
        string $directory,
        bool $withMedia = false,
        string $disk = 'public'
    ): string | int
    {
        $randName = $this->faker->word().'-'.$this->faker->randomNumber();
        $imgUrl = 'https://picsum.photos/1300/700?random='.$randName;
        $getImageContent = file_get_contents($imgUrl);
        $fileName = $randName.'.png';
        $fullFileName = $directory.'/'.$fileName;

        if (!Storage::disk($disk)->exists($fullFileName)) {
            Storage::disk($disk)->put($fullFileName, $getImageContent);
        }

        if ($withMedia) {
            $data = Image::make(Storage::disk($disk)->path($fullFileName));

            return DB::table('curator_media')
                ->insertGetId([
                    'name' => $data->filename,
                    'path' => $directory.'/'.$fileName,
                    'ext' => $data->extension,
                    'type' => $data->mime(),
                    'alt' => $this->faker->words(rand(3, 8), true),
                    'title' => $data->filename,
                    'caption' => $data->filename,
                    'description' => $data->filename,
                    'width' => $data->getWidth() ?? null,
                    'height' => $data->getHeight() ?? null,
                    'disk' => $disk,
                    'directory' => $directory,
                    'size' => $data->filesize() ?? null,
                    'created_at' => now(),
                ]);
        }

        return $fullFileName;
    }
}