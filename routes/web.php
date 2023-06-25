<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::get('/', [AuthController::class, 'showLoginForm']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // CSV upload and data processing
    Route::get('/upload-csv', [DataController::class, 'showUploadForm'])->name('upload.form');
    Route::post('/upload-csv', [DataController::class, 'uploadCsv'])->name('upload.csv');
	Route::post('/save-data', [DataController::class, 'saveData'])->name('save.data');

});
