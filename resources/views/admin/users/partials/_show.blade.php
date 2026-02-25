<div class="space-y-6">

  {{-- NAME + ROLE --}}
  <div>
    <h2 class="text-2xl font-bold">
      {{ $user->name }}
    </h2>

    <div class="mt-2 flex gap-2">

      <span class="px-3 py-1 text-xs rounded-full
        {{ $user->role === 'admin'
            ? 'bg-indigo-100 text-indigo-700'
            : 'bg-gray-200 text-gray-600' }}">
        {{ ucfirst($user->role) }}
      </span>

      <span class="px-3 py-1 text-xs rounded-full
        {{ $user->is_active
            ? 'bg-green-100 text-green-700'
            : 'bg-red-100 text-red-700' }}">
        {{ $user->is_active ? 'Active' : 'Inactive' }}
      </span>

    </div>
  </div>

  {{-- AVATAR --}}
  @if($user->avatar)
    <div class="w-40 h-40 rounded-xl overflow-hidden border">
      <img
        src="{{ str_starts_with($user->avatar, 'users/')
                ? asset('storage/' . $user->avatar)
                : asset($user->avatar) }}"
        class="w-full h-full object-cover"
        alt="{{ $user->name }}">
    </div>
  @endif

  {{-- EMAIL --}}
  <div>
    <h3 class="text-sm font-semibold text-gray-500">Email</h3>
    <p class="mt-1 text-gray-800">{{ $user->email }}</p>
  </div>

  {{-- EMAIL VERIFIED --}}
  <div>
    <h3 class="text-sm font-semibold text-gray-500">Email Verified</h3>
    <p class="mt-1 text-gray-800">
      {{ $user->email_verified_at
          ? $user->email_verified_at->format('d M Y H:i')
          : 'Belum diverifikasi' }}
    </p>
  </div>

  {{-- CREATED AT --}}
  <div>
    <h3 class="text-sm font-semibold text-gray-500">Registered At</h3>
    <p class="mt-1 text-gray-800">
      {{ $user->created_at->format('d M Y H:i') }}
    </p>
  </div>

</div>