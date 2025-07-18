<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizAttemptController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth:web', config('jetstream.auth_session'), 'auth.member', 'verified'])->group(function () {
    Route::get('/dashboard', [QuizAttemptController::class, 'history'])->name('dashboard');

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/{code}', [CourseController::class, 'findByCode'])->name('courses.show');
    });

    Route::get('/quiz/{slug}/start', [QuizAttemptController::class, 'start'])->name('quiz.start');
    Route::get('/quiz/attempt/{attempt:uuid}', [QuizAttemptController::class, 'showAttempt'])->name('quiz.attempt');
    Route::post('/quiz/attempt/{attempt}/answer', [QuizAttemptController::class, 'saveAnswer'])->name('quiz.answer');
    Route::post('/quiz/attempt/{attempt}/submit', [QuizAttemptController::class, 'submit'])->name('quiz.submit');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/quizzes', [HomeController::class, 'listQuizzes'])->name('list.quizzes');
Route::get('/quizzes/{slug}', [HomeController::class, 'show'])->name('quizzes.show');
Route::get('/filter-quizzes', [HomeController::class, 'filter'])->name('quizzes.filter');

Route::get('/quiz/result/{attempt:uuid}', [QuizAttemptController::class, 'showResult'])->name('quiz.result');
