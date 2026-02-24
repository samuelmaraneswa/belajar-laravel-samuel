<x-layout title="Meals">
  <div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 font-hanken space-y-14">

    {{-- ================= ALL MEALS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <a href="{{ route('meals.items.index') }}"
         class="block bg-white rounded-2xl border border-indigo-200
                hover:border-indigo-500 hover:shadow-lg
                transition-all duration-200 p-6">

        <div class="flex items-center justify-between">
          <h3 class="text-lg font-semibold text-gray-800">
            All Meals
          </h3>
          <span class="text-sm text-gray-500">
            {{ $categories->sum('meals_count') }}
          </span>
        </div>

        <p class="text-sm text-gray-500 mt-2">
          Lihat semua koleksi menu sehat.
        </p>
      </a>

    </div>

    {{-- ================= CATEGORIES ================= --}}
    <div>
      <h2 class="text-lg font-semibold mb-6">Meal Categories</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($categories as $category)
          <a href="{{ route('meals.items.index', ['category' => $category->slug]) }}"
             class="block bg-white rounded-2xl border border-gray-200
                    hover:border-indigo-500 hover:shadow-lg
                    transition-all duration-200 p-6">

            <div class="flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-800">
                {{ $category->name }}
              </h3>
              <span class="text-sm text-gray-500">
                {{ $category->meals_count }}
              </span>
            </div>

            <p class="text-sm text-gray-500 mt-2">
              Meals dalam kategori {{ $category->name }}.
            </p>
          </a>
        @endforeach
      </div>
    </div>

    {{-- ================= GOALS ================= --}}
    <div>
      <h2 class="text-lg font-semibold mb-6">Meal Goals</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($goals as $goal)
          <a href="{{ route('meals.items.index', ['goal' => $goal->slug]) }}"
             class="block bg-white rounded-2xl border border-gray-200
                    hover:border-indigo-500 hover:shadow-lg
                    transition-all duration-200 p-6">

            <div class="flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-800">
                {{ $goal->name }}
              </h3>
              <span class="text-sm text-gray-500">
                {{ $goal->meals_count }}
              </span>
            </div>

            <p class="text-sm text-gray-500 mt-2">
              Meals untuk goal {{ $goal->name }}.
            </p>
          </a>
        @endforeach
      </div>
    </div>

  </div>
</x-layout>