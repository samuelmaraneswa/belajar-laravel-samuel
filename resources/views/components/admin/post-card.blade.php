@props(['post'])

<div class="bg-white border rounded-xl overflow-hidden shadow-sm hover:shadow transition flex flex-col">

  {{-- IMAGE --}}
  @if ($post->thumb)
    <img
      src="{{ asset('storage/' . $post->thumb) }}"
      alt="{{ $post->title }}"
      class="w-full h-48 object-cover bg-gray-100"
    >
  @endif

  <div class="p-4 flex flex-col flex-1">

    {{-- TITLE --}}
    <h3 class="font-semibold text-gray-800 mb-2 leading-snug">
      {{ $post->title }}
    </h3>

    {{-- CATEGORY | TEMA --}}
    <div class="text-sm text-gray-600 mb-3">
      {{ $post->category->name ?? '-' }}
      |
      {{ $post->tema->name ?? '-' }}
    </div>

    {{-- Content (100 WORDS) --}}
    <p class="text-gray-700 flex-1">
      {{ \Illuminate\Support\Str::words($post->content, 20, '...') }}
    </p>

    {{-- ACTION --}}
    <div class="mt-4 flex items-center justify-start gap-2">

      {{-- VIEW --}}
      <a
        href="{{ route('admin.blog.posts.show', $post->slug) }}"
        class="inline-flex items-center
              px-3 py-2 text-sm font-medium
              bg-gray-600 text-white rounded-lg
              hover:bg-gray-700 transition"
      >
        View
      </a>

      {{-- EDIT --}}
      <a
        href="{{ route('admin.blog.posts.edit', $post->slug) }}"
        class="inline-flex items-center
              px-3 py-2 font-medium text-sm
              bg-green-600  text-white rounded-lg
              hover:bg-green-700 transition"
      >
        Edit
      </a>

      {{-- DELETE --}}
      <x-form
        action="{{ route('admin.blog.posts.destroy', $post->slug) }}"
        method="POST"
        onsubmit="return confirm('Yakin ingin menghapus post ini?')"
      >
        @method('DELETE')

        <button
          type="submit"
          class="inline-flex items-center gap-2
                 px-3 py-2 rounded-lg
                 bg-red-600 text-white text-sm
                 hover:bg-red-700 transition"
        >
          Delete
        </button>
      </x-form>

    </div>

  </div>
</div>
