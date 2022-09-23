<?php

use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\ClientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ClientsController::class)->group(function(){
    Route::get('/clients', [ClientsController::class, 'index']);
    Route::post('/clients/add', [ClientsController::class, 'create']);
    Route::get('/clients/search/{lastname}', [ClientsController::class, 'show']);
    Route::get('/clients/view/{id}', [ClientsController::class, 'edit']);
    Route::post('/clients/update/{id}', [ClientsController::class, 'update']);
    Route::delete('clients/delete/{id}', [ClientsController::class, 'destroy']);
});

Route::controller(AssistanceController::class)->group(function(){
    Route::get('/assistance', [AssistanceController::class, 'index']);
    Route::post('assistance/add', [AssistanceController::class, 'create']);
});
