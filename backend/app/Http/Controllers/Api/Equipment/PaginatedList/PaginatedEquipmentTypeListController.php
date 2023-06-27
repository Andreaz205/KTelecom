<?php

namespace App\Http\Controllers\Api\Equipment\PaginatedList;

use App\Http\Controllers\Controller;
use App\Http\Filters\EquipmentFilter;
use App\Http\Filters\EquipmentTypeFilter;
use App\Http\Requests\Api\EquipmentType\ListRequest;
use App\Http\Resources\Api\Equipment\EquipmentResource;
use App\Http\Resources\Api\EquipmentType\EquipmentTypeResource;
use App\Models\Equipment;
use App\Models\EquipmentType;

class PaginatedEquipmentTypeListController extends Controller
{
    private int $perPage = 5;

    public function __invoke(ListRequest $request)
    {
        $data = $request->validated();
        if (isset($data['q'])) {
            $q = $data['q'];
            $paginatedEquipment = EquipmentType::query()
                ->where('name', 'ilike', '%'.$q.'%')
                ->orWhere('mask', 'ilike', '%'.$q.'%')
                ->paginate($this->perPage);
        } else {
            $filter = app()->make(EquipmentTypeFilter::class, ['queryParams' => array_filter($data)]);
            $paginatedEquipment = EquipmentType::filter($filter)->paginate($this->perPage);
        }
        return EquipmentTypeResource::collection($paginatedEquipment);
    }
}
