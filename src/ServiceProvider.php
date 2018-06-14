<?php

namespace cjango\CPanel;

use cjango\CPanel\Commands\InitCommand;
use cjango\CPanel\Facades\Admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    protected $routeMiddleware = [
        'cpanel.auth' => Middleware\Authenticate::class,
        'cpanel.log'  => Middleware\LogOperation::class,
    ];

    protected $middlewareGroups = [
        'cpanel' => [
            'cpanel.auth',
            'cpanel.log',
        ],
    ];

    protected $commands = [
        InitCommand::class,
    ];

    public function boot()
    {
        $this->commands($this->commands);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'CPanel');

        if (is_dir(admin_path('Views'))) {
            $this->loadViewsFrom(admin_path('Views'), 'Admin');
        }
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
        Admin::registerRoutes();
        // 加载自定义路由配置
        $this->loadAdminRoutes();
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

    protected function loadAdminRoutes()
    {
        if (file_exists(admin_path('routes.php'))) {
            Route::middleware(config('cpanel.route.middleware'))
                ->prefix(config('cpanel.route.prefix'))
                ->name('CPanel.')
                ->namespace('App\Admin\Controllers')
                ->group(admin_path('routes.php'));
        }
    }
}
