<?php

namespace Crypt4\JantungLaravel\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jantung:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test connectivity to Jantung API';

    public function handle()
    {
        $this->info('Connectivity to Jantung API is: '.(
            app('jantung')->test() ? 'Active' : 'Inactive')
        );
    }
}
