<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminWelcomeController;
use App\Http\Controllers\TaskDetailController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Use TasksController to pass data to the dashboard view
    Route::get('/dashboard', [TasksController::class, 'index'])->name('dashboard');
});;

// Admin Setup (if needed for initial setup)
Route::get('/admin-setup', [AdminWelcomeController::class, 'showAdminSetup'])->name('admin.setup');
Route::post('/admin-setup', [AdminWelcomeController::class, 'storeAdminCredentials'])->name('admin.store');

// Admin Routes (Requires Authentication and Admin Middleware)
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});





Route::put('/admin/users/update', [AdminController::class, 'update'])->name('admin.users.update');
Route::put('/tasks/edit/{id}', [TaskDetailController::class, 'edit'])->name('tasks.edit');
Route::get('/tasks/{id}', [TaskDetailController::class, 'index'])->name('tasks.index');
// Route for creating a task
Route::post('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');

Route::delete('/admin/users/delete', [AdminController::class, 'delete'])->name('admin.users.delete');
// Route for deleting a task

// Correct route for deleting a task
Route::delete('/tasks/delete/{id}', [TaskDetailController::class, 'delete'])->name('tasks.delete');;
Route::get('/tasks/{task}/assign', [TasksController::class, 'assignForm'])->name('tasks.assignForm');

// Route to handle the form submission
Route::post('/tasks/{task}/assign', [TasksController::class, 'assignUser'])->name('tasks.assignUser');
