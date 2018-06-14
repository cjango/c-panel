<?php

namespace cjango\CPanel\Facades;

use Illuminate\Support\Facades\Facade;

class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \cjango\CPanel\Admin::class;
    }
}
