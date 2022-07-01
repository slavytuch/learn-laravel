<?php

namespace App\Services;

use App\Interfaces\Catalog\ProductInterface;
use App\Models\Product;

class CatalogService implements ProductInterface
{
    public function getById($productId)
    {
        Product::whereId($productId)->get();
    }
}
