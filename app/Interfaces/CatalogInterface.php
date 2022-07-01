<?php

namespace App\Interfaces;

use App\DTO\Catalog\ProductDTO;

interface CatalogInterface
{
    public function getProduct(int|string $productId): ProductDTO;

    public function getProductList(int $limit, int $offset, int $page);
}
