<?php

use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('ip.auth')->prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks');
    Route::post('/', [TaskController::class, 'store'])->name('tasks');
    Route::post('/batch', [TaskController::class, 'groupStore'])->name('tasksBatch');
    Route::post('/generate', [TaskController::class, 'generateTask'])->name('tasksGenerate');
    Route::put('/{id}', [TaskController::class, 'update'])->name('task');
});
