<x-admin-layout>
  <div data-page="meals-items">
    <div class="max-w-6xl mx-auto font-hanken">

      <x-admin.page-title title="Meals Management" />

      {{-- SEARCH + ADD --}}
      <div class="mt-6 mb-8 flex items-center justify-between gap-4">

        {{-- SEARCH --}}
        <x-form action="javascript:void(0)" class="flex-1">
          <div class="relative w-full">

            <x-input
              inline
              id="search"
              name="search"
              placeholder="Cari meal..."
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

        <button
          id="addMealBtn"
          class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
        >
          <i class="fa fa-plus"></i>
          <span class="hidden sm:inline pl-1 text-sm">Tambah</span>
        </button>

      </div>

      {{-- TABLE --}}
      <div id="tableWrapper">
        @include('admin.meals.items.partials._table')
      </div>

      {{-- PAGINATION --}}
      <div id="pagination" class="mt-8 flex justify-center"></div>

    </div>
  </div>
</x-admin-layout>


{{-- MODAL --}}
<div id="mealModal"
     class="fixed inset-0 bg-black/50 hidden z-50">

  <div class="absolute inset-0 flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-3xl rounded-xl relative">

      <button id="closeMealModal"
        class="absolute -top-3 -right-3 bg-black text-white w-6 h-6 rounded-full text-xs cursor-pointer">
        ✕
      </button>

      <div id="mealModalScroll" class="max-h-[90vh] overflow-y-auto p-6">
        <div id="mealModalContent"></div>
      </div>

    </div>

  </div>
</div>