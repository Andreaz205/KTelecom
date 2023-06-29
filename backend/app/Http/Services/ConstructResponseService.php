<?php

namespace App\Http\Services;

class ConstructResponseService
{
    public function storeEquipmentResource(array $success, array $errors): array
    {
        foreach ($success as $item) {
            $successItems[$item['key']] = $item['item'];
        }
        foreach ($errors as $key => $item) {
            $errorItems[$item['key']] = [$item['message']];
        }

        return [
            'success' => $successItems ?? [],
            'errors' => $errorItems ?? [],
        ];
    }
}
