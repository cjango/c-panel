<?php

namespace cjango\CPanel;

use cjango\CPanel\Commands\InitCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    protected $routeMiddleware = [
        'cpanel.auth'  => Middleware\Authenticate::class,
        'cpanel.guest' => Middleware\Guest::class,
        'cpanel.logs'  => Middleware\UserLog::class,
    ];

    /**
     * The application's route middleware groups.
     * @var array
     */
    protected $middlewareGroups = [
        'cpanel' => [
            // 'admin.auth',
            // 'admin.pjax',
            // 'admin.log',
            // 'admin.bootstrap',
            // 'admin.permission',
        ],
    ];

    public function boot()
    {
        $this->commands([
            InitCommand::class,
        ]);

        $this->publishes([__DIR__ . '/../config/cpanel.php' => config_path('cpanel.php')]);
        $this->publishes([__DIR__ . '/../resources/assets' => public_path('assets/cpanel')]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'CPanel');
        // $this->loadMigrationsFrom(__DIR__ . '/Resources/migrations');
    }

    public function register()
    {
        // 加载默认配置
        $this->mergeConfigFrom(
            __DIR__ . '/../config/cpanel.php', 'cpanel'
        );
        // 载入用户认证机制
        $this->loadAdminAuthConfig();
        // 注册中间件
        $this->registerRouteMiddleware();
        // 注册基础路由
        $this->registerAuthRoutes();
    }

    protected function loadAdminAuthConfig()
    {
        config(array_dot(config('cpanel.auth', []), 'auth.'));
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            Route::aliasMiddleware($key, $middleware);
        }

        foreach ($this->middlewareGroups as $key => $middleware) {
            Route::middlewareGroup($key, $middleware);
        }
    }

    protected function registerAuthRoutes()
    {
        Route::middleware('web')
            ->prefix(config('cpanel.route.prefix'))
            ->name('CPanel.')
            ->namespace('cjango\CPanel\Controllers')
            ->group(function ($router) {
                $router->get('auth/login', 'AuthController@login')->name('login');
                $router->post('auth/login', 'AuthController@login');
                $router->get('auth/logout', 'AuthController@logout');
                $router->get('/', 'IndexController@index');
                $router->get('password', 'IndexController@password');
                $router->get('dashboard', 'IndexController@dashboard');

                $router->match(['get', 'post'], 'menus/{pid}/sort', 'MenusController@sort')->name('menus.sort');
                $router->resource('menus', 'MenuController');
                $router->resource('roles', 'RoleController');
                $router->get('logs', 'LogController@index');
            });
    }

    protected function loadAdminRoutes()
    {
        Route::middleware('web', 'cpanel.logs')
            ->prefix(config('cpanel.route.prefix'))
            ->name('CPanel.')
            ->namespace('App\Admin\Controllers')
            ->group(__DIR__ . '/routes.php');
    }
}
