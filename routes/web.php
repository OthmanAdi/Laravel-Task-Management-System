<?php

use App\Http\Controllers\ProjectController;
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
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
//     Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
//     Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
// });

// Project-Routen
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('projects', ProjectController::class);
});
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');




// Task Routen
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class);
});
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
