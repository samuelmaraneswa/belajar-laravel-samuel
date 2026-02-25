<table class="min-w-full divide-y divide-gray-200 text-sm bg-white rounded-xl overflow-hidden">

  <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
    <tr>
      <th class="px-6 py-3 text-left">User</th>
      <th class="px-6 py-3 text-left">Title</th>
      <th class="px-6 py-3 text-left">Progress</th>
      <th class="px-6 py-3 text-right">Action</th>
    </tr>
  </thead>

  <tbody class="divide-y divide-gray-100">

    @forelse ($programs as $program)
      @php
        $progress = (float) ($program->progress ?? 0);
      @endphp

      <tr class="hover:bg-gray-50">

        <td class="px-6 py-4">
          {{ $program->user->name }}
        </td>

        <td class="px-6 py-4 font-medium text-gray-900">
          {{ $program->title }}
        </td>

        <td class="px-6 py-4">
          <span class="text-xs font-semibold
            {{ $progress >= 100 ? 'text-green-600' : 'text-blue-600' }}">
            {{ number_format($progress, 0) }}%
          </span>
        </td>

        <td class="px-6 py-4 text-right">
          <button
            class="deleteProgramBtn text-red-600 hover:text-red-800 text-sm font-medium cursor-pointer"
            data-program-id="{{ $program->id }}">
            Delete
          </button>
        </td>

      </tr>

    @empty
      <tr>
        <td colspan="7" class="px-6 py-6 text-center text-gray-500">
          No programs found.
        </td>
      </tr>
    @endforelse

  </tbody>
</table>