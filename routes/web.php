<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
// use App\Http\Controllers\ModuleContentController;
use App\Http\Controllers\ModuleContentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\NewsController;

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
    Route::get('/news/{moduleId}', [NewsController::class, 'show'])->name('news.show'); //Route to show news
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/login', function () {
        return redirect()->route('login');
    })->name('filament.auth.login');
    
});


Route::middleware(['auth', 'professor'])->group(function () {
    Route::get('quizzes/create', [QuizController::class, 'create'])->name('quizzes.create'); // Route to create a quiz
    Route::post('quizzes', [QuizController::class, 'store'])->name('quizzes.store'); // Route to store a new quiz
    Route::get('/news/create-news/{moduleId}', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news/store-news', [NewsController::class, 'store'])->name('news.store'); //Route to store new News
    Route::get('/news/{newsId}/edit', [NewsController::class, 'edit'])->name('news.edit'); // Route to show the form for editing a news item
    Route::put('/news/{newsId}', [NewsController::class, 'update'])->name('news.update'); // Route to update a news item
    Route::delete('/news/{newsId}', [NewsController::class, 'delete'])->name('news.delete'); // Route to delete a news item


});

Route::middleware(['auth', 'student'])->group(function () {
    Route::post('quizzes/{quiz}/attempt', [QuizController::class, 'attempt'])->name('quizzes.attempt'); // Route to submit a quiz attempt
    Route::get('quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show'); // Route to show a specific quiz
    Route::get('user/quizzes', [QuizController::class, 'userQuizzes'])->name('user.quizzes'); // Route to display user's quizzes
});

Route::get('/modules/{moduleFolderId}/content', [ModuleContentController::class, 'index'])->name('modules.content');

require __DIR__.'/auth.php'; // Include the routes defined in the routes/auth.php file for authentication related routes.


