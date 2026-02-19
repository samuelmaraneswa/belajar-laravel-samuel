<x-layout class="px-4 sm:px-8 py-8 max-w-4xl mx-auto">

  {{-- TITLE --}}
  <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight">
    {{ $article->title }}
  </h1>

  {{-- META --}}
  <div class="mt-3 text-sm text-gray-500">
    Dipublikasikan {{ $article->created_at->format('d M Y') }}
  </div>

  <x-hr class="my-6" />

  {{-- FEATURED IMAGE --}}
  @if ($article->image)
    <div class="rounded-xl overflow-hidden mb-8">
      <img
        src="{{ asset('storage/' . $article->image) }}"
        alt="{{ $article->title }}"
        class="w-full h-auto object-cover"
      >
    </div>
  @endif

  {{-- CONTENT --}}
  <article class="prose prose-lg max-w-none [&_ul]:list-disc [&_ul]:pl-6 [&_ol]:list-decimal [&_ol]:pl-6">
    {!! $article->content !!}
  </article>

  {{-- VIDEO (OPTIONAL) --}}
  @if ($article->video)
    <div class="mt-8 rounded-xl overflow-hidden">
      <video controls class="w-full h-auto">
        <source src="{{ asset('storage/' . $article->video) }}" type="video/mp4">
        Browser tidak mendukung video.
      </video>
    </div>
  @endif

  {{-- SIMILAR ARTICLES --}}
  @if ($similarArticles->count())
    <section class="mt-16">
      <h2 class="text-xl font-bold text-gray-800 mb-6">
        Artikel Lainnya
      </h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($similarArticles as $article)
          <x-public.article-card :article="$article" />
        @endforeach
      </div>
    </section>
  @endif

</x-layout>
