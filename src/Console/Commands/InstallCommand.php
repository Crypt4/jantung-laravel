<?php

namespace Crypt4\JantungLaravel\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jantung:install {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Jantung for Laravel';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'jantung-config',
            '--force' => $this->option('force') ?? false,
        ]);
        $this->info('Successfully installed Jantung');
    }
}
