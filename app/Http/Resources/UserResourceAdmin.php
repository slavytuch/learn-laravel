<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResourceAdmin extends UserResource
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
         * @var User $this
         */
        return array_merge(parent::toArray($request), [
            'id' => $this->id,
            'detail_link' => route('admin.users.show', $this->id),
        ]);
    }
}
