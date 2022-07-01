<?php

namespace App\Casters;

use App\DTO\Catalog\ProductDTO;
use App\DTO\Catalog\ProductDTOCollection;
use Spatie\DataTransferObject\Caster;

class ProductDTOCollectionCaster implements Caster
{
    public function cast(mixed $value): ProductDTOCollection
    {
        return new ProductDTOCollection(
            array_map(fn(array $data) => new ProductDTO(...$data), $value)
        );
    }
}
