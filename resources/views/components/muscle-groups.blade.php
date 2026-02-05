@props(['muscles', 'scope' => 'admin'])

@php
  $baseUrl = $scope === 'public'
    ? url('/workouts')
    : url('/admin/workouts/list');

  $isAllActive = !request('muscle');

  $frontMuscles = [
    'chest','core','obliques','quads','abductors',
    'adductors','biceps','forearms','necks','shoulders'
  ];
@endphp

<div class="my-2">
  <p class="font-bold text-gray-700 mb-2">Explore by Muscle Groups</p>

  <div class="flex gap-6 overflow-x-auto pb-2 scrollbar-hide border-y border-gray-300">

    {{-- ✅ ALL WORKOUT CARD (SVG, semua merah) --}}
    <a href="{{ $baseUrl }}"
       class="group transition flex flex-col items-center w-20 shrink-0">

      <div
        class="h-20 w-20 overflow-hidden ml-2 my-2
               bg-gray-300 border rounded-lg
               flex items-center justify-center
               focus-all
               transition
               group-hover:ring-2 ring-indigo-500
               {{ $isAllActive ? 'ring-2 ring-indigo-500' : '' }}"
      >
        <div class="muscle-card all-muscle relative">
          <div class="relative
            [&_svg]:w-30
            [&_svg]:translate-x-(--x)
            [&_svg]:translate-y-(--y)">
            @include('svg.body-map-front')
          </div>
        </div>
      </div>

      <p class="text-xs font-medium
        {{ $isAllActive
            ? 'text-indigo-700 font-bold'
            : 'text-gray-700 group-hover:text-indigo-600'
        }}">
        All
      </p>
    </a>

    {{-- ✅ MUSCLE CARDS --}}
    @foreach($muscles as $muscle)
      <x-muscle-card
        :name="$muscle['name']"
        :slug="$muscle['slug']"
        :scope="$scope"
      />
    @endforeach

  </div>
</div>
