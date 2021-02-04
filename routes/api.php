<?php

use App\Http\Controllers\TaskController;
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

Route::get('/tarefas', [TaskController::class, 'index'])->name('task.index');
Route::get('/tarefa/{id}', [TaskController::class, 'show'])->name('task.show');
Route::post('/tarefa/nova', [TaskController::class, 'store'])->name('task.store');
Route::put('/tarefa/{id}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/tarefa/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
