<?php

use App\Http\Controllers\api\ApiKeyController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\IngredientController;
use App\Http\Controllers\api\MaintenanceController;
use App\Http\Controllers\api\MealController;
use App\Http\Controllers\api\RecipeController;
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

Route::apiResource('recipes',RecipeController::class);
Route::apiResource('ingredients',IngredientController::class);
Route::apiResource('categories',CategoryController::class);
Route::apiResource('meals',MealController::class);
Route::apiResource('settings',MaintenanceController::class);
Route::apiResource('apikeys',ApiKeyController::class);

Route::post('maintenance',[MaintenanceController::class,'activeMaintenance'])->name('maintenance');

Route::middleware(['geoBlock'])->group(function (){
   # Route::apiResource('recipes',RecipeController::class);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
