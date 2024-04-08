<?php

return [
    /**
     * set the default domain.
     */
    'domain' => null,

    /**
     * set the default path for the blog homepage.
     */
    'prefix' => 'thunder',

    /*
     * set database table prefix
     */
    'table-prefix' => '',

    /**
     * the middleware you want to apply on all the blog routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    'middleware' => ['web'],

    /**
     * you can overwrite any model and use your own
     * you can also configure the model per panel in your panel provider using:
     * ->skyModels([ ... ])
     */
    'models' => [
        'Office' => \LaraZeus\Thunder\Models\Office::class,
        'Operations' => \LaraZeus\Thunder\Models\Operations::class,
        'Ticket' => \LaraZeus\Thunder\Models\Ticket::class,
        'TicketsStatus' => \LaraZeus\Thunder\Models\TicketsStatus::class,
        'Abilities' => \LaraZeus\Thunder\Enums\Abilities::class,
        'User'=> config('auth.providers.users.model'),
        'Staff'=> \App\Models\FilamentUser::class,
    ],

    'default-status' => 'OPEN',
];
