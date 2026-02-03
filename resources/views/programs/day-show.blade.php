<x-user.layout>
  <div class="max-w-4xl mx-auto mt-10 space-y-8">

    {{-- HEADER --}}
    <div>
      <h1 class="text-2xl font-bold">
        Day {{ $day->day }} · {{ $day->title ?? 'Workout Day' }}
      </h1>
      <p class="text-sm text-gray-600 mt-1">
        {{ $program->title }}
      </p>
    </div>

    {{-- REST DAY --}}
    @if ($day->is_rest)
      <div class="border rounded-lg p-6 bg-gray-50 text-center text-gray-600 italic">
        Rest Day — Recovery is part of progress 💪
      </div>
    @else

      {{-- WORKOUT LIST --}}
      <div class="space-y-8">

        @foreach ($day->workouts->sortBy('order') as $item)

          {{-- WORKOUT CARD --}}
          <div class="border rounded-xl p-6 bg-white space-y-4">

            {{-- WORKOUT TITLE --}}
            <div>
              <h2 class="text-lg font-semibold">
                {{ $item->workout->title }}
              </h2>
              <p class="text-sm text-gray-500">
                Sets: {{ $item->sets }} · Reps: {{ $item->reps }}
              </p>
            </div>

            {{-- SETS --}}
            <div class="space-y-4">
              @for ($set = 1; $set <= $item->sets; $set++)

                @php
                  // cek apakah set ini sudah selesai
                  $isCompleted = $completedSets
                    ->where('program_day_workout_id', $item->id)
                    ->where('set_number', $set)
                    ->isNotEmpty();

                  // ambil MAX reps
                  $reps = $item->reps;
                  if (str_contains($reps, '–')) {
                    [, $max] = array_map('intval', explode('–', $reps));
                  } elseif (str_contains($reps, '-')) {
                    [, $max] = array_map('intval', explode('-', $reps));
                  } else {
                    $max = (int) $reps;
                  }
                @endphp

                <div class="border rounded-lg p-4 bg-gray-50 space-y-3 set-item">

                  <div class="flex items-center justify-between">
                    <p class="font-medium text-gray-800">
                      Set {{ $set }}
                    </p>
                    <p class="text-sm text-gray-600">
                      Reps: {{ $item->reps }} |
                      @if($item->weight)
                        Weight: {{ $item->weight }} kg
                      @endif
                    </p>
                  </div>

                  {{-- GIF / IMAGE --}}
                  @if (!empty($item->workout->gif))
                    <div class="overflow-hidden rounded-lg">
                      <img
                        src="{{ asset('storage/' . $item->workout->gif) }}"
                        alt="{{ $item->workout->title }}"
                        class="w-full max-h-64 object-contain"
                      >
                    </div>
                  @endif

                  {{-- ACTION --}}
                  <button
                    type="button"
                    class="start-btn w-full rounded-lg py-2 font-medium transition
                           {{ $isCompleted
                              ? 'bg-green-600 opacity-60 cursor-not-allowed'
                              : 'bg-gray-700 hover:bg-gray-900 text-white cursor-pointer' }}"
                    data-disabled="{{ $isCompleted ? 1 : 0 }}"
                    {{ $isCompleted ? 'disabled' : '' }}
                    data-reps="{{ $max }}"
                    data-program-day-workout-id="{{ $item->id }}"
                    data-set-number="{{ $set }}"
                  >
                    {{ $isCompleted ? 'Completed' : 'Start' }}
                  </button>

                  <p class="counter text-center font-bold text-xl text-gray-800 mt-2 hidden">
                    0
                  </p>

                </div>

              @endfor
            </div>

          </div>

        @endforeach

      </div>
    @endif

  </div>
</x-user.layout>
