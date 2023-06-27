<?php

namespace App\Http\Controllers\Api\Equipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Equipment\UpdateRequest;
use App\Http\Resources\Api\Equipment\EquipmentResource;
use App\Http\Services\ValidationService;
use App\Models\Equipment;
use App\Models\EquipmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class UpdateController extends Controller
{
    private ValidationService $validationService;
    public function __construct(ValidationService $validationService)
    {
        $this->validationService = $validationService;
    }

    /**
     * @throws ValidationException
     */
    public function __invoke(UpdateRequest $request, Equipment $equipment)
    {
        $data = $request->validated();
        $equipmentType = EquipmentType::query()->find($data['equipment_type_id']);
        $this->validationService->validateUniqueSerialNumber($data['serial_number'], $equipment->id);
        $validationData = $this->validationService->validateMask($data['serial_number'], $equipmentType->mask);
        if (isset($validationData))
            throw ValidationException::withMessages([
                'serial_number' => 'Указанный серийный номер не соответствует маске!'
            ]);
        $equipment->update($data);
        $equipment->refresh();
        return Response::json(['success' => EquipmentResource::make($equipment)->resolve()]);
    }
}
