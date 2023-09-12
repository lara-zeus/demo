<?php

return [
    'themes' => [
        'zeus' => 'zeus::components.app',
        'daisy' => 'zeus::themes.daisy.layouts.app',
        //'breeze' => 'zeus::themes.breeze.layouts.app',
        'another-portfolio' => 'zeus::themes.another-portfolio.layouts.app',
    ],

    'themes-icons' => [
        'zeus' => 'rpg-lightning-bolt',
        'daisy' => 'rpg-daisy',
        //'breeze' => 'rpg-daisy',
        'another-portfolio' => 'rpg-super-mushroom',
    ],

    /**
     * you can use the default layout as a starting point for your blog.
     * however, if you're already using your own component, just set the path here.
     */
    'layout' => 'zeus::components.app',

    /**
     * the default theme, for now we only have one theme, and soon we will provide more free and premium themes.
     */
    'theme' => 'zeus',

    /**
     * this will be set up the default seo site title. read more about it in 'laravel-seo'.
     */
    'site_title' => config('app.name', 'Laravel'),

    /**
     * this will be setup the default seo site description. read more about it in 'laravel-seo'.
     */
    'site_description' => 'All about ' . config('app.name', 'Laravel'),

    /**
     * Num of recent pages/posts displayed on frontend.
     */
    'site_recent_count' => 5,

    /**
     * this will be setup the default seo site color theme. read more about it in 'laravel-seo'.
     */
    'site_color' => '#F5F5F4',

    'header_menu' => 'main-header-menu',
];
