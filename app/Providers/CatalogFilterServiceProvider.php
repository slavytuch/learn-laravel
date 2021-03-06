<?php

namespace App\Providers;

use App\Interfaces\Catalog\FilterInterface;
use App\Services\FilterService;
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
        $this->app->bind(FilterInterface::class, FilterService::class);
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
