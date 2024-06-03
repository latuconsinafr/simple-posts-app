<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
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

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::middleware('auth:api')->get('', 'me');

    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('posts', PostController::class);
    Route::get('/posts/{postId}/comments', [CommentController::class, 'indexByPostId']);
    Route::delete('/posts/{postId}/comments', [CommentController::class, 'destroyByPostId']);

    Route::apiResource('comments', CommentController::class);

    Route::middleware('checkRole:admin')->group(function () {
        Route::apiResource('users', UserController::class);
    });

    Route::middleware('checkRole:user')->group(function () {
    });
});
