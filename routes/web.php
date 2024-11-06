<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Wilkommensseite
Route::get('/', function () {
    return view('welcome');
});

//Naviagtionsseite
Route::middleware(['auth'])->get('/overview', [DashboardController::class, 'overview'])->name('overview');


// Dashboard-Route mit Controller
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Project-Routen
Route::get('/projects', function () {
    return view('projects.index');
})->name('projects.index');

// Task Routen
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class);
});


// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
