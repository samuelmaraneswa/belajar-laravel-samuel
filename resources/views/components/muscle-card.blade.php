@props(['name','slug'])

@php
  $isActive = request('muscle') === $slug;

  $frontMuscles = [
    'chest','core','obliques','quads','abductors',
    'adductors','biceps','forearms','necks','shoulders'
  ];

  $query = array_filter([
    'muscle'  => $slug,
    'context' => request('context'),
    'search'  => request('search'),
  ]);
@endphp

<a href="{{ url('/admin/workouts/list') . '?' . http_build_query($query) }}"
   class="group transition flex flex-col items-center w-20 shrink-0">

  <div
    class="h-20 w-20 overflow-hidden ml-2 my-2
           bg-gray-300 border rounded-lg
           flex items-center justify-center
           focus-{{ $slug }}
           transition
           group-hover:ring-2 ring-indigo-500
           {{ $isActive ? 'ring-2 ring-indigo-500' : '' }}"
  >

    <div class="muscle-card relative" data-muscle="{{ $slug }}">
      <div class="relative
                  [&_svg]:w-30
                  [&_svg]:translate-x-(--x)
                  [&_svg]:translate-y-(--y)">
        @if(in_array($slug, $frontMuscles))
          @include('svg.body-map-front')
        @else
          @include('svg.body-map-back')
        @endif
      </div>
    </div>

  </div>

  <p class="text-xs font-medium
    {{ $isActive
        ? 'text-indigo-700 font-bold'
        : 'text-gray-700 group-hover:text-indigo-600'
    }}">
    {{ $name }}
  </p>
</a>
