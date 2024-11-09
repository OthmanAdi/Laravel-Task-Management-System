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
    Route::get('/', [ProjectController::class, 'index'])->name('index');  // Alle Projekte anzeigen
    Route::get('create', [ProjectController::class, 'create'])->name('create');  // Formular für neues Projekt
    Route::post('store', [ProjectController::class, 'store'])->name('store');  // Projekt speichern
    Route::get('{project}/edit', [ProjectController::class, 'edit'])->name('edit');  // Projekt bearbeiten
    Route::put('{project}', [ProjectController::class, 'update'])->name('update');  // Projekt aktualisieren
    Route::get('{project}', [ProjectController::class, 'show'])->name('show');  // Details eines Projekts
    Route::delete('{project}', [ProjectController::class, 'destroy'])->name('destroy');  // Projekt löschen
});

// Routen für die Aufgaben (Tasks)
Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');  // Alle Aufgaben anzeigen
    Route::get('create', [TaskController::class, 'create'])->name('create');  // Formular für neue Aufgabe
    Route::post('store', [TaskController::class, 'store'])->name('store');  // Aufgabe speichern
    Route::get('{task}/edit', [TaskController::class, 'edit'])->name('edit');  // Aufgabe bearbeiten
    Route::put('{task}', [TaskController::class, 'update'])->name('update');  // Aufgabe aktualisieren
    Route::get('{task}', [TaskController::class, 'show'])->name('show');  // Details einer Aufgabe
    Route::delete('{task}', [TaskController::class, 'destroy'])->name('destroy');  // Aufgabe löschen
});

// Profil Routen
Route::middleware('auth')->group(function () {
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
