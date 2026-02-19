<a
  href="{{ route('public.articles.show', $article->slug) }}"
  class="group block bg-white rounded-2xl overflow-hidden
         border border-indigo-200
         hover:border-indigo-500 hover:shadow-lg
         transition-all duration-200"
>

  {{-- IMAGE --}}
  <div class="aspect-video bg-gray-100 overflow-hidden">
    @if ($article->thumb)
      <img
        src="{{ asset('storage/'.$article->thumb) }}"
        alt="{{ $article->title }}"
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
      {{ $article->title }}
    </h3>

    {{-- META --}}
    <div class="text-xs text-gray-500">
      {{ $article->created_at->format('d M Y') }}
    </div>

    {{-- EXCERPT --}}
    <p class="text-sm text-gray-600 line-clamp-3">
      {{ Str::limit(strip_tags($article->content), 120) }}
    </p>

  </div>
</a>
