<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

$exceptRoutes = ['except' => ['edit', 'create']];
$exceptRoutesAuth = ['except' => ['show', 'index','edit','create']];

Route::resource("users", UserController::class, $exceptRoutes);
Route::resource("categories", CategoryController::class, $exceptRoutes);
Route::resource("posts", PostController::class, $exceptRoutes);

Route::middleware('auth:sanctum')->group(function () use ($exceptRoutesAuth) {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('categories', CategoryController::class, $exceptRoutesAuth);

    Route::resource('posts', PostController::class, $exceptRoutesAuth);

});


Route::post("login", array(AuthController::class, "authenticate"));
