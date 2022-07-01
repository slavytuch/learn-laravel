<?php

namespace App\Providers;

use App\Interfaces\Catalog\ProductInterface;
use App\Services\Catalog\ProductService;
use Illuminate\Support\ServiceProvider;

class CatalogProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductInterface::class, ProductService::class);
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
