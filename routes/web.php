<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
<<<<<<< Updated upstream
// use App\Http\Controllers\ModuleContentController;
use App\Http\Controllers\ModuleContentController;
=======
use App\Http\Controllers\ModuleContentController;

>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< Updated upstream
=======
// Auth Routes

Route::middleware('guest')->group(function () {
    // Registration routes (commented out as per your requirement)
    // Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    // Route::post('register', [RegisteredUserController::class, 'store']);
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
// Route to store a new quiz
Route::post('quizzes', [QuizController::class, 'store'])->name('quizzes.store');
=======
// Module Content Routes for students
Route::get('/modules/{module}/content', [ModuleContentController::class, 'index'])->name('modules.content');
>>>>>>> Stashed changes

// Route to show a specific quiz
Route::get('quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');

<<<<<<< Updated upstream
=======
Route::middleware(['auth', 'userType:professor'])->group(function () {
    Route::get('/professor-dashboard', function () {
        return view('professor.dashboard');
    })->name('professor.dashboard');
    // Add other professor-specific routes here
});
>>>>>>> Stashed changes
// Route to submit a quiz attempt
Route::post('quizzes/{quiz}/attempt', [QuizController::class, 'attempt'])->name('quizzes.attempt');

// Route to display user's quizzes
Route::get('user/quizzes', [QuizController::class, 'userQuizzes'])->name('user.quizzes');


<<<<<<< Updated upstream
//Route::get('/modules/{module}/content', 'ModuleContentController@index')->name('modules.content');  // Define routes in your routes/web.php file to handle requests to your content page.
Route::get('/modules/{module}/module/content',[ModuleContentController::class, 'index'])->name('modules.content'); 
// Route::get('/emails/{id}', [EmailController::class, 'show'])->name('email.show');  

require __DIR__.'/auth.php'; // Include the routes defined in the routes/auth.php file for authentication related routes.
=======

// Route::get('/modules/{module}/module/content',[ModuleContentController::class, 'index'])->name('modules.content'); 
Route::get('/modules/{moduleFolderId}/content', [ModuleContentController::class, 'index'])->name('modules.content');
>>>>>>> Stashed changes
