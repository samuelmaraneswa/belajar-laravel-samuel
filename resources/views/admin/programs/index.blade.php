<x-admin-layout>
  <div id="programPage">
    <div class="max-w-6xl mx-auto font-hanken">

      <x-admin.page-title title="Programs Management" />

      {{-- SEARCH --}}
      <div class="mt-6 mb-8 flex items-center justify-between gap-4">

        <x-form action="javascript:void(0)" class="flex-1">
          <div class="relative w-full">

            <x-input
              inline
              id="searchProgram"
              name="search"
              placeholder="Cari program / user..."
              autocomplete="off"
              :unstyled="true"
              class="w-full h-10 px-4 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />

            <i
              id="searchProgramIcon"
              class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer"
            ></i>

            <x-admin.search-suggestions
              id="programSuggestions"
              class="absolute z-50 w-full bg-white border rounded-lg shadow mt-0.5
                    max-h-60 overflow-y-auto hidden"
            />

          </div>
        </x-form>

      </div>

      {{-- TABLE --}}
      <div id="programTableWrapper" class="overflow-x-auto">
        @include('admin.programs.partials._table')
      </div>

      {{-- PAGINATION --}}
      <div id="programPagination" class="mt-8 flex justify-center"></div>

    </div>
  </div>
</x-admin-layout>