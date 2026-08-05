<?php

return [

    /*
    |--------------------------------------------------------------------------
    | FirstClass Central API Configuration
    |--------------------------------------------------------------------------
    |
    | The base_url should not include the trailing /central path.
    | FirstClassClient appends the appropriate endpoint automatically.
    | For example:
    | - /ping is requested directly under the base URL.
    | - /central/rooms is built automatically by FirstClassClient.
    |
    | See FirstClassClient.php for implementation details.
    |
    */

    'base_url' => env('FIRSTCLASS_BASE_URL', 'https://classroom.eng.chula.ac.th/firstclass/wp-json/fcwm/v1'),

    'api_key' => env('FIRSTCLASS_API_KEY'),

    'timeout' => env('FIRSTCLASS_TIMEOUT', 30),

];