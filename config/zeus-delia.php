<?php

/*todo
 * render hook to show the dropdown list
 * render hook to show the bookmark toggle
 * a blade component
 * an action
 * multi tenant
 */

use Filament\Tables\View\TablesRenderHook;
use Filament\View\PanelsRenderHook;

return [
    /**
     * set the default domain.
     */
    'render-hooks' => [
        'list' => PanelsRenderHook::TOPBAR_END,
        'bookmark_toggle_icon' => TablesRenderHook::TOOLBAR_TOGGLE_COLUMN_TRIGGER_AFTER,
    ],

    /**
     * set  the database tables prefix
     */
    'table-prefix' => 'delia_',

    /**
     * you can overwrite any model and use your own
     * you can also configure the model per panel in your panel provider using:
     * ->skyModels([ ... ])
     */
    'models' => [
        'User' => config('auth.providers.users.model'),
        'Bookmark' => \LaraZeus\Delia\Models\Bookmark::class,
    ],
];
