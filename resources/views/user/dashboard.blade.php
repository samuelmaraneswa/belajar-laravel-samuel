<x-user.layout>

  {{-- Greeting --}}
  <h1 class="text-2xl font-semibold text-gray-800 mb-2">
    Hi, {{ auth()->user()->name }} 👋
  </h1>
  <p class="text-gray-600 mb-6">
    Selamat datang di dashboard kamu
  </p>

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

    <a href="{{ route('program.generate') }}"
       class="inline-flex items-center justify-center
              px-6 py-3 rounded-lg
              bg-indigo-600 text-white
              hover:bg-indigo-700 transition">
      <i class="fa-solid fa-plus mr-2"></i>
      Generate 30 Days Workout
    </a>
  </div>

</x-user.layout>
