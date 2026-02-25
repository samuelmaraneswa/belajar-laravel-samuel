<x-layout title="Edit Profile" class="mb-15 sm:mb-25">
  <div class="max-w-3xl mx-auto mt-8 px-4 sm:px-8 font-hanken">

    <h1 class="text-2xl font-semibold mb-6">Edit Profile</h1>

    @if(session('success'))
      <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
        {{ session('success') }}
      </div>
    @endif

    <form 
      action="{{ route('profile.update') }}" 
      method="POST" 
      enctype="multipart/form-data"
      class="bg-white p-6 rounded-xl shadow space-y-6 border border-gray-300"
    >
      @csrf
      @method('PUT')

      {{-- Avatar --}}
      <div>
        <label class="block text-sm font-medium mb-2">Avatar</label>

        <div class="flex items-center gap-6">
          <img 
            src="{{ $user->avatar 
                    ? asset('storage/'.$user->avatar) 
                    : asset('images/default-avatar.jpg') }}"
            class="w-24 h-24 rounded-full object-cover border border-amber-200"
          >

          <input 
            type="file" 
            name="avatar"
            class="block w-full text-sm text-gray-700
              file:mr-4 file:py-2 file:px-4
              file:rounded-lg file:border-0
              file:text-sm file:font-medium
              file:bg-indigo-600 file:text-white
              hover:file:bg-indigo-700
              border border-gray-300 rounded-lg
              focus:outline-none focus:ring-2 focus:ring-indigo-500
              p-2"
          >
        </div>

        @error('avatar')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Name --}}
      <div>
        <label class="block text-sm font-medium mb-1">Name</label>
        <input 
          type="text"
          name="name"
          value="{{ old('name', $user->name) }}"
          class="w-full border rounded px-3 py-2"
        >
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Email --}}
      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input 
          type="email"
          name="email"
          value="{{ old('email', $user->email) }}"
          class="w-full border rounded px-3 py-2"
        >
        @error('email')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Password --}}
      <div>
        <label class="block text-sm font-medium mb-1">
          New Password (optional)
        </label>
        <input 
          type="password"
          name="password"
          class="w-full border rounded px-3 py-2"
        >
      </div>

      @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror

      <div>
        <label class="block text-sm font-medium mb-1">
          Confirm Password
        </label>
        <input 
          type="password"
          name="password_confirmation"
          class="w-full border rounded px-3 py-2"
        >
      </div>

      <div class="flex justify-between pt-4">
        <a 
          href="{{ route('profile.index') }}"
          class="text-sm text-gray-500 hover:underline"
        >
          Cancel
        </a>

        <button 
          type="submit"
          class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
        >
          Save Changes
        </button>
      </div>

    </form>

  </div>
</x-layout>