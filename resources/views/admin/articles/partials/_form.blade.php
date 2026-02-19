<h2 class="text-lg font-semibold mb-4 mt-2">
  {{ isset($article) ? 'Edit Article' : 'Create Article' }}
</h2>

<form 
  id="articleForm"
  method="POST"
  action="{{ isset($article) 
      ? route('articles.update', $article) 
      : route('articles.store') }}"
  class="space-y-5"
  enctype="multipart/form-data"
>
  @csrf

   @if(isset($article))
    @method('PUT')
  @endif

  {{-- TITLE --}}
  <div>
    <x-input
      name="title"
      placeholder="Title"
      value="{{ $article->title ?? '' }}"
    />
  </div>

  {{-- YOUTUBE LINK --}}
  <div>
    <x-input
      name="video"
      placeholder="YouTube Link (optional)"
      value="{{ $article->video ?? '' }}"
    />
  </div>

  {{-- IMAGE --}}
  <div>
    <label class="block text-sm font-medium mb-1">Thumbnail Image</label>

    <input
      type="file"
      name="image"
      class="w-full border rounded-lg p-2"
    />

    {{-- Nama file lama --}}
    @if(isset($article) && $article->image)
      <p class="text-sm text-gray-500 mt-2">
        File tersimpan: 
        <span class="font-medium text-gray-700">
          {{ basename($article->image) }}
        </span>
      </p>
    @endif
  </div>

  {{-- STATUS (GANTI SELECT JADI RADIO) --}}
  <div>
    <label class="block text-sm font-medium mb-2">Status</label>

    <div class="flex gap-4">

      <label class="flex items-center gap-2 cursor-pointer">
        <input
          type="radio"
          name="status"
          value="draft"
          class="accent-indigo-600"
          {{ !isset($article) || $article->status === 'draft' ? 'checked' : '' }}
        >
        <span>Draft</span>
      </label>

      <label class="flex items-center gap-2 cursor-pointer">
        <input
          type="radio"
          name="status"
          value="published"
          class="accent-indigo-600"
          {{ isset($article) && $article->status === 'published' ? 'checked' : '' }}
        >
        <span>Published</span>
      </label>

    </div>
  </div>

  {{-- CONTENT --}}
  <div>
    <label class="block text-sm font-medium mb-1">Content</label>
    <textarea
      id="articleContent"
      name="content"
      class="w-full border rounded-lg p-3"
      rows="6">{{ $article->content ?? '' }}</textarea>
  </div>

  {{-- SUBMIT --}}
  <div class="pt-2">
    <button
      type="submit"
      class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 cursor-pointer">
      Simpan
    </button>
  </div>

</form>
