<x-admin-layout>
  <div id="blogPage">
    <div class="max-w-7xl mx-auto font-hanken">

      <x-alert type="success" />

      {{-- Top Section --}} 
      <div class="flex justify-between items-center mb-6">
        @php
          $category = request('category');

          $title = $category
            ? Str::title(str_replace('-', ' ', $category)) . ' Posts' 
            : 'All Posts';

          $titleUrl = $category
            ? url('/admin/blog/posts?category=' . $category)
            : url('/admin/blog/posts');
        @endphp

        {{-- TITLE --}}
        <div class="hidden sm:block">
          <a href="{{ $titleUrl }}">
            <x-admin.page-title
              :title="$title"
              class="text-indigo-700 hover:underline"
            />
          </a>
        </div>

        {{-- SEARCH --}}
        <x-form action="javascript:void(0)" class="flex-1">
          <div class="flex items-center sm:mx-4 relative">
            <x-input
              inline
              id="search"
              name="search"
              placeholder="Cari post..." 
              autocomplete="off"
              :unstyled="true"
              class="w-full h-9 px-4 border rounded-lg mr-3"
            />

            <i
              id="searchIcon"
              class="fa-solid fa-magnifying-glass absolute right-6
                    text-gray-400 cursor-pointer"
            ></i>

            <x-admin.search-suggestions
              id="suggestions"
              class="absolute z-50 w-full bg-white border rounded-lg shadow
                    max-h-50 overflow-y-auto hidden"
            />
          </div>
        </x-form>

        {{-- ADD POST --}}
        <a href="{{ route('admin.blog.posts.create') }}">
          <x-button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
            <i class="fa fa-plus"></i>
            <span class="hidden sm:inline pl-1 text-sm">Tambah</span>
          </x-button>
        </a>
      </div>

      {{-- cards posts --}}
      <div id="postsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>

      {{-- pagination (AJAX INJECT) --}}
      <div id="pagination" class="mt-8 flex justify-center"></div>

    </div>
  </div>
</x-admin-layout>
