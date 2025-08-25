<?php 

namespace LaraCare\CvAgent\Providers;

use Illuminate\Support\ServiceProvider;
use LaraCare\CvAgent\Services\CvSectionsGenerator;

class CvAgentProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CvSectionsGenerator::class, function ($app) {
            return new CvSectionsGenerator();
        });
    }

    public function boot()
    {
        // Publier config si besoin
        $this->publishes([
            __DIR__.'/../config/cv-sections-generator.php' => config_path('cv-sections-generator.php'),
        ], 'config');
    }
}