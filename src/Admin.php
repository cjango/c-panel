<?php

namespace cjango\CPanel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

    public function registerRoutes()
    {
        Route::middleware(config('cpanel.route.middleware'))
            ->prefix(config('cpanel.route.prefix'))
            ->name('CPanel.')
            ->namespace('cjango\CPanel\Controllers')
            ->group(function ($router) {
                $router->get('auth/login', 'AuthController@login');
                $router->post('auth/login', 'AuthController@login');
                $router->get('auth/logout', 'AuthController@logout');
                $router->get('/', 'IndexController@index');
                $router->get('password', 'IndexController@password');
                $router->get('dashboard', 'IndexController@dashboard');

                $router->resource('admins', 'AdminController');
                $router->match(['get', 'post'], 'menus/{pid}/sort', 'MenusController@sort')->name('menus.sort');
                $router->resource('menus', 'MenuController');
                $router->resource('roles', 'RoleController');
                $router->get('logs', 'LogController@index');
            });
    }
}
