<?php

namespace App\Http\Controllers\Api\Equipment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Equipment\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentByIdController extends Controller
{
    public function __invoke(Equipment $equipment): array
    {
        $equipment->load('equipment_type');
        return EquipmentResource::make($equipment)->resolve();
    }
}
