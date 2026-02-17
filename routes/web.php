<?php

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\BlogTemaController;
use App\Http\Controllers\Admin\WorkoutController as AdminWorkoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\BlogController as PublicBlogController;
use App\Http\Controllers\BlogPostController as PublicBlogPostController;
use App\Http\Controllers\FoodController as PublicFoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProgramController as UserProgramController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutSetController;
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

  // =====================
  // BLOG – CATEGORY
  // =====================
  Route::get('/blog/categories', [BlogCategoryController::class, 'index'])
    ->name('admin.blog.categories.index');

  Route::post('/blog/categories', [BlogCategoryController::class, 'store'])
    ->name('admin.blog.categories.store');

  Route::put('/blog/categories/{blogCategory}', [BlogCategoryController::class, 'update'])
    ->name('admin.blog.categories.update');

  Route::delete('/blog/categories/{blogCategory}', [BlogCategoryController::class, 'destroy'])
    ->name('admin.blog.categories.destroy');

  // =====================
  // BLOG – TEMA
  // =====================
  Route::get('/blog/tema', [BlogTemaController::class, 'index'])
    ->name('admin.blog.tema.index');

  Route::post('/blog/tema', [BlogTemaController::class, 'store'])
    ->name('admin.blog.tema.store');

  Route::put('/blog/tema/{blogTema}', [BlogTemaController::class, 'update'])
    ->name('admin.blog.tema.update');

  Route::delete('/blog/tema/{blogTema}', [BlogTemaController::class, 'destroy'])
    ->name('admin.blog.tema.destroy');

  // =====================
  // BLOG – POSTS
  // =====================
  Route::get('/blog', [BlogController::class, 'index'])
    ->name('admin.blog.index');

  Route::get('/blog/posts', [BlogPostController::class, 'index'])
    ->name('admin.blog.posts.index');

  Route::get('/blog/posts/create', [BlogPostController::class, 'create'])
    ->name('admin.blog.posts.create');

  Route::post('/blog/posts', [BlogPostController::class, 'store'])
    ->name('admin.blog.posts.store');

  Route::get('/blog/posts/{post}/edit', [BlogPostController::class, 'edit'])
    ->name('admin.blog.posts.edit');

  Route::put('/blog/posts/{blogPost}', [BlogPostController::class, 'update'])
    ->name('admin.blog.posts.update');

  Route::get('/blog/temas', [BlogTemaController::class, 'index'])
    ->name('admin.blog.temas.index');

  Route::get('/blog/posts/suggest', [BlogPostController::class, 'suggest'])
    ->name('admin.blog.posts.suggest');

  Route::get('/blog/posts/{post}', [BlogPostController::class, 'show'])
    ->name('admin.blog.posts.show');
 
  Route::delete('/blog/posts/{post}', [BlogPostController::class, 'destroy'])
    ->name('admin.blog.posts.destroy');

  // =====================
  // BLOG – TEMAS (AJAX)
  // =====================
  Route::get(
    '/blog/categories/{category}/temas',
    [BlogPostController::class, 'temasByCategory']
  );

  // =====================
  // CALORIE
  // =====================
  Route::get('/foods/suggest', [FoodController::class, 'suggest'])
    ->name('admin.foods.suggest');

  Route::get('/foods', [FoodController::class, 'index'])
    ->name('admin.foods.index');
  
  Route::get('/foods/create', [FoodController::class, 'create'])
    ->name('admin.foods.create');
  
  Route::post('/foods/create', [FoodController::class, 'store'])
    ->name('admin.foods.store');

  Route::get('/foods/{food}', [FoodController::class, 'show'])
    ->name('admin.foods.show');

  Route::get('/foods/{food}/edit', [FoodController::class, 'edit'])
    ->name('admin.foods.edit');
  
  Route::post('/foods/{food}', [FoodController::class, 'update'])
    ->name('admin.foods.update');

  Route::post('/foods/{food}/destroy', [FoodController::class, 'destroy'])
    ->name('admin.foods.destroy');
});

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
->middleware(['auth', 'verified', 'user', 'nocache'])
->name('user.dashboard');

// =========
// PROGRAMS 
// =========
Route::middleware(['auth', 'verified'])
  ->prefix('user')
  ->name('user.')
  ->group(function () {

    Route::get('/programs', [UserProgramController::class, 'index'])
      ->name('programs.index');

    Route::get('/programs/create', [UserProgramController::class, 'create'])
      ->name('programs.create');

    Route::post('/programs', [UserProgramController::class, 'store'])
      ->name('programs.store');

    Route::get('/programs/{program}', [UserProgramController::class, 'show'])
      ->name('programs.show');

    Route::get('/programs/{program}/days/{day}', [UserProgramController::class, 'showDay'])
      ->name('programs.days.show');
  });

Route::post('/workout-sets/complete', [WorkoutSetController::class, 'complete'])
  ->middleware(['auth', 'verified'])
  ->name('workout-sets.complete');

// Public workouts
Route::get('/workouts/suggest', [WorkoutController::class, 'suggest']);

Route::get('/workouts', [WorkoutController::class, 'index'])
  ->name('workouts.index');

Route::get('/workouts/{workout:slug}', [WorkoutController::class, 'show'])
  ->name('workouts.show');

// Public calculate (PREVIEW saja)
Route::post(
  '/workouts/{workout:slug}/calculate-preview',
  [WorkoutController::class, 'calculatePreview']
)->name('workouts.calculate.preview');

// BLOG DASHBOARD (cards: All + Categories)
Route::get('/blogs', [PublicBlogController::class, 'index'])
  ->name('blogs.index');
  
// BLOG POSTS LIST
Route::get('/blogs/posts', [PublicBlogPostController::class, 'index'])
  ->name('blogs.posts.index');

// BLOG AUTOCOMPLETE
Route::get('/blogs/suggest', [PublicBlogPostController::class, 'suggest'])
  ->name('blogs.suggest');

  // TEMAS BY CATEGORY
Route::get('/blogs/{category:slug}', [PublicBlogController::class, 'category'])
    ->name('blogs.category');

// BLOG DETAIL
Route::get('/blogs/posts/{post:slug}', [PublicBlogPostController::class, 'show'])
  ->name('blogs.posts.show');


// FOODS
Route::get('/foods', [PublicFoodController::class, 'index']);
Route::get('/foods/suggest', [PublicFoodController::class, 'suggest']);
Route::get('/foods/{slug}/data', [PublicFoodController::class, 'data']);