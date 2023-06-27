<?php

namespace App\Http\Services;

use App\Models\Equipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class ValidationService
{
    /**
     * @throws ValidationException
     */
    public function validateUniqueSerialNumber($serialNumber, $id): void
    {
        $sameEquipment = Equipment::query()
            ->where('serial_number', $serialNumber)
            ->whereNot('id', $id)
            ->first();

        if (isset($sameEquipment)) {
            throw ValidationException::withMessages([
                'serial_number' => "Такой серийный номер уже есть в системе!"
            ]);
        }
    }
    public function validateMask(string $serialNumber, string $mask): string|null
    {
        if (strlen($mask) !== strlen($serialNumber))
            return "Серийный номер не соответсвует маске";
        foreach (str_split($mask) as $maskKey => $maskSymbol) {
            foreach (str_split($serialNumber) as $serialNumberKey => $serialNumberSymbol) {
                if ($maskKey === $serialNumberKey) {
                    switch ($maskSymbol) {
                        case "N":
                             if (! $this->validate_N($serialNumberSymbol))
                                 return "Серийный номер не соответсвует маске";
                             break;
                        case "a":
                            if (! $this->validate_a($serialNumberSymbol))
                                return "Серийный номер не соответсвует маске";
                            break;
                        case "A":
                            if (! $this->validateA($serialNumberSymbol))
                                return "Серийный номер не соответсвует маске";
                            break;
                        case "Z":
                            if (! $this->validate_Z($serialNumberSymbol))
                                return "Серийный номер не соответсвует маске";
                            break;
                        case "X":
                            if (! $this->validate_X($serialNumberSymbol))
                                return "Серийный номер не соответсвует маске";
                            break;
                        default:
                            return 'Ошибка в маске, указан не допустимый символ';
                    }
                    continue 2;
                }
            }
            return "Длина серийного номера не соответствует маске";
        }
        return null;
    }

    private function validate_N(string $symbol): bool
    {
        return preg_match('/^[0-9]+$/', $symbol);
    }

    private function validateA (string $symbol): bool
    {
        return preg_match('/^[A-Z]+$/', $symbol);
    }

    private function validate_a (string $symbol): bool
    {
        return preg_match('/^[a-z]+$/', $symbol);
    }

    private function  validate_Z(string $symbol): bool
    {
        return preg_match('/^[-_@]+$/', $symbol);
    }

    private function validate_X (string $symbol): bool
    {
        return preg_match('/^[A-Z0-9]+$/', $symbol);
    }
}
