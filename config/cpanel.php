<?php

/**
 * 后台默认配置
 */
return [

    'version'   => '0.1.12',

    'title'     => 'C.Admin',

    'directory' => app_path('Admin'),

    'route'     => [
        'prefix'     => 'admin',
        'middleware' => ['web', 'cpanel'],
        'namespace'  => 'App\\Admin\\Controllers',
    ],

    'auth'      => [
        'guards'    => [
            'cpanel' => [
                'driver'   => 'session',
                'provider' => 'cpanel',
            ],
        ],

        'providers' => [
            'cpanel' => [
                'driver' => 'eloquent',
                'model'  => cjango\CPanel\Models\Admin::class,
            ],
        ],
    ],

    'logs'      => [
        'enable' => true,
        'except' => [
            '/',
            'dashboard',
            'password',
            'ueditor',
            'logs*',
        ],
    ],
];
