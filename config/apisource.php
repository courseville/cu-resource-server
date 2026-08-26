<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Source Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the configuration for API sources used in the application.
    |
    */

    'firstclass' => [
        'base_url' => env('FIRSTCLASS_BASE_URL', 'https://classroom.eng.chula.ac.th/firstclass/wp-json/fcwm/v1/central'),
        'api_key' => env('FIRSTCLASS_API_KEY'),
        'timeout' => env('FIRSTCLASS_TIMEOUT', 30),
        'pagination' => [
            'enabled' => true,
            'type' => 'page',

            // request params
            'page_param' => 'page',
            'per_page_param' => 'per_page',

            // response paths
            'data_path' => 'data',
            'total_pages_path' => 'meta.total_pages',
            'total_path' => 'meta.total',

            // page sizes
            'per_page' => 500,
        ],
    ],

    // 'provider_name' => [
    //     'base_url' => env('BASE_URL'),
    //     'api_key' => env('API_KEY'),
    //     'timeout' => env('TIMEOUT', 30),
    //     'pagination' => [
    //         'enabled' => false,
    //         'type' => 'page',

    //         // request params
    //         'page_param' => 'page',
    //         'per_page_param' => 'per_page',

    //         'offset_param' => 'offset',
    //         'limit_param' => 'limit',

    //         'cursor_param' => 'cursor',

    //         // response paths
    //         'data_path' => 'data',
    //         'total_pages_path' => null,
    //         'total_path' => null,
    //         'next_cursor_path' => 'meta.next_cursor',
    //         'next_url_path' => 'links.next',

    //         // page sizes
    //         'per_page' => 100,
    //         'limit' => 100,
    //     ],
    // ],

];