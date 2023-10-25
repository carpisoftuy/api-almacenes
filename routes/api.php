<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlmacenesController;
use App\Http\Controllers\BultosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("v1")->group(function(){

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('almacenes', [AlmacenesController::class, 'GetAlmacenes']);
    Route::get('almacenes/{id}', [AlmacenesController::class, 'GetAlmacen']);
    Route::post('almacenes', [AlmacenesController::class, 'CreateAlmacen']);
    Route::put('almacenes/{id}', [AlmacenesController::class, 'UpdateAlmacen']);
    Route::delete('almacenes/{id}', [AlmacenesController::class, 'DeleteAlmacen']);
    
    Route::get('bultos', [BultosController::class, 'GetBultos']);
    Route::get('bultos/{id}', [BultosController::class, 'GetBulto']);
    Route::post('bultos', [BultosController::class, 'CreateBulto']);
    Route::put('bultos/{id}', [BultosController::class, 'UpdateBulto']);
    Route::delete('bultos/{id}', [BultosController::class, 'DeleteBulto']);

});

Route::prefix("v2")->group(function(){

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('almacenes', [AlmacenesController::class, 'GetAlmacenes']);
    Route::get('almacenes/{id}', [AlmacenesController::class, 'GetAlmacen']);
    Route::post('almacenes', [AlmacenesController::class, 'CreateAlmacen']);
    Route::put('almacenes/{id}', [AlmacenesController::class, 'UpdateAlmacen']);
    Route::delete('almacenes/{id}', [AlmacenesController::class, 'DeleteAlmacen']);
    
    Route::get('bultos', [BultosController::class, 'GetBultos']);
    Route::get('bultos/{id}', [BultosController::class, 'GetBulto']);
    Route::post('bultos', [BultosController::class, 'CreateBulto']);
    Route::put('bultos/{id}', [BultosController::class, 'UpdateBulto']);
    Route::delete('bultos/{id}', [BultosController::class, 'DeleteBulto']);

});

