<table id="adminUserTable"
       class="w-full min-w-150 text-sm whitespace-nowrap bg-white rounded-xl shadow overflow-x-auto">

  <thead class="bg-gray-50 border-b">
    <tr>
      <th class="px-6 py-3 text-left">No</th>
      <th class="px-6 py-3 text-left">Name</th>
      <th class="px-6 py-3 text-left">Email</th>
      <th class="px-6 py-3 text-left">Role</th>
      <th class="px-6 py-3 text-left">Status</th>
      <th class="px-6 py-3 text-left">Actions</th>
    </tr>
  </thead>

  <tbody>
    @forelse($users as $index => $user)
      <tr class="border-b hover:bg-gray-50">

        <td class="px-6 py-4">
          {{ $users->firstItem() + $index }}
        </td>

        <td class="px-6 py-4 font-medium">
          {{ $user->name }}
        </td>

        <td class="px-6 py-4">
          {{ $user->email }}
        </td>

        <td class="px-6 py-4">
          <span class="px-2 py-1 text-xs rounded
            {{ $user->role === 'admin'
                ? 'bg-indigo-100 text-indigo-700'
                : 'bg-gray-200 text-gray-600' }}">
            {{ ucfirst($user->role) }}
          </span>
        </td>

        <td class="px-6 py-4">
          <span class="px-2 py-1 text-xs rounded
            {{ $user->is_active
                ? 'bg-green-100 text-green-700'
                : 'bg-red-100 text-red-700' }}">
            {{ $user->is_active ? 'Active' : 'Inactive' }}
          </span>
        </td>

        <td class="px-6 py-4 text-left space-x-1">

          <button
            class="view-user cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded"
            data-id="{{ $user->id }}">
            View
          </button>

          <button
            class="edit-user cursor-pointer bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded"
            data-id="{{ $user->id }}">
            Edit
          </button>

          <button
            class="toggle-user cursor-pointer
              {{ $user->is_active
                  ? 'bg-red-500 hover:bg-red-600'
                  : 'bg-green-500 hover:bg-green-600' }}
              text-white px-2 py-1 rounded"
            data-id="{{ $user->id }}">
            {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
          </button>

        </td>

      </tr>
    @empty
      <tr>
        <td colspan="6" class="px-6 py-6 text-center text-gray-500">
          Data tidak ditemukan.
        </td>
      </tr>
    @endforelse
  </tbody>

</table>