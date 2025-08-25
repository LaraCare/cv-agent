<?php 

namespace LaraCare\CvAgent\Providers;

use Illuminate\Support\ServiceProvider;
use LaraCare\CvAgent\Services\CvSectionsGenerator;

class CvAgentProvider extends ServiceProvider
{
    public function register()
    {
        // Bind ton service principal
        $this->app->singleton('cv-agent', function ($app) {
            return new CvAgent();
        });
    }

    public function boot()
    {
        // Charger routes si besoin
        // if (file_exists(__DIR__.'/../routes/web.php')) {
        //     $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        // }

        // Charger migrations si besoin
        // if (is_dir(__DIR__.'/../database/migrations')) {
        //     $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // }

        // Publier config
        $this->publishes([
            __DIR__.'/../../config/cv-agent.php' => config_path('cv-agent.php'),
        ], 'config');
    }
}