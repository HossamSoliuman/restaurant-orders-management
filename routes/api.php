<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resources([
        'category' => CategoryController::class,
    ]);
});

Route::apiResources(
    [
        'categories' => CategoryController::class,
    ],

);
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);
});
