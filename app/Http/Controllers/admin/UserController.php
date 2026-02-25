<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $query = User::query();

    if ($request->filled('search')) {
      $query->where(function ($q) use ($request) {
        $q->where('name', 'like', '%' . $request->search . '%')
          ->orWhere('email', 'like', '%' . $request->search . '%');
      });
    }

    $users = $query->latest()->paginate(30);

    if ($request->ajax()) {
      return response()->json([
        'html' => view('admin.users.partials._table', compact('users'))->render(),
        'pagination' => [
          'page' => $users->currentPage(),
          'last' => $users->lastPage(),
        ]
      ]);
    }

    return view('admin.users.index', compact('users'));
  }

  public function create()
  {
    return view('admin.users.partials._form');
  }

  public function show(User $user)
  {
    return view('admin.users.partials._show', compact('user'));
  }

  public function store(Request $request)
  {
    $data = $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email',
        'password'  => 'required|min:6',
        'role'      => 'required|in:user,admin',
        'is_active' => 'required|boolean',
        'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Default avatar
    $avatarPath = 'images/default-avatar.jpg';

    // Jika upload avatar
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')
                              ->store('users', 'public');
    }

    User::create([
        'name'      => $data['name'],
        'email'     => $data['email'],
        'password'  => $data['password'], // auto hashed dari cast
        'role'      => $data['role'],
        'is_active' => $data['is_active'],
        'avatar'    => $avatarPath,
    ]);

    return response()->json([
        'success' => true
    ]);
  }

  public function edit(User $user)
  {
    return view('admin.users.partials._form', compact('user'));
  }

  public function update(Request $request, User $user)
  {
    $data = $request->validate([
      'name'      => 'required|string|max:255',
      'email'     => 'required|email|unique:users,email,' . $user->id,
      'password'  => 'nullable|min:6',
      'role'      => 'required|in:user,admin',
      'is_active' => 'required|boolean',
      'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // =========================
    // 🔁 HANDLE AVATAR
    // =========================
    if ($request->hasFile('avatar')) {

      // hapus avatar lama (kecuali default)
      if ($user->avatar && $user->avatar !== 'images/default-avatar.jpg') {
        Storage::disk('public')->delete($user->avatar);
      }

      // simpan avatar baru
      $data['avatar'] = $request->file('avatar')
        ->store('users', 'public');
    }

    // =========================
    // 🔐 HANDLE PASSWORD
    // =========================
    if (empty($data['password'])) {
      unset($data['password']); // tidak ubah password
    }
    // kalau diisi → otomatis hashed karena cast

    $user->update($data);

    return response()->json([
      'success' => true
    ]);
  }

  public function toggle(User $user)
  {
    $user->is_active = !$user->is_active;
    $user->save();

    return response()->json([
      'success' => true,
      'status'  => $user->is_active
    ]);
  }

  public function suggest(Request $request)
  {
    $q = $request->q;

    $users = User::where('name', 'like', "%{$q}%")
      ->limit(20)
      ->pluck('name');

    return response()->json($users);
  }
}
