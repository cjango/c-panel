<?php

namespace cjango\CPanel;

use Illuminate\Support\Facades\Auth;

class Admin
{

    public function user()
    {
        return Auth::guard('cpanel')->user();
    }

    public function guest()
    {
        return Auth::guard('cpanel')->guest();
    }

    public function id()
    {
        return Auth::guard('cpanel')->id();
    }

    public function attempt($certificates)
    {
        return Auth::guard('cpanel')->attempt($certificates);
    }

    public function logout()
    {
        return Auth::guard('cpanel')->logout();
    }
}
