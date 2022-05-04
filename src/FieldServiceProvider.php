<?php

namespace PixelCreation\NovaFieldSortable;

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-field-sortable', __DIR__ . '/../dist/js/field.js');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerRoutes();
    }

    /**
     * Registers field routes
     *
     * @return void
     */
    private function registerRoutes(): void
    {
        Route::domain(config('nova.domain', null))
            ->middleware(config('nova.middleware', []))
            ->prefix('/nova-vendor/pixelcreation/nova-field-sortable')
            ->group(__DIR__ . '/Http/Routes/api.php');
    }
}
