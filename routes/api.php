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
    Route::get('/task/page', [TasksController::class, 'taskPage']);
    Route::get('/task/id', [TasksController::class, 'taskId']);
    Route::get('/task/idwithcomments', [TasksController::class, 'taskIdWithComments']);
    Route::post('/task', [TasksController::class, 'store']);
    Route::put('/task', [TasksController::class, 'update']);
    Route::patch('/task', [TasksController::class, 'changeStatus']);
    Route::delete('/task', [TasksController::class, 'destroy']);

    Route::get('/comment', [CommentsController::class, 'comment']);
    Route::post('/comment', [CommentsController::class, 'store']);
});
