<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ModuleContentController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    // Registration routes (commented out as per your requirement)
    // Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    // Route::post('register', [RegisteredUserController::class, 'store']);

    // Login routes
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Password reset routes
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    // Email verification routes
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

    // Confirm password routes
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Update password route
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout route
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Dashboard Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Quiz Routes
Route::middleware('auth')->group(function () {
    Route::get('quizzes/create', [QuizController::class, 'create'])->name('quizzes.create')->middleware('userType:professor');
    Route::post('quizzes', [QuizController::class, 'store'])->name('quizzes.store')->middleware('userType:professor');
    Route::get('quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('quizzes/{quiz}/attempt', [QuizController::class, 'attempt'])->name('quizzes.attempt')->middleware('userType:student');
    Route::get('user/quizzes', [QuizController::class, 'userQuizzes'])->name('user.quizzes');
});

// Module Content Routes
Route::get('/modules/{module}/module/content', [ModuleContentController::class, 'index'])->name('modules.content');

// Student and Professor Dashboards
Route::middleware(['auth', 'userType:student'])->group(function () {
    Route::get('/student-dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
    // Add other student-specific routes here
});

Route::middleware(['auth', 'userType:professor'])->group(function () {
    Route::get('/professor-dashboard', function () {
        return view('professor.dashboard');
    })->name('professor.dashboard');
    // Add other professor-specific routes here
});
