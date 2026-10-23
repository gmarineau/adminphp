<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin path and middleware
    |--------------------------------------------------------------------------
    |
    | URI prefix of the admin and the middleware applied to all its routes.
    | Access is then granted by the callback given to AdminPhp::auth().
    |
    */

    'path' => env('ADMINPHP_PATH', 'admin'),

    'domain' => env('ADMINPHP_DOMAIN'),

    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Locales
    |--------------------------------------------------------------------------
    |
    | Locales available for translatable content. The first one is the
    | default locale: required translatable fields must be filled in it.
    |
    */

    'locales' => ['fr', 'en'],

    /*
    |--------------------------------------------------------------------------
    | Table prefix
    |--------------------------------------------------------------------------
    |
    | Prefix applied to every table owned by AdminPhp, to avoid collisions
    | with the tables of the host application.
    |
    */

    'table_prefix' => 'adminphp_',

];
