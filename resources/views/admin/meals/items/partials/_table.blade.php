{{-- TABLE --}}
<div class="bg-white rounded-xl shadow overflow-x-auto">

  <table class="w-full table-auto text-xs sm:text-base">

    <thead class="bg-gray-50 border-b">
      <tr class="text-left">
        <th class="px-6 py-3 whitespace-nowrap">No</th>
        <th class="px-6 py-3 whitespace-nowrap">Title</th>
        <th class="px-6 py-3 text-center whitespace-nowrap">Actions</th>
      </tr>
    </thead>

    <tbody class="divide-y">

      @forelse($meals as $index => $meal)
        <tr class="hover:bg-gray-50">

          {{-- No --}}
          <td class="px-6 py-4 whitespace-nowrap">
            {{ $meals->firstItem() + $index }}
          </td>

          {{-- Title --}}
          <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
            {{ $meal->title }}
          </td>

          {{-- Actions --}}
          <td class="py-4 text-center whitespace-nowrap space-x-1">

            <button
              class="meals-view-item cursor-pointer inline-flex items-center justify-center h-6 px-1 sm:h-7 sm:px-2 text-xs sm:text-sm bg-blue-500 text-white rounded hover:bg-blue-600"
              data-meals-id="{{ $meal->id }}"
            >
              View
            </button>

            <button
              class="meals-edit-item cursor-pointer inline-flex items-center justify-center h-6 px-1 sm:h-7 sm:px-2 text-xs sm:text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600"
              data-meals-id="{{ $meal->id }}"
            >
              Edit
            </button>

            <button
              class="meals-delete-item cursor-pointer inline-flex items-center justify-center h-6 px-1 sm:h-7 sm:px-2 text-xs sm:text-sm bg-red-500 text-white rounded hover:bg-red-600"
              data-meals-id="{{ $meal->id }}"
            >
              Delete
            </button>

          </td>

        </tr>
      @empty
        <tr>
          <td colspan="3" class="px-6 py-6 text-center text-gray-500">
            Data tidak ditemukan.
          </td>
        </tr>
      @endforelse

    </tbody>

  </table>

</div>