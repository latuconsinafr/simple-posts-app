<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
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
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::apiResource('posts', PostController::class)->middleware('auth:api');

Route::apiResource('comments', CommentController::class)->middleware('auth:api');

Route::get('/posts/{postId}/comments', [CommentController::class, 'indexByPostId']);
Route::delete('/posts/{postId}/comments', [CommentController::class, 'destroyByPostId']);