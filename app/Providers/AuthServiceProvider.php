<?php

namespace Iplan\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \Iplan\Entity\Project::class => \Iplan\Policies\ProjectPolicy::class,
        \Iplan\Entity\WorkItem::class => \Iplan\Policies\WorkItemPolicy::class,
        \Iplan\Entity\User::class => \Iplan\Policies\UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
