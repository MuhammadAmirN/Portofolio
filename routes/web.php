<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\AdminSkillController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [PortfolioController::class, 'storeContact'])->name('portfolio.contact');

// Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Dashboard Routes (Protected by Auth Middleware)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Skills Management CRUD
    Route::get('/skills', [AdminSkillController::class, 'index'])->name('admin.skills.index');
    Route::post('/skills', [AdminSkillController::class, 'store'])->name('admin.skills.store');
    Route::put('/skills/{skill}', [AdminSkillController::class, 'update'])->name('admin.skills.update');
    Route::delete('/skills/{skill}', [AdminSkillController::class, 'destroy'])->name('admin.skills.destroy');

    // Projects Management CRUD
    Route::get('/projects', [AdminProjectController::class, 'index'])->name('admin.projects.index');
    Route::post('/projects', [AdminProjectController::class, 'store'])->name('admin.projects.store');
    Route::put('/projects/{project}', [AdminProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy'])->name('admin.projects.destroy');

    // Messages Inbox Management
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('admin.messages.show');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('admin.messages.destroy');
});
