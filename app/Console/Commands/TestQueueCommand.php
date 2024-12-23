<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;

class TestQueueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:test-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to running test queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // run TestJob
        dispatch(new TestJob())->delay(now()->addSeconds(5));

        $this->info('TestJob has been dispatched');
    }
}
