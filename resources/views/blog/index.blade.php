<x-layout title="Blogs">
  <div class="max-w-7xl mx-auto mt-8 px-4 sm:px-8 font-hanken">

    <h1 class="text-2xl font-semibold text-gray-800 mb-14">
      Welcome to my Blogs. 
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      {{-- ALL POSTS --}}
      <a href="{{ route('blogs.posts.index') }}"
         class="group block bg-white rounded-2xl border border-indigo-200
                hover:border-indigo-500 hover:shadow-lg
                transition-all duration-200 p-6">

        <div class="flex items-center justify-between">
          <h3 class="text-lg font-semibold text-gray-800">
            All Posts
          </h3>
          <span class="text-sm text-gray-500">
            {{ $totalPosts }}
          </span>
        </div>

        <p class="text-sm text-gray-500 mt-2">
          Lihat semua artikel terbaru.
        </p>
      </a>

      {{-- CATEGORIES --}}
      @foreach ($categories as $category)
        <a href="{{ route('blogs.category', $category->slug) }}"
          class="group block bg-white rounded-2xl border border-gray-200
                  hover:border-indigo-500 hover:shadow-lg
                  transition-all duration-200 p-6">

          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">
              {{ $category->name }}
            </h3>
            <span class="text-sm text-gray-500">
              {{ $category->posts_count }}
            </span>
          </div>

          <p class="text-sm text-gray-500 mt-2">
            Artikel dalam kategori {{ $category->name }}.
          </p>
        </a>
      @endforeach

    </div>

  </div>
</x-layout>
