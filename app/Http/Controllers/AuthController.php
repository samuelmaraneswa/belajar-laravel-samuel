<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function loginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);

    if(Auth::attempt($credentials)){
      $request->session()->regenerate();

      return Auth::user()->role === 'admin'
        ? redirect('/admin')
        : redirect('/');
    }

    return back()->withErrors([
      'email' => 'Login gagal, email atau password salah!'
    ]);
  }

  public function registerForm()
  {
    return view('auth.register');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
  }
}
