<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
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
            'section' => ProductSectionCollection::collection($this->product_section_id),
        ];
    }

    public $collects = Product::class;
}
