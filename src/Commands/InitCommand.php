<?php

namespace cjango\CPanel\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\MountManager;

class InitCommand extends Command
{

    protected $signature = 'admin:init';

    protected $description = 'Init Admin';

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        self::initConfig();
        self::initResource();
        self::initDatabase();

        $this->info('Init Admin Success');
    }

    public function initConfig()
    {
        $from = __DIR__ . '/../../config/cpanel.php';
        $to   = config_path('cpanel.php');

        if (!$this->files->exists($to)) {
            $this->createParentDirectory(dirname($to));
            $this->files->copy($from, $to);
            $this->info('Config File Init Success');
        }
    }

    public function initResource()
    {
        $from = __DIR__ . '/../../resources/assets';
        $to   = public_path('assets/cpanel');

        $this->moveManagedFiles(new MountManager([
            'from' => new Flysystem(new LocalAdapter($from)),
            'to'   => new Flysystem(new LocalAdapter($to)),
        ]));

        $this->info('Resource File Init Success');
    }

    public function initDatabase()
    {
        $this->call('migrate');

        if (Administrator::count() == 0) {
            $this->call('db:seed', ['--class' => \Encore\Admin\Auth\Database\AdminTablesSeeder::class]);
        }
    }

    protected function moveManagedFiles($manager)
    {
        foreach ($manager->listContents('from://', true) as $file) {
            if ($file['type'] === 'file' && (!$manager->has('to://' . $file['path']) || $this->option('force'))) {
                $manager->put('to://' . $file['path'], $manager->read('from://' . $file['path']));
            }
        }
    }

    protected function createParentDirectory($directory)
    {
        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }
}
