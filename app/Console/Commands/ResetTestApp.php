<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetTestApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:reset-test-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the webapp and reseed all the test data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('down');
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('db:seed', [
            '--class' => 'TestDatabaseSeeder',
        ]);
        $this->call('up');
    }
}
