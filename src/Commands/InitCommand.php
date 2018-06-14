<?php

namespace cjango\CPanel\Commands;

use cjango\CPanel\Models\Admin;
use Illuminate\Console\Command;

class InitCommand extends Command
{

    protected $signature = 'admin:init';

    protected $description = 'Init Admin';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--provider' => 'cjango\CPanel\ServiceProvider',
        ]);

        $this->call('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider',
            '--tag'      => 'migrations',
        ]);
        $this->call('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider',
            '--tag'      => 'config',
        ]);

        self::initDatabase();

        $this->info('Init Admin Success');
    }

    public function initDatabase()
    {
        $this->call('migrate');

        if (Admin::count() == 0) {
            $this->call('db:seed', ['--class' => AdminTablesSeeder::class]);
        }
    }
}
