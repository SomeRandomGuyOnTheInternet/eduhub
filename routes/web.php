<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route to create a quiz
Route::get('quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');

// Route to store a new quiz
Route::post('quizzes', [QuizController::class, 'store'])->name('quizzes.store');

// Route to show a specific quiz
Route::get('quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');

// Route to submit a quiz attempt
Route::post('quizzes/{quiz}/attempt', [QuizController::class, 'attempt'])->name('quizzes.attempt');

// Route to display user's quizzes
Route::get('user/quizzes', [QuizController::class, 'userQuizzes'])->name('user.quizzes');


