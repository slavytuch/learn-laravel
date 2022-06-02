<?php

namespace App\Http\Resources;

use App\Models\ProductSection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var $this ProductSection */
        return [
            'name' => $this->name,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
            'children' => $this->children ? new ProductSectionCollection($this->children) : 'no children'
        ];
    }
}
