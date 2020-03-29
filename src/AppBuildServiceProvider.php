<?php

namespace Faithgen\AppBuild;

use Faithgen\AppBuild\Models\Module;
use Faithgen\AppBuild\Models\Template;
use Faithgen\AppBuild\Observers\ModuleObserver;
use Faithgen\AppBuild\Observers\TemplateObserver;
use Faithgen\AppBuild\Services\BuildService;
use Faithgen\AppBuild\Services\ModuleService;
use Faithgen\AppBuild\Services\TemplateService;
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

        $this->setUpSourceFiles(function () {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('faithgen-build.php'),
            ], 'faithgen-build-config');

            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'faithgen-build-migrations');
        });

        if (!config('faithgen-sdk.source')) {
            $this->publishes([
                __DIR__ . '/../storage' => storage_path('app/public')
            ], 'faithgen-build-storage');
        }

        $this->app->singleton(ModuleService::class);
        $this->app->singleton(BuildService::class);
        $this->app->singleton(TemplateService::class);

        Module::observe(ModuleObserver::class);
        Template::observe(TemplateObserver::class);
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
            'middleware' => config('faithgen-build.middlewares'),
        ];
    }
}
