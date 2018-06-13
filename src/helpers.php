<?php

function cpanel_path()
{
    return app_apth('Admin');
}

function cpanel_assets($file)
{
    return asset('assets/cpanel/' . $file);
}
