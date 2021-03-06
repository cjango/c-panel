<?php

namespace cjango\CPanel;

use cjango\CPanel\Commands\InstallCommand;
use cjango\CPanel\Commands\MakeCommand;
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
        InstallCommand::class,
        MakeCommand::class,
    ];

    public function boot()
    {
        $this->commands($this->commands);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'CPanel');

        if (is_dir(admin_path('Views'))) {
            $this->loadViewsFrom(admin_path('Views'), 'Admin');
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/cpanel.php' => config_path('cpanel.php')]);
            $this->publishes([__DIR__ . '/../config/captcha.php' => config_path('captcha.php')]);
            $this->publishes([__DIR__ . '/../config/permission.php' => config_path('permission.php')]);

            $this->publishes([__DIR__ . '/../resources/assets' => public_path('assets/cpanel')]);
            $this->publishes([__DIR__ . '/../database/migrations' => database_path('migrations')]);
        }
    }

    public function register()
    {
        // 加载默认配置
        $this->mergeConfigFrom(__DIR__ . '/../config/cpanel.php', 'cpanel');
        $this->mergeConfigFrom(__DIR__ . '/../config/captcha.php', 'captcha');
        $this->mergeConfigFrom(__DIR__ . '/../config/permission.php', 'permission');
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
