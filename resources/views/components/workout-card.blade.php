<a
  href="{{ route('workouts.show', $workout->slug) }}"
  class="group block bg-white rounded-2xl overflow-hidden
         border border-indigo-200
         hover:border-indigo-500 hover:shadow-lg
         transition-all duration-200"
>

  {{-- IMAGE --}}
  <div class="aspect-video bg-gray-100 overflow-hidden">
    @if ($workout->image_thumb)
      <img
        src="{{ asset('storage/'.$workout->image_thumb) }}"
        alt="{{ $workout->title }}"
        class="w-full h-full object-cover
               transition-transform duration-300
               group-hover:scale-105"
      >
    @else
      <div class="flex items-center justify-center h-full text-gray-400">
        No Image
      </div>
    @endif
  </div>

  {{-- CONTENT --}}
  <div class="p-4 space-y-2">

    {{-- TITLE --}}
    <h3 class="font-semibold text-lg text-gray-800 line-clamp-2">
      {{ $workout->title }}
    </h3>

    {{-- META (CATEGORY | MUSCLE) --}}
    <div class="flex items-center gap-2 text-xs text-gray-500">

      {{-- CATEGORY --}}
      <span class="uppercase tracking-wide">
        #{{ $workout->category->name ?? 'workout' }}
      </span>

      <span class="text-gray-300">|</span>

      {{-- MUSCLES --}}
      <div class="flex gap-1 flex-nowrap overflow-hidden">
        @foreach ($workout->muscles as $muscle)
          <span
            class="px-2 py-0.5 rounded-full font-medium
            {{ $muscle->pivot->role === 'primary'
                ? 'bg-red-100 text-red-600'
                : 'bg-green-100 text-green-600'
            }}">
            {{ $muscle->name }}
          </span>
        @endforeach
      </div>

    </div>

    {{-- DESCRIPTION --}}
    <p class="text-sm text-gray-600 line-clamp-3">
      {{ $workout->description ?? 'Tidak ada deskripsi.' }}
    </p>

  </div>
</a>
