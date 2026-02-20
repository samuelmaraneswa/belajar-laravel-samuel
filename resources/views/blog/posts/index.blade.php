<x-layout title="Blog">
  <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-8 font-hanken">

    {{-- SEARCH --}}
    <x-search.form
      action="/blogs/posts"
      placeholder="Cari artikel..."
      suggestUrl="/blogs/suggest"
    />

    {{-- CONTENT --}}
    @if ($posts->isEmpty()) 
      <div class="text-center text-gray-500 py-20">
        Belum ada artikel.
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8 mb-12">
        @foreach ($posts as $post)
          <x-blog-card :post="$post" />
        @endforeach
      </div>

      <div class="mb-12 flex justify-center">
        {{ $posts->onEachSide(1)->links('pagination::tailwind') }}
      </div>
    @endif

  </div>
</x-layout>
