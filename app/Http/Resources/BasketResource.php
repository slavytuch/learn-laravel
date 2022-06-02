<?php

namespace App\Http\Resources;

use App\Models\Basket;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
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
         * @var Basket $this
        */
        return [
            'id' => $this->id,
            'type' => $this->type,
            'items' => BasketProductResource::collection($this->products),
        ];
    }
}
