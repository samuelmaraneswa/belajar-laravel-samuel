<x-layout :title="$category->name">

  <div class="max-w-7xl mx-auto mt-8 px-4 sm:px-8 font-hanken mb-10">

    {{-- TITLE --}}
    <div class="mb-14">
      <h1 class="text-2xl font-semibold text-gray-800">
        {{ $category->name }}
      </h1>
    </div>

    {{-- TEMAS GRID --}}
    @if ($temas->isEmpty())
      <div class="text-center text-gray-500 py-20">
        Belum ada tema di kategori ini.
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($temas as $tema)
          <a href="{{ route('blogs.posts.index', [
                    'category' => $category->slug,
                    'tema' => $tema->slug
                  ]) }}"
            class="group relative overflow-hidden rounded-2xl
                    bg-linear-to-br from-indigo-50 to-white
                    border border-indigo-100
                    hover:shadow-xl hover:-translate-y-1
                    transition-all duration-300 p-6">

            {{-- Badge jumlah artikel --}}
            <div class="absolute top-4 right-4">
              <span class="text-xs font-semibold
                          bg-indigo-100 text-indigo-600
                          px-2 py-1 rounded-full">
                {{ $tema->posts_count }} articles
              </span>
            </div>

            {{-- Title --}}
            <h3 class="text-xl font-bold text-gray-800 mb-3
                      group-hover:text-indigo-600 transition">
              {{ $tema->name }}
            </h3>

            {{-- Description --}}
            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
              Deep dive into {{ $tema->name }} training,
              techniques, and real progress insights.
            </p>

            {{-- CTA --}}
            <div class="flex items-center text-sm font-semibold
                        text-indigo-600 group-hover:translate-x-1
                        transition">
              Explore Topic →
            </div>

          </a>
        @endforeach

      </div>
    @endif


  </div>

</x-layout>
