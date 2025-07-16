<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('students.index');
});

Route::resource('students', StudentController::class);
Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');
