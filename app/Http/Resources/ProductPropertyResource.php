<?php

namespace App\Http\Resources;

use App\Models\ProductProperty;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPropertyResource extends JsonResource
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
         * @var ProductProperty $this
        */
        return [
            'name' => $this->name,
            'value' => $this->pivot->value
        ];
    }
}
