<?php

namespace App\Providers;

use App\Interfaces\CatalogFilterInterface;
use App\Services\CatalogFilterService;
use Illuminate\Support\ServiceProvider;

class CatalogFilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CatalogFilterInterface::class, CatalogFilterService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
