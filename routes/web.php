<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified', 'double-auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/calander', function () {
        $backgroundColors = [
            'to do' => '#ef4444',
            'in progress' => '#d97706',
            'done' => '#10b981',
        ];

        $tasks = Task::all()->map(fn ($task) => [
            ...$task->toArray(),
            "backgroundColor" => $backgroundColors[$task->status],
        ]);
        
        return response()->json([
            "events" => $tasks
        ]);
    });

    Route::name("tasks")->group(function () {
        Route::get('/tasks', [TaskController::class, 'index']);
        Route::post('/tasks', [TaskController::class, 'store'])->name(".store");
        Route::put('/tasks/{id?}', [TaskController::class, 'update'])->name(".update");
    });
});

require __DIR__ . '/auth.php';
