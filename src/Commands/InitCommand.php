<?php

namespace cjango\CPanel\Commands;

use Artisan;
use Illuminate\Console\Command;

class InitCommand extends Command
{

    protected $signature = 'admin:init';

    protected $description = 'Create a new user for Admin';

    public function handle()
    {
        $res = Artisan::call('vendor:publish', [
            '--provider' => 'App\Admin\AdminServiceProvider',
        ]);
        $this->info('Admin Config Publishd');

        Artisan::call('migrate');
        $this->info('Admin Database Created');

        $provider = config('auth.guards.admin.provider');
        $model    = config('auth.providers.' . $provider . '.model');

        $admin = new $model;
        $admin->create(['username' => 'root', 'password' => '111111']);

        Artisan::call('db:seed', [
            '--class' => '\App\Admin\Resources\seeds\MenuTableSeeder',
        ]);
        $this->info('Init Admin Success');
    }

}
