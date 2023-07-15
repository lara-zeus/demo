<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Packagist Caching Settings
    |--------------------------------------------------------------------------
    */
    'caching' => [
        'enabled'               => env('PACKAGIST_CACHE_ENABLED', true),
        'vendorListCacheTime'   => env('PACKAGIST_VENDOR_LIST_CACHE_TIME_MINUTES', 100),
        'vendorItemCacheTime'   => env('PACKAGIST_VENDOR_ITEM_CACHE_TIME_MINUTES', 100),
    ],

    /*
    |--------------------------------------------------------------------------
    | Packagist CURL Settings
    |--------------------------------------------------------------------------
    */
    'curl' => [
        'timeout'       => env('PACKAGIST_CURL_TIMEOUT', 30),
        'maxredirects'  => env('PACKAGIST_CURL_MAX_REDIRECTS', 10),
    ],

    /*
    |--------------------------------------------------------------------------
    | Packagist API URLS
    |--------------------------------------------------------------------------
    */
    'urls' => [
        'vendorBase'     => env('PACKAGIST_API_VENDOR_URL_BASE', 'https://packagist.org/packages/list.json?vendor='),
        'projectPreFix'  => env('PACKAGIST_API_VENDOR_PROJECT_BASE_PREFIX', 'https://packagist.org/packages/'),
        'projectPostFix' => env('PACKAGIST_API_VENDOR_PROJECT_BASE_POSTFIX', '.json'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Packagist default vendor
    |--------------------------------------------------------------------------
    */
    'vendor' => [
        'default' => env('PACKAGIST_DEFAULT_VENDOR', 'jeremykenedy'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Packagist logging
    |--------------------------------------------------------------------------
    */
    'logging' => [
        'curlErrors' => env('PACKAGIST_LOG_CURL_ERROR', true),
    ],

];
