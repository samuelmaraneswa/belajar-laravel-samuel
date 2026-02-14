<x-admin-layout>
  <div class="max-w-6xl mx-auto font-hanken">

    {{-- PAGE TITLE --}}
    <x-admin.page-title title="Foods Management" />

    {{-- SEARCH + ADD --}}
    <div class="mt-6 mb-8 flex items-center justify-between gap-4">

      <x-form action="{{ route('admin.foods.index') }}" method="GET" class="flex-1">
        <div class="relative w-full">
          <x-input
            inline
            name="search"
            value="{{ $search }}"
            placeholder="Cari makanan..."
            autocomplete="off"
            :unstyled="true"
            class="w-full h-10 px-4 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
          />
          <button type="submit"
            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-indigo-600">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>
      </x-form>

      <a href="{{ route('admin.foods.create') }}">
        <x-button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
          <i class="fa fa-plus"></i>
          <span class="hidden sm:inline pl-1 text-sm">Tambah</span>
        </x-button>
      </a>

    </div>

    @if(session('success'))
      <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
      </div>
    @endif

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
                  class="view-food inline-flex items-center justify-center h-6 px-1 sm:h-7 sm:px-2 text-xs sm:text-sm bg-blue-500 text-white rounded hover:bg-blue-600"
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

    {{-- PAGINATION --}}
    <div class="mt-6">
      {{ $foods->links() }}
    </div>

  </div>
</x-admin-layout>

{{-- GLOBAL MODAL --}}
<div id="foodModal"
     class="p-6 sm:p-0 fixed inset-0 bg-black/50 hidden z-50
            items-center justify-center
            transition-opacity duration-300">

  <div id="modalBox"
       class="bg-white w-full max-w-3xl max-h-[95vh]
              rounded-xl p-2 relative
              transform transition-all duration-300 scale-95 opacity-0">

    <button id="closeModal"
      class="absolute -top-2 -right-2
          bg-black text-white
            w-5 aspect-square
            flex items-center justify-center
            rounded-full text-xs cursor-pointer
            hover:bg-gray-800 transition">
      ✕
    </button>

    <div class="max-h-[90vh] overflow-y-auto p-4 pb-6 bg-white">
      <div id="modalContent">
      </div>
    </div>

  </div>
</div>
