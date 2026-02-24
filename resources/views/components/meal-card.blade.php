<a
  href="{{ route('meals.items.show', [
      'meal' => $meal->slug,
      'category' => request('category'),
      'goal' => request('goal'),
  ]) }}"
  
  class="group block bg-white rounded-2xl overflow-hidden
         border border-indigo-200
         hover:border-indigo-500 hover:shadow-lg
         transition-all duration-200"
>

  {{-- IMAGE --}}
  <div class="aspect-video bg-gray-100 overflow-hidden">
    @if ($meal->image)
      <img
        src="{{ asset('storage/'.$meal->image) }}"
        alt="{{ $meal->title }}"
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
      {{ $meal->title }}
    </h3>

    {{-- META (CATEGORY | GOAL | DATE) --}}
    <div class="flex items-center gap-2 text-xs text-gray-500 flex-wrap">

      {{-- CATEGORY --}}
      <span class="uppercase tracking-wide">
        #{{ $meal->category->name ?? 'meal' }}
      </span>

      @if ($meal->goal)
        <span class="text-gray-300">|</span>
        <span>
          {{ $meal->goal->name }}
        </span>
      @endif

      <span class="text-gray-300">|</span>

      {{-- DATE --}}
      <span>
        {{ $meal->created_at->format('d M Y') }}
      </span>

    </div>

    {{-- EXCERPT --}}
    <p class="text-sm text-gray-600 line-clamp-3">
      {{ Str::limit(strip_tags($meal->description), 120) }}
    </p>

  </div>
</a>