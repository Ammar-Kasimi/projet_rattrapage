<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('events', [EventController::class, 'index'])->name('events.index');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/events/{event}/participate', [ParticipationController::class, 'store'])->name('participations.store');
    Route::delete('/events/{event}/participate', [ParticipationController::class, 'destroy'])->name('participations.destroy');
    Route::get('/mes-evenements', [ParticipationController::class, 'index'])->name('participations.index');
    Route::put('/users/password/reset', [UserController::class, 'resetPassword'])->name('users.password.update');
    Route::resource('users', UserController::class)->except(['index', 'create', 'store']);
    
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [EventController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('events/create', [EventController::class, 'create'])->name('events.create');

        Route::resource('events', EventController::class)->except(['index', 'show', 'create']);
        Route::resource('categories', CategoryController::class)->except(['create', 'show']);
    });
});

Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');
