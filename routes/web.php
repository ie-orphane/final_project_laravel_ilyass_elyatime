<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified', 'double-auth'])->group(function () {
    Route::get('/dashboard', function () {
        $data = ['id' => auth()->id(), 'type' => 'User'];
        return view('dashboard', compact('data'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name("tasks")->group(function () {
        Route::get('/tasks', [TaskController::class, 'index']);
        Route::get('/tasks/all', [TaskController::class, 'all'])->name(".all");
        Route::get('/tasks/{team}', [TaskController::class, 'show'])->name(".show");
        Route::post('/tasks/{id}', [TaskController::class, 'store'])->name(".store");
        Route::put('/tasks/{id?}', [TaskController::class, 'update'])->name(".update");
    });

    Route::name("teams")->group(function () {
        Route::get('/teams', [TeamController::class, 'index']);
        Route::get('/teams/{team}', [TeamController::class, 'show'])->name('.show');
        Route::post('/teams', [TeamController::class, 'store'])->name(".store");
        Route::put('/teams/{id?}', [TeamController::class, 'update'])->name(".update");
        Route::put('/invite/{team}', [TeamController::class, 'invite'])->name(".invite");
    });
});

require __DIR__ . '/auth.php';
