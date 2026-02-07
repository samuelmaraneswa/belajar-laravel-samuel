<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
  public function handle($request, Closure $next)
  {
    if (!Auth::check()) {
      return redirect()->route('login');
    }

    if (Auth::user()->role !== 'user') {
      return redirect()->route('admin.dashboard');
    }

    return $next($request);
  }
}
