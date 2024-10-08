<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\IngredientController;
use App\Http\Controllers\api\MealController;
use App\Http\Controllers\api\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
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

#Route::get('users',[\App\Http\Controllers\AuthController::class,'index']);
#Route::post('login',[\App\Http\Controllers\AuthController::class,'login'])->middleware('guest')->name('login');
#Route::post('register',[\App\Http\Controllers\AuthController::class,'register'])->middleware('guest')->name('register');
#Route::delete('logout',[\App\Http\Controllers\AuthController::class,'logout'])->middleware('auth')->name('logout');

#Api public
#Route::get('/generateRecipes',[RecipeController::class,'search'])->middleware('auth');
#Route::apiResource('recipes',RecipeController::class);
Route::apiResource('ingredients',IngredientController::class);
Route::apiResource('categories',CategoryController::class);
Route::apiResource('meals',MealController::class);
#Route::post('/maintenance',[\App\Http\Controllers\MaintenanceController::class])->name('toggleMaintenance');

Route::post('maintenance',[\App\Http\Controllers\MaintenanceController::class,'activeMaintenance'])->name('active');

Route::middleware(['geoBlock'])->group(function (){
    Route::apiResource('recipes',RecipeController::class);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
