<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return Inertia::render('Welcome', ['tasks' => []]);
});

Route::get('/create', [TaskController::class, 'create'])->name('task.create');
Route::get('/batch', [TaskController::class, 'batch'])->name('task.batch');
Route::get('/generate', [TaskController::class, 'generate'])->name('task.generate');
