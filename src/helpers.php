<?php

function admin_path($file = null)
{
    return app_path('Admin') . (!is_null($file) ? '/' . ltrim($file, '/') : '');
}

function admin_assets($file)
{
    return asset('assets/cpanel/' . $file);
}

function admin_url($path = '')
{
    $prefix = '/' . trim(config('cpanel.route.prefix'), '/');
    $prefix = ($prefix == '/') ? '' : $prefix;
    return $prefix . '/' . trim($path, '/');
}
