<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskDetailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminWelcomeController;
use App\Http\Middleware\IsAdmin;

// Public route
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    
    // 🟢 Boards Routes

Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');
   Route::get('/boards/{id}', [BoardController::class, 'show'])->name('boards.show'); // Show a specific board
    Route::post('/boards', [BoardController::class, 'store'])->name('boards.store'); // Create a new board

    // 🟢 Tasks Routes (Nested under boards)
    Route::prefix('/boards/{board_id}/tasks')->group(function () {
        Route::get('/', [TasksController::class, 'index'])->name('tasks.index'); // List tasks for a board
        Route::post('/', [TasksController::class, 'store'])->name('tasks.store'); // Create a task
    });

    // 🟢 Task Operations (Not tied directly to boards)
    Route::put('/tasks/{task_id}', [TasksController::class, 'update'])->name('tasks.update'); // Update a task
    Route::delete('/tasks/{task_id}', [TasksController::class, 'destroy'])->name('tasks.destroy'); // Delete a task
    
    // Assign users to tasks
    Route::get('/tasks/{taskId}/assign', [TasksController::class, 'assignForm'])->name('tasks.assignForm'); // Show assign form
    Route::post('/tasks/{task}/assign', [TasksController::class, 'assignUser'])->name('tasks.assignUser'); // Assign user to task
});

// 🟢 Admin Setup (Initial Setup for Admin Account)
Route::get('/admin-setup', [AdminWelcomeController::class, 'showAdminSetup'])->name('admin.setup');
Route::post('/admin-setup', [AdminWelcomeController::class, 'storeAdminCredentials'])->name('admin.store');

// 🟢 Admin Routes (Protected with Middleware)
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::put('/admin/users/update', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/delete', [AdminController::class, 'delete'])->name('admin.users.delete');
});