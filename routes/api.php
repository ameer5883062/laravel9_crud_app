<?php


// Students Controller Api
use App\Http\Controllers\Apis\StudentsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::controller(StudentsController::class)->group(function () {
    Route::get('/students_list', 'index');
    Route::post('/add_student', 'store');
    Route::get('/view_student/{id}', 'show');
    Route::get('/edit_student/{id}', 'edit');
    Route::post('/update_student/{id}', 'update');
    Route::delete('/delete_student/{id}', 'destroy');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
