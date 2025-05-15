<?php

use Illuminate\Support\ServiceProvider;

return [

    'zeus-demo' => true,

    'locales' => [
        'en' => ['name' => 'English', 'native' => 'English', 'regional' => 'en_GB', 'flag' => 'gb'],
        'fr' => ['name' => 'French', 'native' => 'français', 'regional' => 'fr_FR', 'flag' => 'fr'],
        'pt_PT' => ['name' => 'Portuguese', 'native' => 'português Portugal', 'regional' => 'pt_PT', 'flag' => 'pt'],
        // 'pt' => ['name' => 'Portuguese', 'native' => 'português', 'regional' => 'pt' , 'flag'=>'pt'],
        'pt_BR' => [
            'name' => 'Brazilian Portuguese', 'native' => 'português do Brasil', 'regional' => 'pt_BR', 'flag' => 'br',
        ],
        'ko' => ['name' => 'Korean', 'native' => '한국어', 'regional' => 'ko_KR', 'flag' => 'kr'],

        'es' => ['name' => 'Spanish', 'native' => 'español', 'regional' => 'es_ES', 'flag' => 'es'],
        'de' => ['name' => 'German', 'native' => 'Deutsch', 'regional' => 'de_DE', 'flag' => 'de'],
        'nl' => ['name' => 'Dutch', 'native' => 'Nederlands', 'regional' => 'nl_NL', 'flag' => 'nl'],
        'it' => ['name' => 'Italian', 'native' => 'italiano', 'regional' => 'it_IT', 'flag' => 'it'],
        'ru' => ['name' => 'Russian', 'native' => 'русский', 'regional' => 'ru_RU', 'flag' => 'ru'],
        'pl' => ['name' => 'Polish', 'native' => 'polski', 'regional' => 'pl_PL', 'flag' => 'pl'],
        'hu' => ['name' => 'Hungarian', 'native' => 'magyar', 'regional' => 'hu_HU', 'flag' => 'hu'],

        'tr' => ['name' => 'Turkish', 'native' => 'Türkçe', 'regional' => 'tr_TR', 'flag' => 'tr'],
        'id' => ['name' => 'Indonesian', 'native' => 'Bahasa Indonesia', 'regional' => 'id_ID', 'flag' => 'id'],
        'ar' => ['name' => 'Arabic', 'native' => 'العربية', 'regional' => 'ar_AE', 'flag' => 'ae'],
    ],

    'repos' => [
        'sky', 'bolt', 'wind', 'dynamic-dashboard',
        'zeus',
        'matrix-choice',
        'qr', 'popover', 'inline-chart', 'accordion',
        'quantity', 'list-group', 'delia',
        'akin', 'translatable',
        // 'rhea',
        // 'artemis',
        // 'tartarus',
        // 'filament-installer', 'pontus', 'boredom',
        // 'core',
        // 'chaos',
        // 'uranus',
    ],

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Laravel Framework Service Providers...
         */

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\Filament\AdminPanelProvider::class,
        App\Providers\Filament\GuestsPanelProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

];
