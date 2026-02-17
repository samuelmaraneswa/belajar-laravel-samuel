<div class="space-y-6">

  {{-- TITLE --}}
  <div>
    <h2 class="text-2xl font-bold">
      {{ $article->title }}
    </h2>

    <span class="inline-block mt-2 px-3 py-1 text-xs rounded-full
      {{ $article->status === 'published'
          ? 'bg-green-100 text-green-700'
          : 'bg-gray-200 text-gray-600' }}">
      {{ ucfirst($article->status) }}
    </span>
  </div>

  {{-- IMAGE --}}
  @if($article->thumb || $article->image)
    <div class="rounded-xl overflow-hidden">
      <img
        src="{{ asset('storage/' . ($article->thumb ?? $article->image)) }}"
        class="w-full object-cover"
        alt="{{ $article->title }}">
    </div>
  @endif

  {{-- CONTENT --}}
  <div class="prose max-w-none">
    {!! $article->content !!}
  </div>

  {{-- VIDEO YOUTUBE --}}
  @php
    $youtubeId = null;

    if (!empty($article->video)) {
      $url = $article->video;

      if (str_contains($url, 'youtu.be')) {
        $youtubeId = basename(parse_url($url, PHP_URL_PATH));
      } elseif (str_contains($url, 'youtube.com')) {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        $youtubeId = $query['v'] ?? null;
      }
    }
  @endphp

  @if ($youtubeId)
    <div class="aspect-video w-full rounded-xl overflow-hidden shadow">
      <iframe
        src="https://www.youtube.com/embed/{{ $youtubeId }}"
        class="w-full h-full"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
      </iframe>
    </div>
  @endif

</div>
