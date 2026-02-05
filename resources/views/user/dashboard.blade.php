<x-user.layout>
  {{-- Greeting --}}
  <h1 class="text-2xl font-semibold text-gray-800 mb-2">
    Hi, {{ auth()->user()->name }} 👋
  </h1>
  <p class="text-gray-600 mb-6">
    Selamat datang di dashboard kamu
  </p>

  @if ($activeProgram)
    <div class="max-w-md">
      <div class="rounded-2xl border bg-white p-6 shadow-sm">

        <span class="text-xs font-semibold text-indigo-600 uppercase">
          Active Program
        </span>

        <h2 class="mt-2 text-xl font-bold text-gray-900">
          {{ $activeProgram->title }}
        </h2>

        <p class="mt-3 text-sm text-gray-600">
          Day {{ $currentDay }} / {{ $totalDays }}
        </p>

        <a href="{{ route('user.programs.show', $activeProgram) }}"
          class="mt-5 inline-flex items-center justify-center
                  rounded-lg bg-indigo-600 px-5 py-2.5
                  text-sm font-medium text-white
                  hover:bg-indigo-700 transition">
          Continue Workout
        </a>

      </div>
    </div>
  @else
  {{-- EMPTY STATE: belum punya program --}}
    <div class="bg-white rounded-xl border p-8 text-center max-w-xl">
      <div class="mb-4 text-indigo-600">
        <i class="fa-solid fa-dumbbell text-4xl"></i>
      </div>

      <h2 class="text-xl font-semibold text-gray-800 mb-2">
        Kamu belum punya program latihan
      </h2>

      <p class="text-gray-600 mb-6">
        Buat program latihan 30 hari yang sesuai dengan tujuan dan level kamu.
      </p>

      <a href="{{ route('user.programs.create') }}"
        class="inline-flex items-center justify-center
                px-6 py-3 rounded-lg
                bg-indigo-600 text-white
                hover:bg-indigo-700 transition">
        <i class="fa-solid fa-plus mr-2"></i>
        Generate 30 Days Workout
      </a>
    </div>
  @endif

</x-user.layout>
