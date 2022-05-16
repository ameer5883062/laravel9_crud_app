<?php

use Illuminate\Support\Facades\Route;

// Students Controller
use App\Http\Controllers\StudentsController;

/*
|--------------------------------------------------------------------------
| Students Routes
|--------------------------------------------------------------------------
*/

Route::controller(StudentsController::class)->group(function () {
    Route::get('/',  'index');
    Route::get('/create_student', 'create');
    Route::post('/add_student', 'store');
    Route::get('/view_student/{id}', 'show');
    Route::get('/edit_student/{id}', 'edit');
    Route::post('/update_student/{id}', 'update');
    Route::delete('/delete_student/{id}', 'destroy');
});
