<?php

namespace cjango\CPanel\Commands;

use Illuminate\Console\Command;

class InitCommand extends Command
{

    protected $signature = 'admin:init';

    protected $description = '';

    public function handle()
    {
        $this->info('Init Admin Success');
    }

}
