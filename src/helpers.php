<?php

function admin_path($file = null)
{
    return app_path('Admin') . (!is_null($file) ? '/' . ltrim($file, '/') : '');
}

function admin_assets($file)
{
    return asset('assets/cpanel/' . $file);
}
