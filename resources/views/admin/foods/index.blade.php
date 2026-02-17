<x-admin-layout>
  <div id="foodPage">
    <div class="max-w-6xl mx-auto font-hanken">

      {{-- PAGE TITLE --}}
      <x-admin.page-title title="Foods Management" />

      {{-- SEARCH + ADD --}}
      <div class="mt-6 mb-8 flex items-center justify-between gap-4">

        {{-- SEARCH --}}
        <x-form action="javascript:void(0)" class="flex-1">
          <div class="relative w-full">

            <x-input
              inline
              id="search"
              name="search"
              placeholder="Cari makanan..."
              autocomplete="off"
              :unstyled="true"
              class="w-full h-10 px-4 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />

            <i
              id="searchIcon"
              class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer"
            ></i>

            <x-admin.search-suggestions
              id="suggestions"
              class="absolute z-50 w-full bg-white border rounded-lg shadow mt-0.5
                    max-h-60 overflow-y-auto hidden"
            />

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

      <div id="tableWrapper">
        @include('admin.foods.partials._table')
      </div>

      <div id="pagination" class="mt-8 flex justify-center"></div>

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
