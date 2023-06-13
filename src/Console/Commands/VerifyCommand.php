<?php

namespace Crypt4\JantungLaravel\Console\Commands;

use Illuminate\Console\Command;

class VerifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jantung:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify Jantung Configuration for the Application.';

    public function handle()
    {
        $this->info('Application Verification Status: '.(
            app('jantung')->verify() ? 'OK' : 'Failed')
        );
    }
}
