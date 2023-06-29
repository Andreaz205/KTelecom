<?php

namespace App\Http\Controllers\Api\Equipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Equipment\StoreRequest;
use App\Http\Resources\Api\Equipment\StoreResource;
use App\Http\Services\ConstructResponseService;
use App\Http\Services\ValidationService;
use App\Models\Equipment;
use App\Models\EquipmentType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class StoreController extends Controller
{
    private ValidationService $validationService;

    public function __construct(ValidationService $validationService)
    {
        $this->validationService = $validationService;
    }

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $requestedEquipmentTypeIds = collect($data['equipments'])
            ->map(fn ($item) => $item['equipment_type_id']);

        $requestedEquipmentTypes = EquipmentType::query()
            ->whereIn('id', $requestedEquipmentTypeIds)
            ->get(['id', 'mask']);
        $result = [
            'success' => [],
            'errors' => []
        ];
        try {
            DB::beginTransaction();
            foreach ($data['equipments'] as $key => $equipment) {
                $equipmentType = $requestedEquipmentTypes->find($equipment['equipment_type_id']);
                $validationData = $this->validationService->validateMask(
                    $equipment['serial_number'],
                    $equipmentType->mask
                );
                if (isset($validationData)) {
                    $result['errors'][] = [
                        'key' => $key,
                        'message' => $validationData
                    ];
                } else {
                    $newEquipment = Equipment::query()->create($equipment);
                    $result['success'][] = [
                        'key' => $key,
                        'item' => $newEquipment,
                    ];
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return Response::json(['message' => 'Непредвиденная ошибка'], 500);
        }
        $responseData = [
            'success' => $result['success'],
            'errors' => $result['errors']
        ];
        return StoreResource::make($responseData)->resolve();
    }
}
