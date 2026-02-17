{{-- TABLE --}}
<div class="bg-white rounded-xl shadow overflow-x-auto">

  <table class="w-full table-auto text-xs sm:text-base">

    <thead class="bg-gray-50 border-b">
      <tr class="text-left">
        <th class="px-6 py-3 whitespace-nowrap">No</th>
        <th class="px-6 py-3 whitespace-nowrap">Name</th>
        <th class="px-6 py-3 whitespace-nowrap">Status</th>
        <th class="px-6 py-3 text-center whitespace-nowrap">Actions</th>
      </tr>
    </thead>

    <tbody class="divide-y">

      @forelse($foods as $index => $food)
        <tr class="hover:bg-gray-50">

          <td class="px-6 py-4 whitespace-nowrap">
            {{ $foods->firstItem() + $index }}
          </td>

          <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
            {{ $food->name }}
          </td>

          <td class="px-6 py-4 whitespace-nowrap">
            @if($food->is_active)
              <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                Active
              </span>
            @else
              <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">
                Inactive
              </span>
            @endif
          </td>

          <td class="py-4 text-center whitespace-nowrap space-x-1">

            <button
              class="view-food cursor-pointer inline-flex items-center justify-center h-6 px-1 sm:h-7 sm:px-2 text-xs sm:text-sm bg-blue-500 text-white rounded hover:bg-blue-600"
              data-id="{{ $food->id }}"
            >
              View
            </button>

            <a href="{{ route('admin.foods.edit', $food) }}"
              class="inline-flex items-center justify-center h-6 px-1 sm:h-7 sm:px-2 text-xs sm:text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
              Edit
            </a>

            <form
              action="{{ route('admin.foods.destroy', $food) }}"
              method="POST"
              class="inline"
            >
              @csrf

              <button
                type="submit"
                class="inline-flex items-center justify-center h-6 px-1 sm:h-7 sm:px-2 text-xs sm:text-sm bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer"
                onclick="return confirm('Nonaktifkan data ini?')"
              >
                Delete
              </button>
            </form>

          </td>

        </tr>
      @empty
        <tr>
          <td colspan="4" class="px-6 py-6 text-center text-gray-500">
            Data tidak ditemukan.
          </td>
        </tr>
      @endforelse

    </tbody>

  </table>

</div>
