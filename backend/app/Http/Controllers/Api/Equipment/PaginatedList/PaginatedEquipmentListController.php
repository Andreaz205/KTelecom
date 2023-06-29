<?php

namespace App\Http\Controllers\Api\Equipment\PaginatedList;

use App\Http\Controllers\Controller;
use App\Http\Filters\EquipmentFilter;
use App\Http\Requests\Api\Equipment\ListRequest;
use App\Http\Resources\Api\Equipment\EquipmentResource;
use App\Models\Equipment;

class PaginatedEquipmentListController extends Controller
{
    private int $perPage = 5;

    public function __invoke(ListRequest $request)
    {
        $data = $request->validated();
        if (isset($data['q'])) {
            $q = $data['q'];
            $paginatedEquipment = Equipment::query()
                ->where('serial_number', 'ilike', '%'.$q.'%')
                ->orWhere('desc', 'ilike', '%'.$q.'%')
                ->orWhereHas('equipmentType', function ($query) use($q) {
                    $query->where('name', 'ilike', '%'.$q.'%');
                })->paginate($this->perPage);
        } else {
            $filter = app()->make(EquipmentFilter::class, ['queryParams' => array_filter($data)]);
            $paginatedEquipment = Equipment::filter($filter)->paginate($this->perPage);
        }
        return EquipmentResource::collection($paginatedEquipment);
    }
}
