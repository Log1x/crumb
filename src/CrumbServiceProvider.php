<?php

namespace Log1x\Crumb;

use Roots\Acorn\ServiceProvider;

class CrumbServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('crumb', function () {
            return new Crumb(
                $this->app['config']->get('breadcrumb')
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/../config/breadcrumb.php' => $this->app->configPath('breadcrumb.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/breadcrumb.php',
            'breadcrumb'
        );

        add_filter('after_setup_theme', function () {
            return $this->app->make('crumb');
        });
    }
}
