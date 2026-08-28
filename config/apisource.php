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
        'auth_type' => 'bearer',
    ],

    // 'provider_name' => [
    //     'base_url' => env('BASE_URL'),
    //     'api_key' => env('API_KEY'),
    //     'timeout' => env('TIMEOUT', 30),
    //     'auth_type' => 'bearer', // or 'basic', 'none'

];