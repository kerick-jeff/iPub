<?php

namespace App\Providers;

use App\FileMetric;
use Illuminate\Support\ServiceProvider;

class FileMetricProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('App\FileMetric', function(){
          return new FileMetric();
      });
    }
}
