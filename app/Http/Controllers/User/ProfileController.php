<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

  public function index()
  {
    /** @var User $user */
    $user = Auth::user();

    return view('user.profile.index', compact('user'));
  }

  public function edit()
  {
    /** @var User $user */
    $user = Auth::user();

    return view('user.profile.edit', compact('user'));
  }

  public function update(Request $request)
  {
    /** @var User $user */
    $user = Auth::user();

    $validated = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => [
        'required',
        'email',
        Rule::unique('users', 'email')->ignore($user->id),
      ],
      'avatar' => ['nullable', 'image', 'max:2048'],
      'password' => ['nullable', 'confirmed', 'min:6'],
    ]);

    // Update basic data
    $user->name = $validated['name'];
    $user->email = $validated['email'];

    if ($request->hasFile('avatar')) {

      // hapus avatar lama jika ada
      if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
        Storage::disk('public')->delete($user->avatar);
      }

      $path = $request->file('avatar')->store('avatars', 'public');
      $user->avatar = $path;
    }

    // Password (optional)
    if (!empty($validated['password'])) {
      $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return redirect()->route('profile.index')
      ->with('success', 'Profile berhasil diperbarui.');
  }
}
