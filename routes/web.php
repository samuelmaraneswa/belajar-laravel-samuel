<?php

use App\Http\Controllers\Admin\WorkoutController as AdminWorkoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/workouts', [WorkoutController::class, 'index']);
Route::get('/workouts/suggest', [WorkoutController::class, 'suggest']);

Route::middleware('auth')->prefix('admin')->group(function() {
  Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

  // workouts MENU (card-card)
  Route::get('/workouts', [AdminWorkoutController::class, 'index'])->name('admin.workout.index');

  // workouts LIST (all / gym / home / dll)
  Route::get('/workouts/list', [AdminWorkoutController::class, 'list'])->name('admin.workout.list');

  // search & suggest
  Route::get('/workouts/suggest', [AdminWorkoutController::class, 'suggest'])->name('admin.workout.suggest');
  Route::get('/workouts/search', [AdminWorkoutController::class, 'search']);

  // CRUD
  Route::get('/workouts/create', [AdminWorkoutController::class, 'create'])->name('admin.workout.create');
  Route::post('/workouts/store', [AdminWorkoutController::class, 'store'])->name('admin.workout.store');
  Route::get('/workouts/{slug}', [AdminWorkoutController::class, 'show'])->name('admin.workout.show');
  Route::get('/workouts/{workout}/edit', [AdminWorkoutController::class, 'edit'])
    ->name('admin.workouts.edit');
  Route::delete('/workouts/{workout}', [AdminWorkoutController::class, 'destroy'])
    ->name('admin.workouts.destroy');
  Route::post('/workouts/{workout}/calculate', [AdminWorkoutController::class, 'calculate'])->name('admin.workout.calculate');
});
