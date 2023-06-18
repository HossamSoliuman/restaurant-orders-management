<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\MenuItemImageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
//admin routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::delete('menuItems/deleted', [MenuItemController::class, 'deleted']);
    Route::delete('menuItems/force/{menuItem}', [MenuItemController::class, 'forceDestroy']);
    Route::get('menuItems/restore/{menuItem}', [MenuItemController::class, 'restore']);

    Route::prefix('dashboard/')->group(function(){
        Route::get('orders/chart-data', [DashboardController::class,'ordersChartData']);
        Route::get('orders/{startDate}/{endDate?}', [DashboardController::class,'totalOrders']);
        Route::get('total-users', [DashboardController::class,'totalUsers']);
        Route::get('/role/{user}/{role}',[DashboardController::class,'setUserRole']);
    });

    Route::resources([
        'category' => CategoryController::class,
        'menuItems' => MenuItemController::class,
        'menuItemImages' => MenuItemImageController::class,
        'offers' => OfferController::class,
        'roles' => RoleController::class,
        'posts' => PostController::class,
    ]);
});
// auth routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResources([
        'reviews' => ReviewController::class,
        'orders' => OrderController::class,
        'comments' => CommentController::class,
    ]);
    Route::post('logout', [AuthenticationController::class, 'logout']);
});
// public routes
Route::apiResources(
    [
        'categories' => CategoryController::class,
        'posts' => PostController::class,
    ],
    [
        'only' => ['show', 'index']
    ]
);


Route::apiResources(
    [
        'offers' => OfferController::class,
        'menuItems' => MenuItemController::class,

    ],
    [
        'only' => ['show']
    ]
);

Route::get('home/menu',[HomeController::class,'menu']);
Route::get('home/posts',[HomeController::class,'posts']);
Route::get('home/offers',[HomeController::class,'offers']);

