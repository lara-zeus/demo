<?php

return [
    /**
     * set the default path for the tickets homepage.
     */
    'path' => 'thunder',

    /**
     * the middleware you want to apply on all the tickets routes
     * for example if you want to make your ticket for users only, add the middleware 'auth'.
     */
    'middleware' => ['web'],

    'layout' => 'zeus::components.app',

    /**
     * this will be setup the default seo site title. read more about it in 'laravel-seo'.
     */
    'site_title' => config('app.name', 'Laravel').' | Tickets',

    /**
     * this will be setup the default seo site description. read more about it in 'laravel-seo'.
     */
    'site_description' => 'All about '.config('app.name', 'Laravel').' Tickets',

    /**
     * this will be setup the default seo site color theme. read more about it in 'laravel-seo'.
     */
    'site_color' => '#F5F5F4',

    'uploads' => [
        'disk' => 'public',
        'directory' => 'tickets',
    ],

    /**
     * the default theme, for now we only have one theme, and soon we will provide more free and premium themes.
     */
    'theme' => 'zeus',

    /**
     * available locales, this currently used only in tags manager.
     */
    'translatable_Locales' => ['en', 'ar'],

    /**
     * customize the models
     */
    'models' => [
        'Office' => \LaraZeus\Thunder\Models\Office::class,
        'Operations' => \LaraZeus\Thunder\Models\Operations::class,
        'Ticket' => \LaraZeus\Thunder\Models\Ticket::class,
        'TicketsStatus' => \LaraZeus\Thunder\Models\TicketsStatus::class,
    ],
];
