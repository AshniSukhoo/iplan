<?php

namespace Iplan\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    public $defer = true;
    
    /**
     * All Repositories with their bindings.
     *
     * @var array
     */
    protected $repositories = [
        \Iplan\Repositories\Contracts\Entity\AccountStatusRepository::class => \Iplan\Repositories\Entity\AccountStatusRepositoryEloquent::class
    ];
    
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
        // Bind all Repositories.
        foreach ($this->repositories as $repositoryInterface => $repositoryClass) {
            $this->app->bind($repositoryInterface, $repositoryClass);
        }
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return collect($this->repositories)->keys()->all();
    }
}
