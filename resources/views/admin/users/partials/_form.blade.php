<h2 class="text-lg font-semibold mb-4 mt-2">
  {{ isset($user) ? 'Edit User' : 'Create User' }}
</h2>

<form 
  id="adminUserForm"
  method="POST"
  action="{{ isset($user) 
      ? route('admin.users.update', $user) 
      : route('admin.users.store') }}"
  class="space-y-5"
  enctype="multipart/form-data"
>
  @csrf

  @if(isset($user))
    @method('PUT')
  @endif

  {{-- NAME --}}
  <div>
    <x-input
      name="name"
      placeholder="Full Name"
      value="{{ $user->name ?? '' }}"
      autocomplete="off"
    />
  </div>

  {{-- EMAIL --}}
  <div>
    <x-input
      name="email"
      type="email"
      placeholder="Email"
      value="{{ $user->email ?? '' }}"
    />
  </div>

  {{-- PASSWORD --}}
  <div>
    <x-input
      name="password"
      type="password"
      placeholder="{{ isset($user) ? 'Password (kosongkan jika tidak diubah)' : 'Password' }}"
    />
  </div>

  {{-- ROLE --}}
  <div>
    <label class="block text-sm font-medium mb-2">Role</label>

    <div class="flex gap-4">

      <label class="flex items-center gap-2 cursor-pointer">
        <input
          type="radio"
          name="role"
          value="user"
          class="accent-indigo-600"
          {{ !isset($user) || $user->role === 'user' ? 'checked' : '' }}
        >
        <span>User</span>
      </label>

      <label class="flex items-center gap-2 cursor-pointer">
        <input
          type="radio"
          name="role"
          value="admin"
          class="accent-indigo-600"
          {{ isset($user) && $user->role === 'admin' ? 'checked' : '' }}
        >
        <span>Admin</span>
      </label>

    </div>
  </div>

  {{-- STATUS ACTIVE --}}
  <div>
    <label class="block text-sm font-medium mb-2">Status</label>

    <div class="flex gap-4">

      <label class="flex items-center gap-2 cursor-pointer">
        <input
          type="radio"
          name="is_active"
          value="1"
          class="accent-indigo-600"
          {{ !isset($user) || $user->is_active ? 'checked' : '' }}
        >
        <span>Active</span>
      </label>

      <label class="flex items-center gap-2 cursor-pointer">
        <input
          type="radio"
          name="is_active"
          value="0"
          class="accent-indigo-600"
          {{ isset($user) && !$user->is_active ? 'checked' : '' }}
        >
        <span>Inactive</span>
      </label>

    </div>
  </div>

  {{-- AVATAR --}}
  <div>
    <label class="block text-sm font-medium mb-1">Avatar (optional)</label>

    <input
      type="file"
      name="avatar"
      class="w-full border rounded-lg p-2"
    />

    @if(isset($user) && $user->avatar)
      <p class="text-sm text-gray-500 mt-2">
        File tersimpan:
        <span class="font-medium text-gray-700">
          {{ basename($user->avatar) }}
        </span>
      </p>
    @endif
  </div>

  {{-- SUBMIT --}}
  <div class="pt-2">
    <button
      type="submit"
      class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 cursor-pointer">
      Simpan
    </button>
  </div>

</form>