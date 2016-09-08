<?php

namespace Iplan\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register Dev Providers is necessary.
        if ($this->isRunningInDevMode()) {
            $this->registerDevProviders();
        }
    }
    
    /**
     * Check if application is in dev mode.
     *
     * @return bool
     */
    protected function isRunningInDevMode()
    {
        return $this->app->environment() == 'dev' || $this->app->environment() == 'local';
    }
    
    /**
     * Will register dev service providers.
     *
     * @return void
     */
    protected function registerDevProviders()
    {
        // Register Each Provider.
        collect(config('app.devProviders'))->each(function ($item) {
            $this->app->register($item);
        });
    }
}
