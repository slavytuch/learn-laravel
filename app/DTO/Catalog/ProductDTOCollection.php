<?php

namespace App\DTO\Catalog;

use Illuminate\Support\Collection;

class ProductDTOCollection extends Collection
{
    public function offsetGet($key): ProductDTO
    {
        return parent::offsetGet($key);
    }
}
