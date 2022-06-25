<?php

use App\Models\Toy;

use App\Http\Controllers\ToyApiController;
use App\Http\Controllers\BrandController;

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

Route::get('/toys', [ToyApiController::class, '_GET']);
Route::post('/toys', [ToyApiController::class, '_POST']);
Route::patch('/toys/{id}', [ToyApiController::class, '_PATCH']);
Route::delete('/toys/{id}', [ToyApiController::class, '_DELETE']);

Route::get('/brands', [BrandController::class, '_GET']);
Route::post('/brands', [BrandController::class, '_POST']);
Route::delete('/brands/{id}', [BrandController::class, '_DELETE']);