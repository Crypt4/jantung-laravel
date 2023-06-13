<?php

namespace Crypt4\JantungLaravel;

use Crypt4\JantungLaravel\Console\Commands\InstallCommand;
use Crypt4\JantungLaravel\Console\Commands\TestCommand;
use Crypt4\JantungLaravel\Console\Commands\VerifyCommand;
use Illuminate\Support\ServiceProvider;

class JantungServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/../config/jantung.php' => config_path('jantung.php'),
        ], 'jantung-config');

        $this->mergeConfigFrom(
            __DIR__.'/../config/jantung.php', 'jantung'
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                TestCommand::class,
                VerifyCommand::class,
            ]);
        }

        if (! config('jantung.enabled')) {
            return;
        }

        app()->singleton('jantung', function () {
            return \Crypt4\JantungLaravel\Transporter::make();
        });

        foreach (config('jantung.observe') as $event => $listeners) {
            foreach ($listeners as $listener) {
                app()['events']->listen($event, $listener);
            }
        }

    }
}
