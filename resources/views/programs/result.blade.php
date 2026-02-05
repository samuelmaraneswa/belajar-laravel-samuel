<x-user.layout>
  <div class="max-w-4xl mx-auto mt-10">

    <h1 class="text-2xl font-bold mb-2">
      Your 30 Days Workout Program
    </h1>

    <p class="text-sm text-gray-600 mb-3">
      Goal: <b>{{ str_replace('_',' ', $program->goal) }}</b> ·
      Level: <b>{{ ucfirst($program->level) }}</b>
    </p>

    {{-- PROGRESS BAR (30 DAYS) --}}
    <div class="mb-8">
      <div class="flex justify-between text-xs text-gray-500 mb-1">
        <span>Progress</span>
        <span>{{ $programProgress }}%</span>
      </div>
      <div class="h-2 w-full rounded-full bg-gray-200 overflow-hidden">
        <div
          class="h-full bg-green-800 transition-all duration-300"
          style="width: {{ $programProgress }}%"
        ></div>
      </div>
    </div>

    {{-- DAYS LIST --}}
    <div class="grid gap-3">
      @foreach ($program->days->sortBy('day') as $day)

        @php
          $progress = $dayProgress[$day->id] ?? 0;
        @endphp
        
        <a href="{{ route('user.programs.days.show', [$program, $day->day]) }}"
          class="flex items-center justify-between
                  border rounded-lg px-5 py-4 bg-white transition
                  {{ $progress >= 100
                      ? 'border-green-500 hover:bg-green-50'
                      : 'border-gray-200 hover:bg-gray-50' }}">

          <div>
            <p class="font-semibold">
              Day {{ $day->day }}
            </p>

            <p class="text-sm text-gray-500">
              {{ $day->is_rest ? 'Rest Day' : ($day->title ?? 'Workout Day') }}
            </p>
          </div>

          {{-- STATUS PROGRESS (placeholder) --}}
          @php
            $progress = $dayProgress[$day->id] ?? 0;
          @endphp

          @if ($progress >= 100)
            <span class="text-sm font-semibold text-green-600">
              Completed
            </span>
          @else
            <div class="w-8 h-8">
              <svg viewBox="0 0 36 36" class="w-full h-full">
                <!-- background -->
                <path
                  d="M18 2 a 16 16 0 0 1 0 32 a 16 16 0 0 1 0 -32"
                  fill="none" stroke="#e5e7eb" stroke-width="3"
                />
                <!-- progress -->
                <path
                  d="M18 2 a 16 16 0 0 1 0 32 a 16 16 0 0 1 0 -32"
                  fill="none"
                  stroke="#2563eb"
                  stroke-width="3"
                  stroke-dasharray="{{ $progress }}, 100"
                />
              </svg>
            </div>
          @endif
          
        </a>
      @endforeach
    </div>

  </div>
</x-user.layout>
