<?php

return [
    /**
     * set the default path for the blogs homepage.
     */
    'path' => 'sky',

    /**
     * the middleware you want to apply on all the blogs routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    'middleware' => ['web'],

    /**
     * set the prefix for posts URL.
     */
    'post_uri_prefix' => 'post',

    /**
     * set the prefix for pages URL.
     */
    'page_uri_prefix' => 'page',

    /**
     * set the prefix for library URL.
     */
    'library_uri_prefix' => 'sky/library',

    /**
     * customize the models
     */
    'models' => [
        'faq' => \LaraZeus\Sky\Models\Faq::class,
        'post' => \LaraZeus\Sky\Models\Post::class,
        'postStatus' => \LaraZeus\Sky\Models\PostStatus::class,
        'tag' => \LaraZeus\Sky\Models\Tag::class,
        'library' => \LaraZeus\Sky\Models\Library::class,
    ],

    /**
     * enable or disable individual Resources.
     */
    'enabled_resources' => [
        LaraZeus\Sky\Filament\Resources\PostResource::class,
        LaraZeus\Sky\Filament\Resources\PageResource::class,
        LaraZeus\Sky\Filament\Resources\TagResource::class,
        LaraZeus\Sky\Filament\Resources\FaqResource::class,
        LaraZeus\Sky\Filament\Resources\LibraryResource::class,
    ],

    /**
     * set the prefix for FAQ URL.
     */
    'faq_uri_prefix' => 'sky/faq',

    /**
     * this will be setup the default seo site title. read more about it in 'laravel-seo'.
     */
    'site_title' => config('app.name', 'Laravel').' | Blogs',

    /**
     * this will be setup the default seo site description. read more about it in 'laravel-seo'.
     */
    'site_description' => 'All about '.config('app.name', 'Laravel').' Blogs',

    /**
     * Num of recent pages/posts displayed on frontend.
     */
    'site_recent_count' => 5,

    /**
     * this will be setup the default seo site color theme. read more about it in 'laravel-seo'.
     */
    'site_color' => '#F5F5F4',

    /**
     * you can use the default layout as a starting point for your blog.
     * however, if you're already using your own component, just set the path here.
     */
    'layout' => 'zeus::components.app',
    //'layout' => 'zeus-sky::themes.artemis.app',

    /**
     * the default theme, for now we only have one theme, and soon we will provide more free and premium themes.
     */
    'theme' => 'zeus',
    //'theme' => 'artemis',

    /**
     * css class to apply on found search result, e.g. `bg-yellow-400`.
     */
    'search_result_highlight_css_class' => 'highlight',

    /**
     * available locales, this currently used only in tags manager.
     */
    'translatable_Locales' => ['en', 'ar'],

    /**
     * Navigation Group Label
     */
    'navigation_group_label' => 'Sky',

    /**
     * default featured image, set to null to disable it.
     * ex: https://placehold.co/600x400
     */
    'default_featured_image' => null,

    /**
     * these types help you to render the items in the FE
     * set it to null to hide it from the form
     */
    'library_types' => [
        'FILE' => 'File',
        'IMAGE' => 'Image',
        'VIDEO' => 'Video',
    ],

    /**
     * you can add more types to the Tags
     */
    'tags_types' => [
        'tag' => 'Tag',
        'category' => 'Category',
        'library' => 'Library',
        'faq' => 'faq',
    ],
];
