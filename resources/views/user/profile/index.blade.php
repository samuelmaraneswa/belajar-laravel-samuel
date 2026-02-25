<x-layout title="My Profile" class="mb-30">
  <div class="max-w-3xl mx-auto mt-8 px-4 sm:px-8 font-hanken">

    <h1 class="text-2xl font-semibold mb-6">My Profile</h1>

    <div class="bg-white p-6 rounded-xl shadow border border-gray-300">

      {{-- Avatar --}}
      <div class="flex items-center gap-6 mb-6">
        <img 
          src="{{ $user->avatar 
              ? asset('storage/'.$user->avatar) 
              : asset('images/default-avatar.jpg') }}"
          class="w-24 h-24 rounded-full object-cover border border-amber-300"
        >

        <div>
          <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
          <p class="text-gray-500 text-sm">{{ ucfirst($user->role) }}</p>
        </div>
      </div>

      {{-- Info --}}
      <div class="space-y-3 text-sm">
        <div>
          <span class="text-gray-500">Email:</span>
          <div class="font-medium">{{ $user->email }}</div>
        </div>

        <div>
          <span class="text-gray-500">Status:</span>
          <div class="font-medium">
            {{ $user->is_active ? 'Active' : 'Inactive' }}
          </div>
        </div>
      </div>

      {{-- Edit Button --}}
      <div class="mt-6">
        <a 
          href="{{ route('profile.edit') }}"
          class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
        >
          Edit Profile
        </a>
      </div>

    </div>

  </div>
</x-layout>