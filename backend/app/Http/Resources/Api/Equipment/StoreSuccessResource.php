<?php

namespace App\Http\Resources\Api\Equipment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreSuccessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this['key'] => EquipmentResource::make($this['item'])->resolve()
        ];
    }
}
