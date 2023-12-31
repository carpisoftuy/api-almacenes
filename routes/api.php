<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlmacenesController;
use App\Http\Controllers\BultosController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\VehiculoController;

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

    Route::get('asignar/paquetes/', [BultosController::class, 'GetAllBultoContienePaquete']);
    Route::get('asignar/paquetes/{id}', [BultosController::class, 'GetBultoContienePaquete']);
    Route::post('asignar/paquetes', [BultosController::class, 'CreateBultoContienePaquete']);
    Route::put('asignar/paquetes/{id}', [BultosController::class, 'UpdateBultoContienePaquete']);
    Route::delete('/asignar/paquetes/{id}', [BultosController::class, 'DeleteBultoContienePaquete']);


    Route::get('paquetes', [PaqueteController::class, 'GetPaquetes']);
    Route::get('paquetes/{id}', [PaqueteController::class, 'GetPaquete']);
    Route::post('paquetes', [PaqueteController::class, 'CreatePaquete']);
    Route::put('paquetes/{id}', [PaqueteController::class, 'UpdatePaquete']);
    Route::delete('paquetes/{id}', [PaqueteController::class, 'DeletePaquete']);

    Route::get('ubicaciones', [UbicacionController::class, 'GetUbicaciones']);
    Route::get('ubicaciones/{id}', [UbicacionController::class, 'GetUbicacion']);
    Route::post('ubicaciones', [UbicacionController::class, 'CreateUbicacion']);
    Route::put('ubicaciones/{id}', [UbicacionController::class, 'UpdateUbicacion']);
    Route::delete('ubicaciones/{id}', [UbicacionController::class, 'DeleteUbicacion']);

    Route::get('camiones', [VehiculoController::class, 'GetCamiones']);
    Route::post('camiones', [VehiculoController::class, 'CargarBultoACamion']);

    Route::get('camionetas', [VehiculoController::class, 'GetCamionetas']);
    Route::post('camionetas', [VehiculoController::class, 'CargarPaqueteACamioneta']);

});

