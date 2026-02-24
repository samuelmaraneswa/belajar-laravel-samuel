<x-admin-layout>
  <div class="p-6 space-y-10">

    {{-- ================= ALL MEALS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <x-admin.stat-card
        title="All Meals"
        :value="$categories->sum('meals_count')"
        icon="utensils"
        color="indigo"
        href="{{ route('admin.meals.items.index') }}"
      />

    </div>

    {{-- ================= CATEGORIES ================= --}}
    <div>
      <h2 class="text-lg font-semibold mb-4">Meal Categories</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($categories as $category)
          <x-admin.stat-card
            :title="$category->name"
            :value="$category->meals_count"
            icon="bowl-food"
            color="green"
            href="{{ route('admin.meals.items.index', ['category' => $category->slug]) }}"
          />
        @endforeach
      </div>
    </div>

    {{-- ================= GOALS ================= --}}
    <div>
      <h2 class="text-lg font-semibold mb-4">Meal Goals</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($goals as $goal)
          <x-admin.stat-card
            :title="$goal->name"
            :value="$goal->meals_count"
            icon="fire"
            color="red"
            href="{{ route('admin.meals.items.index', ['goal' => $goal->slug]) }}"
          />
        @endforeach
      </div>
    </div>

  </div>
</x-admin-layout>