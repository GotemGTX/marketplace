<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messenger Default User Model
    |--------------------------------------------------------------------------
    |
    | This option defines the default User model.
    |
     */

    'user' => [
        'model' => 'App\User',
    ],

    /*
    |--------------------------------------------------------------------------
    | Messenger Pusher Keys
    |--------------------------------------------------------------------------
    |
    | This option defines pusher keys.
    |
     */

    'pusher' => [
        'app_id' => '914189',
        'app_key' => '555b4763e74029fae0f9',
        'app_secret' => 'f3d2f57893b241df4735',
        'options' => [
            'cluster' => 'ap2',
            'encrypted' => true,
        ],
    ],
];
