<?php

namespace cjango\CPanel;

use Illuminate\Support\Facades\Auth;

class Admin
{

    public function user()
    {
        return Auth::guard('cpanel')->user();
    }
}
