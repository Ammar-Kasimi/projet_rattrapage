<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name("login");
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('events', EventController::class);
Route::resource('categories', CategoryController::class)->except(['create', 'show']);

Route::get('/admin/dashboard', [EventController::class, 'dashboard'])->name('admin.dashboard');

Route::post('/events/{event}/participate', [ParticipationController::class, 'store'])->name('participations.store');
Route::post('/events/{event}/participate', [ParticipationController::class, 'store'])
    ->name('participations.store');
Route::get('/mes-evenements', [ParticipationController::class, 'index'])->name('participations.index');
Route::delete('/events/{event}/participate', [ParticipationController::class, 'destroy'])->name('participations.destroy');
