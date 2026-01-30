<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewDatabaseController;

Route::get('/', function () {
    return view('welcome');
});

// -----its for practice route-----
// Route::get('/example', [NewDatabaseController::class, 'create']);
Route::get('/example', [NewDatabaseController::class, 'index'])->name('student.index');
Route::post('/example/store', [NewDatabaseController::class, 'store'])->name('student.store');
Route::post('/example/update/{id}', [NewDatabaseController::class, 'update'])->name('student.update');
Route::get('/example/delete/{id}', [NewDatabaseController::class, 'delete'])->name('student.delete');
Route::post('/example/delete-selected', [NewDatabaseController::class, 'deleteselected'])->name('student.deleteselected');
//     return view('example');
// });    