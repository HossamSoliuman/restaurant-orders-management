<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemController;
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


Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('logout', [AuthenticationController::class, 'logout']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::delete('menuItems/deleted',[MenuItemController::class,'deleted']);
    
    Route::resources([
        'category' => CategoryController::class,
        'menuItems' => MenuItemController::class,
    ]);
    Route::delete('menuItems/force/{menuItem}',[MenuItemController::class,'forceDestroy']);
    Route::get('menuItems/restore/{menuItem}',[MenuItemController::class,'restore']);
});


Route::apiResources(
    [
        'categories' => CategoryController::class,
        'menuItems' => MenuItemController::class,

    ],
    ['only' => ['show', 'index']]
);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);
});
