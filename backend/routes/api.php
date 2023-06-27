<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'equipment'], function () {
    Route::get('/', \App\Http\Controllers\Api\Equipment\PaginatedList\PaginatedEquipmentListController::class);

    Route::get('/{equipment}', \App\Http\Controllers\Api\Equipment\EquipmentByIdController::class);
    Route::post('/', \App\Http\Controllers\Api\Equipment\StoreController::class);
    Route::put('/{equipment}', \App\Http\Controllers\Api\Equipment\UpdateController::class);
    Route::delete('/{equipment}', \App\Http\Controllers\Api\Equipment\DeleteController::class);
});

Route::get('/equipment-type', \App\Http\Controllers\Api\Equipment\PaginatedList\PaginatedEquipmentTypeListController::class);
