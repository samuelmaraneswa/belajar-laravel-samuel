<?php

namespace App\Providers;

use App\Models\WorkoutContext;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      View::composer('components.admin.sidebar', function ($view) {
        $view->with(
          'workoutContexts',
          WorkoutContext::orderBy('name')->get()
        );
      });
    }
}
