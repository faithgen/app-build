<?php

namespace Faithgen\AppBuild;

use Faithgen\AppBuild\Services\BuildService;
use Faithgen\AppBuild\Services\ModuleService;
use FaithGen\SDK\Traits\ConfigTrait;
use Illuminate\Support\ServiceProvider;

class AppBuildServiceProvider extends ServiceProvider
{
    use ConfigTrait;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerRoutes(__DIR__ . '/../routes/build.php', __DIR__ . '/../routes/source.php');

        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('faithgen-build.php'),
        ], 'faithgen-build-config');

        $this->setUpSourceFiles(function () {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'faithgen-build-migrations');
        });

        $this->app->singleton(ModuleService::class);
        $this->app->singleton(BuildService::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'faithgen-build');

        // Register the main class to use with the facade
        $this->app->singleton('faithgen-build', function () {
            return new AppBuild;
        });
    }

    /**
     * @inheritDoc
     */
    function routeConfiguration(): array
    {
        return [
            'prefix' => config('faithgen-build.prefix'),
            'namespace' => "FaithGen\AppBuild\Http\Controllers",
            'middleware' => config('faithgen-build.middlewares'),
        ];
    }
}
