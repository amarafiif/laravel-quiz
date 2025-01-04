<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/{course}', [CourseController::class, 'show'])->name('courses.show');
        // Route::post('/', [CourseController::class, 'store'])->name('courses.store');
        // Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        // Route::put('/{course}', [CourseController::class, 'update'])->name('courses.update');
        // Route::delete('/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });
});
