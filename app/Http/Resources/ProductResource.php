<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\ProductSection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /**
         * @var $this Product
         */
        return [
            'name' => $this->name,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'section' => new ProductSectionResource(ProductSection::find($this->product_section_id)),
            'properties' => new Collection($this->properties)
        ];
    }
}
