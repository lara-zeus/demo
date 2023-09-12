<?php

return [
    'accepted_file_types' => [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/svg+xml',
        'application/pdf',
    ],
    'cloud_disks' => [
        's3',
        'cloudinary',
        'imgix',
    ],
    'curation_presets' => [
        \LaraZeus\Hermes\Concerns\BranchThumbnailPreset::class,
    ],
    'directory' => 'media',
    'disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),
    'glide' => [
        'server' => \Awcodes\Curator\Glide\DefaultServerFactory::class,
        'fallbacks' => [],
    ],
    'image_crop_aspect_ratio' => null,
    'image_resize_mode' => null,
    'image_resize_target_height' => null,
    'image_resize_target_width' => null,
    'is_limited_to_directory' => false,
    'max_size' => 5000,
    'model' => \App\Models\Curator::class,
    'min_size' => 0,
    'path_generator' => null,
    'resources' => [
        'label' => 'Media',
        'plural_label' => 'Media',
        'navigation_group' => 'Hermes',
        'navigation_icon' => 'heroicon-o-photo',
        'navigation_sort' => 1,
        'navigation_count_badge' => false,
        'resource' => \Awcodes\Curator\Resources\MediaResource::class,
    ],
    'should_preserve_filenames' => false,
    'should_register_navigation' => true,
    'visibility' => 'public',
    'created_for' => [
        [
            'resource' => \LaraZeus\Hermes\Filament\Resources\BranchResource::class,
            'component' => 'image',
            'title' => 'name',
        ],
    ],
];
