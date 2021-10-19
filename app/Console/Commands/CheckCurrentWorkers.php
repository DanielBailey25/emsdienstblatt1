<?php

namespace App\Console\Commands;

use App\Jobs\CheckCurrentWorkers as JobsCheckCurrentWorkers;
use Illuminate\Console\Command;

class CheckCurrentWorkers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkCurrentWorkers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Current workers if they are too long logged in, in one task';

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
     * @return int
     */
    public function handle()
    {
        dispatch(new JobsCheckCurrentWorkers());
        return 0;
    }
}
