<?php

use App\Http\Controllers\Admin\WorkoutController as AdminWorkoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\WorkoutController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/workouts', [WorkoutController::class, 'index']);
Route::get('/workouts/suggest', [WorkoutController::class, 'suggest']);

Route::middleware(['auth', 'admin', 'nocache'])->prefix('admin')->group(function() {
  Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

  // workouts MENU (card-card)
  Route::get('/workouts', [AdminWorkoutController::class, 'index'])->name('admin.workout.index');

  // workouts LIST (all / gym / home / dll)
  Route::get('/workouts/list', [AdminWorkoutController::class, 'list'])->name('admin.workout.list');

  // search & suggest
  Route::get('/workouts/suggest', [AdminWorkoutController::class, 'suggest'])->name('admin.workout.suggest');
  Route::get('/workouts/search', [AdminWorkoutController::class, 'search']);

  // AJAX pagination (no reload)
  Route::get('/workouts/ajax', [AdminWorkoutController::class, 'ajaxList'])
    ->name('admin.workout.ajax');

  // CRUD
  Route::get('/workouts/create', [AdminWorkoutController::class, 'create'])->name('admin.workout.create');
  Route::post('/workouts/store', [AdminWorkoutController::class, 'store'])->name('admin.workout.store');
  Route::get('/workouts/{slug}', [AdminWorkoutController::class, 'show'])->name('admin.workout.show');

  Route::get('/workouts/{workout}/edit', [AdminWorkoutController::class, 'edit'])->name('admin.workout.edit');
  Route::put('/workouts/{workout}', [AdminWorkoutController::class, 'update'])->name('admin.workout.update');

  Route::delete('/workouts/{workout}', [AdminWorkoutController::class, 'destroy'])
    ->name('admin.workout.destroy');
    
  Route::post('/workouts/{workout}/calculate', [AdminWorkoutController::class, 'calculate'])->name('admin.workout.calculate');
});

// ===============================
// WORKOUT PROGRAM (USER FLOW)
// ===============================
Route::get('/programs/generate', [ProgramController::class, 'create'])
  ->middleware(['auth', 'verified'])
  ->name('program.generate');

Route::post('/programs/generate', [ProgramController::class, 'store'])
  ->middleware(['auth', 'verified'])
  ->name('program.generate.store');

// =======================
// EMAIL & VERIFIED EMAIL
// =======================
Route::get('/test-email', function () {
  \Illuminate\Support\Facades\Mail::raw('Test email dari Laravel', function ($message) {
    $message->to('info@maskworkout.site')
      ->subject('Test SMTP');
  });

  return 'Email terkirim';
});

Route::get('/email/verify', function () {
  return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
  $user = User::findOrFail($id);

  // validasi hash email
  if (! hash_equals(
    sha1($user->getEmailForVerification()),
    $hash
  )) {
    abort(403);
  }

  // isi email_verified_at
  if (! $user->email_verified_at) {
    $user->markEmailAsVerified();
  }

  return redirect('/login')->with(
    'success',
    'Email berhasil diverifikasi. Silakan login.'
  );
})->middleware('signed')->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();
  return back()->with('success', 'Link verifikasi dikirim ulang.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ======
// USER
// ======
Route::get('/dashboard', [UserDashboardController::class, 'index'])
->middleware(['auth', 'verified'])
->name('user.dashboard');

// =========
// PROGRAMS 
// =========
Route::get('/programs/{program}', [ProgramController::class, 'show'])
  ->name('programs.show');

Route::get('/programs', [ProgramController::class, 'index'])
  ->name('programs.index');

Route::get('/programs/{program}/days/{day}', [ProgramController::class, 'showDay'])
  ->name('programs.days.show');
