<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/user', [UserController::class, 'showAllUsers']);

Route::get('/user/{id}', [UserController::class, 'showUser']);

Route::put('/user/{id}/update', [UserController::class, 'updateUser']);

Route::delete('/user/{id}/delete', [UserController::class, 'deleteUser']);


Route::get('/post', [PostController::class, 'showAllPosts']);

Route::get('/post/search', [PostController::class, 'search']);

Route::post('/post/register', [PostController::class, 'registerPost']);

Route::get('/post/{id}', [PostController::class, 'showPost']);

Route::put('/post/{id}/update', [PostController::class, 'updatePost']);

Route::delete('/post/{id}/delete', [PostController::class, 'deletePost']);