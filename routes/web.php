<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Wilkommensseite
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login-dashboard',[DashboardController::class, 'loggin'])->name('loggin');

//Naviagtionsseite
Route::middleware(['auth'])->get('/overview', [DashboardController::class, 'overview'])->name('overview');



// Dashboard-Route mit Controller
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});


//Project-Routen
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
//     Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
//     Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
//     Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
//     Route::get('/projects{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
//     Route::get('projects{id}/update', [ProjectController::class, 'update'])->name('projects.update');
// });

// Project-Routen
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('projects', ProjectController::class);
});
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');






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
