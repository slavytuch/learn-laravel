<?php

namespace App\DTO\Catalog;

use Spatie\DataTransferObject\DataTransferObject;

class ProductDTO extends DataTransferObject
{
    public int $id;
    public string $name;
    public bool $active = true;
    public ?string $code;
    public float|array $price;
    public int|float $quantity;
    public ?ProductSectionDTO $section;
    public int|string|null $picture;
    public string|\DateTime $dateCreate;
    public string|\DateTime $dateChange;
}
