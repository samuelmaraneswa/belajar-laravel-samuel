<x-layout>
  <div class="max-w-4xl mx-auto mt-10">

    {{-- HEADER --}}
    <h1 class="text-2xl font-bold mb-2">
      Your 30 Days Workout Program
    </h1>

    <p class="text-sm text-gray-600 mb-6">
      Goal: <b>{{ str_replace('_',' ', $profile['goal']) }}</b> ·
      Level: <b>{{ ucfirst($profile['level']) }}</b>
    </p>

    {{-- DAYS --}}
    <div class="space-y-6">
      @foreach ($program as $day => $data)
        <div class="border rounded-lg p-5 bg-white">

          <h2 class="font-bold text-lg mb-3">
            Day {{ $day }}
          </h2>

          @if ($data['rest'])
            <p class="text-gray-500 italic">Rest Day</p>
          @else
            <ul class="space-y-3">
              @foreach ($data['workouts'] as $item)
                <li class="border rounded p-3 bg-gray-50">
                  <p class="font-semibold text-gray-800">
                    {{ $item['workout']->title }}
                  </p>

                  <p class="text-sm text-gray-600">
                    Sets: {{ $item['plan']['sets'] }} ·
                    Reps: {{ $item['plan']['reps'] }}
                    @if(isset($item['plan']['weight']))
                      · Weight: {{ $item['plan']['weight'] }} kg
                    @endif
                  </p>
                </li>
              @endforeach
            </ul>
          @endif

        </div>
      @endforeach
    </div>

  </div>
</x-layout>
