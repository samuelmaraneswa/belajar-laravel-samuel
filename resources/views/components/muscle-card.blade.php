@props(['name','slug'])

@php
  $frontMuscles = ['chest','core','obliques','quads','abductors','adductors','biceps','obliques','forearms','necks','shoulders'];
@endphp

<a href="?muscle={{ $slug }}"
   class="group transition flex flex-col items-center w-20 shrink-0">

  <div class="h-20 w-20 overflow-hidden mb-2 bg-gray-300 border rounded-lg
              flex items-center justify-center
              focus-{{ $slug }}
              transition
              group-hover:shadow-md">

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

  <p class="text-xs font-medium text-gray-700 group-hover:text-indigo-600">
    {{ $name }}
  </p>
</a>
