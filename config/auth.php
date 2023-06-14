<?php

return [


    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
    'guards' => [
        'api' => [
//            'driver' => 'jwt',
//            'provider' => 'admins',
            'driver' => 'jwt', // or 'sanctum' depending on your setup
            'provider' => 'admins',
            'hash' => false,
            'redirect' => null,
            'login_path' => 'auth/login',
            'paths' => [
                'api/*',
            ],
            'allowed_methods' => ['*'],
            'except' => [],
        ],
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ]

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

    ],
    'password_timeout' => 10800,
];
