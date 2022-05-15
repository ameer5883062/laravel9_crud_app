<?php

use Illuminate\Support\Facades\Route;

// Students Controller
use App\Http\Controllers\StudentsController;

/*
|--------------------------------------------------------------------------
| Students Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [StudentsController::class, 'index']);
Route::get('/create_student', [StudentsController::class, 'create']);
Route::post('/add_student', [StudentsController::class, 'store']);
Route::get('/view_student/{id}', [StudentsController::class, 'show']);
Route::get('/edit_student/{id}', [StudentsController::class, 'edit']);
Route::post('/update_student/{id}', [StudentsController::class, 'update']);
Route::delete('/delete_student/{id}', [StudentsController::class, 'destroy']);
