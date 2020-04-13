<?php

namespace Faithgen\AppBuild\Providers;

use Faithgen\AppBuild\Models\Build;
use Faithgen\AppBuild\Policies\BuildPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppBuildAuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Build::class => BuildPolicy::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
