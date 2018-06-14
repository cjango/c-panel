<?php

return [

    'title' => 'CS.Admin',

    'route' => [
        'prefix'     => 'admin',
        'middleware' => ['web'],
    ],

    'auth'  => [
        'guards'    => [
            'cpanel' => [
                'driver'   => 'session',
                'provider' => 'cpanel',
            ],
        ],

        'providers' => [
            'cpanel' => [
                'driver' => 'eloquent',
                'model'  => cjango\CPanel\Models\Administrator::class,
            ],
        ],
    ],

    'logs'  => [
        'enable' => true,
        'except' => [
            'admin/',
            'admin/dashboard',
            'admin/password',
            'admin/ueditor',
            'admin/logs*',
        ],
    ],
];
