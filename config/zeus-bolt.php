<?php

use LaraZeus\Bolt\Enums\FormsStatus;
use LaraZeus\Bolt\Mail\FormSubmission;
use LaraZeus\Bolt\Models\Category;
use LaraZeus\Bolt\Models\Collection;
use LaraZeus\Bolt\Models\Field;
use LaraZeus\Bolt\Models\FieldResponse;
use LaraZeus\Bolt\Models\Form;
use LaraZeus\Bolt\Models\Response;
use LaraZeus\Bolt\Models\Section;

return [
    /**
     * set the default domain.
     */
    'domain' => null,

    /**
     * set the default path for the blog homepage.
     */
    'prefix' => 'bolt',

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
        'Category' => Category::class,
        'Collection' => Collection::class,
        'Field' => Field::class,
        'FieldResponse' => FieldResponse::class,
        'Form' => Form::class,
        'FormsStatus' => FormsStatus::class,
        'Response' => Response::class,
        'Section' => Section::class,
    ],

    'defaultMailable' => FormSubmission::class,

    'uploadDisk' => 'public',

    'uploadDirectory' => 'forms',

    /*
     * if you have installed Bolt Preset, you can enable it here
     */
    'show_presets' => true,

    /**
     * the preset comes with a demo forms:
     * a Contact form and Ticket support form.
     * if you dont want them, feel free to set this to false
     * */
    'show_core_presets' => true,

    'allow_design' => true,

    'should_cache_preset' => true,
];
