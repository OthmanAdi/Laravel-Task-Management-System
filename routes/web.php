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
// Routen für die Projekte (Projects)
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('create', [ProjectController::class, 'create'])->name('create');
    Route::post('store', [ProjectController::class, 'store'])->name('store');
    Route::get('{project}/edit', [ProjectController::class, 'edit'])->name('edit');
    Route::put('{project}', [ProjectController::class, 'update'])->name('update');
    Route::get('{project}', [ProjectController::class, 'show'])->name('show');
    Route::delete('{project}', [ProjectController::class, 'destroy'])->name('destroy');
});

// Routen für die Aufgaben (Tasks)
Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('create', [TaskController::class, 'create'])->name('create');
    Route::post('store', [TaskController::class, 'store'])->name('store');
    Route::get('{task}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('{task}', [TaskController::class, 'update'])->name('update');
    Route::get('{task}', [TaskController::class, 'show'])->name('show');
    Route::delete('{task}', [TaskController::class, 'destroy'])->name('destroy');  
});

// Profil Routen
Route::middleware('auth')->group(function () {
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
