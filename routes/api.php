<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\TasksController;
use \App\Http\Controllers\CommentsController;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'data'
], function ($router) {

    Route::get('/task', [TasksController::class, 'task']);
    Route::get('/task/{id}', [TasksController::class, 'taskById']);
    Route::get('/task/page{page}', [TasksController::class, 'taskPage']);
    Route::put('/task', [TasksController::class, 'store']);
    Route::post('/task', [TasksController::class, 'update']);
    Route::delete('/task', [TasksController::class, 'destroy']);

    Route::get('/comment', [TasksController::class, 'comment']);
    Route::get('/comment/{id}', [TasksController::class, 'commentPage']);
    Route::put('/comment', [TasksController::class, 'store']);
    Route::post('/comment', [TasksController::class, 'update']);
    Route::delete('/comment', [TasksController::class, 'destroy']);
});
