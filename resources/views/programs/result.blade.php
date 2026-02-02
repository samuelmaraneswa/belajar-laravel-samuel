<x-user.layout>
  <div class="max-w-4xl mx-auto mt-10">

    <h1 class="text-2xl font-bold mb-2">
      Your 30 Days Workout Program
    </h1>

    <p class="text-sm text-gray-600 mb-3">
      Goal: <b>{{ str_replace('_',' ', $program->goal) }}</b> ·
      Level: <b>{{ ucfirst($program->level) }}</b>
    </p>

    {{-- PROGRESS BAR (0% for now) --}}
    <div class="mb-8">
      <div class="flex justify-between text-xs text-gray-500 mb-1">
        <span>Progress</span>
        <span>0%</span>
      </div>
      <div class="h-2 w-full rounded-full bg-gray-200 overflow-hidden">
        <div class="h-full bg-gray-800" style="width: 0%"></div>
      </div>
    </div>

    {{-- DAYS LIST --}}
    <div class="grid gap-3">
      @foreach ($program->days->sortBy('day') as $day)
        <a href="{{ route('programs.days.show', [$program, $day->day]) }}"
           class="flex items-center justify-between
                  border rounded-lg px-5 py-4 bg-white
                  hover:bg-gray-50 transition">

          <div>
            <p class="font-semibold">
              Day {{ $day->day }}
            </p>

            <p class="text-sm text-gray-500">
              {{ $day->is_rest ? 'Rest Day' : ($day->title ?? 'Workout Day') }}
            </p>
          </div>

          {{-- STATUS ICON (future) --}}
          <span class="text-gray-400 text-xl">
            →
          </span>
        </a>
      @endforeach
    </div>

  </div>
</x-user.layout>
