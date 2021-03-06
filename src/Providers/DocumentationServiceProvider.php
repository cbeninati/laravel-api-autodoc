<?php

namespace RabbleRouser\ApiAutoDoc\Providers;

use Illuminate\Support\ServiceProvider;

class DocumentationServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app; // Set this to use $app->get() in the routes.
        require __DIR__ . '/../Http/routes.php';

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'api-autodoc');
        $this->publishes([
            __DIR__ . '/../../resources/views' => base_path('resources/views/vendor/api-autodoc'),
        ]);
        $this->publishes([
            __DIR__ . '/../../public/assets' => public_path('vendor/api-autodoc'),
        ], 'public');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('RabbleRouser\ApiAutoDoc\Http\Controllers\DocumentationController');
    }
}