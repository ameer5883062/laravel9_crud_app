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

Route::get('/students_list', [StudentsController::class, 'index']);
Route::post('/add_student', [StudentsController::class, 'store']);
Route::get('/view_student/{id}', [StudentsController::class, 'show']);
Route::get('/edit_student/{id}', [StudentsController::class, 'edit']);
Route::post('/update_student/{id}', [StudentsController::class, 'update']);
Route::delete('/delete_student/{id}', [StudentsController::class, 'destroy']);






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
