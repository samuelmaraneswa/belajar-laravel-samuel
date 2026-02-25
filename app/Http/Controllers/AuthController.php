<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  // =========================
  // LOGIN
  // =========================
  public function loginForm(Request $request)
  {
    $intended = session('url.intended');

    if ($intended && str_contains($intended, '/user/programs/create')) {
      session()->flash(
        'info',
        'Mohon register atau login agar saya dapat meng-generate 30 days workout program Anda.'
      );
    }

    return view('auth.login');
  }

  // public function login(Request $request)
  // {
  //   $credentials = $request->validate([
  //     'email' => 'required|email',
  //     'password' => 'required',
  //   ]);

  //   if (Auth::attempt($credentials)) {
  //     $request->session()->regenerate();

  //     // 🔒 BELUM VERIFY → KUNCI
  //     if (!Auth::user()->email_verified_at) {
  //       return redirect()->route('verification.notice');
  //     }

  //     // 🔥 AMANKAN intended (hindari ajax/api)
  //     $intended = session('url.intended');
  //     if ($intended && Str::contains($intended, ['/ajax', '/api'])) {
  //       session()->forget('url.intended');
  //     }

  //     // ✅ ADMIN → /admin | USER → /dashboard
  //     return Auth::user()->role === 'admin'
  //       ? redirect()->intended('/admin')
  //       : redirect()->intended('/dashboard');
  //   }

  //   return back()->withErrors([
  //     'email' => 'Login gagal, email atau password salah.',
  //   ]);
  // }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {

      $request->session()->regenerate();

      $user = Auth::user();

      // ⛔ CEK NONAKTIF
      if (!$user->is_active) {
        Auth::logout();
        return back()->withErrors([
          'email' => 'Akun Anda dinonaktifkan. Hubungi admin.',
        ]);
      }

      // 🔒 BELUM VERIFY
      if (!$user->email_verified_at) {
        return redirect()->route('verification.notice');
      }

      // 🔥 Amankan intended (hindari ajax/api)
      $intended = session('url.intended');
      if ($intended && Str::contains($intended, ['/ajax', '/api'])) {
        session()->forget('url.intended');
      }

      // ✅ ADMIN → /admin | USER → /dashboard
      return $user->role === 'admin'
        ? redirect()->intended('/admin')
        : redirect()->intended('/dashboard');
    }

    return back()->withErrors([
      'email' => 'Login gagal, email atau password salah.',
    ]);
  }

  // =========================
  // REGISTER
  // =========================
  public function registerForm()
  {
    return view('auth.register');
  }

  public function register(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|confirmed|min:6',
    ]);

    $user = User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);

    // 🔔 Kirim email verifikasi
    event(new Registered($user));

    // ✅ AUTO LOGIN (tapi tetap terkunci)
    Auth::login($user);

    // ⛔ Arahkan ke halaman verify email
    return redirect()->route('verification.notice');
  }

  // =========================
  // LOGOUT
  // =========================
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
  }
}
