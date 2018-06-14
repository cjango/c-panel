<?php

return [

    'title' => 'CS.Admin',

    'route' => [
        'prefix'     => 'admin',
        'middleware' => ['web', 'cpanel'],
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
                'model'  => cjango\CPanel\Models\Admin::class,
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
