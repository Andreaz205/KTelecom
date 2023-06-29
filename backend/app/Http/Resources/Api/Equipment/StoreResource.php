<?php

namespace App\Http\Resources\Api\Equipment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => StoreSuccessResource::collection($this['success'])->resolve(),
            'errors' => StoreErrorResource::collection($this['errors'])->resolve(),
        ];
    }
}
