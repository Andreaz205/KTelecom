<?php

namespace App\Http\Controllers\Api\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DeleteController extends Controller
{
    public function __invoke(Equipment $equipment): JsonResponse
    {
        $equipment->delete();
        return Response::json(['message' => 'Запись удалена успешно!']);
    }
}
