<x-layout title="Workouts">
  <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-8 font-hanken">

    {{-- SEARCH --}}
    <x-search.form
      action="/workouts"
      placeholder="Cari workout..."
      suggestUrl="/workouts/suggest"
    />

    {{-- EXPLORE BY MUSCLE GROUP --}}
    <x-muscle-groups :muscles="$muscles" scope="public" />

    {{-- CONTENT --}}
    @if ($workouts->isEmpty())
      <div class="text-center text-gray-500 py-20">
        Belum ada workout.
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8 mb-12">
        @foreach ($workouts as $workout)
          <x-workout-card :workout="$workout" />
        @endforeach
      </div>

      <div class="mb-20 flex justify-center">
        {{ $workouts->onEachSide(1)->links('pagination::tailwind') }}
      </div>
    @endif

  </div>
</x-layout>
