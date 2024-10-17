<?php

return [
    /**
     * set the default domain.
     */
    'domain' => null,

    /**
     * set the default path for the blog homepage.
     */
    'prefix' => 'athena',

    /*
     * set database table prefix
     */
    'table-prefix' => 'athena_',

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
        'RequestPeriods' => \LaraZeus\Athena\Models\RequestPeriods::class,
        'Request' => \LaraZeus\Athena\Models\Request::class,
        'Service' => \LaraZeus\Athena\Models\Service::class,
        'TimeLock' => \LaraZeus\Athena\Models\TimeLock::class,
        'RequestStatus' => \LaraZeus\Athena\Models\RequestStatus::class,
        'User' => config('auth.providers.users.model'),
    ],

    /*
     * generate ticket no using:
     */
    'appointment-no' => \LaraZeus\Athena\Support\TicketNo::class,
];
