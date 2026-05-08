<?php

use App\Models\FilamentUser;
use LaraZeus\Thunder\Enums\Abilities;
use LaraZeus\Thunder\Enums\TicketsStatus;
use LaraZeus\Thunder\Models\Office;
use LaraZeus\Thunder\Models\Operations;
use LaraZeus\Thunder\Models\Ticket;

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
        'Office' => Office::class,
        'Operations' => Operations::class,
        'Ticket' => Ticket::class,
        'TicketsStatus' => TicketsStatus::class,
        'Abilities' => Abilities::class,
        'User' => config('auth.providers.users.model'),
        'Staff' => FilamentUser::class,
    ],

    'default-status' => 'OPEN',

    'chat_polling' => [
        'enabled' => false,
        'time' => '15s', // or '15000ms' or 'keep-alive'
    ],
];
