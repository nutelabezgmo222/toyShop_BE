<?php

use App\Models\Toy;

use App\Http\Controllers\ToyApiController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SubInformationController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

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

Route::get('/countries', [SubInformationController::class, '_GET_countries']);
Route::get('/genders', [SubInformationController::class, '_GET_genders']);
Route::get('/age_limits', [SubInformationController::class, '_GET_age_limits']);

Route::get('/categories', [CategoriesController::class, '_GET']);
Route::post('/category', [CategoriesController::class, '_POST_category']);
Route::post('/subcategory', [CategoriesController::class, '_POST_subcategory']);
Route::delete('/category/{id}', [CategoriesController::class, '_DELETE_category']);
Route::delete('/subcategory/{id}', [CategoriesController::class, '_DELETE_subcategory']);

Route::get('/admin/users', [AdminController::class, '_GET']);

Route::post('/login', [LoginController::class, '_POST_login']);
Route::post('/tokenLogin', [LoginController::class, '_POST_tokenLogin']);
Route::post('/registration', [LoginController::class, '_POST_registration']);
Route::get('/logout', [LoginController::class, '_GET_logout']);