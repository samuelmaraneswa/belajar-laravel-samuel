<x-admin-layout>
  <div id="workoutPage">
    <div class="max-w-7xl mx-auto font-hanken">

      <x-alert type="success" />

      {{-- Top Section --}}
      <div class="flex justify-between items-center mb-6">
        @php
          $context = request('context');
          $cleanContext = $context
            ? str_replace('-workout', '', $context)
            : null;

          $title = $cleanContext
            ? Str::title(str_replace('-', ' ', $cleanContext)) . ' Workouts'
            : 'All Workouts';

          $titleUrl = $context
            ? url('/admin/workouts/list?context=' . $context)
            : url('/admin/workouts/list');
        @endphp

        <div class="hidden sm:block">
          <a href="{{ $titleUrl }}">
            <x-admin.page-title :title="$title" class="text-indigo-700 hover:underline" />
          </a>
        </div>

        {{-- SEARCH --}}
        <x-form action="javascript:void(0)" class="flex-1">
          <div class="flex items-center mx-4 relative">
            <x-input
              inline
              id="search"
              name="search"
              placeholder="Cari workout..."
              autocomplete="off"
              :unstyled="true"
              class="w-full h-9 px-4 border rounded-lg"
            />

            <i id="searchIcon"
              class="fa-solid fa-magnifying-glass absolute right-3
                      text-gray-400 cursor-pointer"></i>

            <x-admin.search-suggestions
              id="suggestions"
              class="absolute z-50 w-full bg-white border rounded-lg shadow
                    max-h-50 overflow-y-auto hidden" />
          </div>
        </x-form>

        <a href="{{ route('admin.workout.create') }}">
          <x-button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
            <i class="fa fa-plus"></i>
            <span class="hidden sm:inline pl-1 text-sm">Tambah</span>
          </x-button>
        </a>
      </div>

      {{-- Muscle Groups --}}
      <x-muscle-groups :muscles="$muscles" />

      {{-- GRID (AJAX INJECT) --}}
      <div id="workoutGrid"></div>

      {{-- PAGINATION (AJAX INJECT) --}}
      <div id="pagination" class="mt-8 flex justify-center"></div>

    </div>
  </div>
</x-admin-layout>

<script>
  window.workoutContext = "{{ request('context') }}";
</script>
