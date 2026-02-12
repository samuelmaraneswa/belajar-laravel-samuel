{{-- CATEGORY --}}
<x-select
  label="Category"
  name="category_id"
  :options="$categories->pluck('name', 'id')"
  placeholder="-- Pilih Category --"
  :selected="old('category_id', $post->category_id ?? null)"
/>

{{-- TEMA --}}
<x-select
  label="Tema"
  name="tema_id"
  :options="[]"
  placeholder="-- Pilih Tema --"
  :selected="old('tema_id', $post->tema_id ?? null)"
/>

{{-- TITLE --}}
<x-input
  label="Title"
  name="title"
  placeholder="Contoh: Handstand Day 1"
  value="{{ old('title', $post->title ?? '') }}"
/>

{{-- EXCERPT --}}
<x-textarea
  label="Excerpt"
  name="excerpt"
  rows="2"
  placeholder="Ringkasan singkat post"
  :value="old('excerpt', $post->excerpt ?? '')"
/>

{{-- CONTENT --}}
<x-textarea
  label="Content"
  name="content"
  rows="8"
  placeholder="Ceritakan journey kamu..."
  :value="old('content', $post->content ?? '')"
/>

{{-- IMAGE --}}
<x-input
  label="Image"
  name="image"
  type="file"
  accept="image/*"
/>

@if(isset($post) && $post->image)
  <p class="text-sm text-gray-500">
    Image saat ini: {{ $post->image }}
  </p>
@endif

{{-- VIDEO URL --}}
<x-input
  label="YouTube Video URL"
  name="video_url"
  placeholder="https://www.youtube.com/watch?v=..."
  value="{{ old('video_url', $post->video_url ?? '') }}"
/>

{{-- STATUS --}}
<div class="mb-4">
  <label class="inline-flex items-center gap-2">
    <input
      type="checkbox"
      name="status"
      value="published"
      {{ old('status', $post->status ?? '') === 'published' ? 'checked' : '' }}
    >
    <span class="text-sm text-gray-600">Publish now</span>
  </label>
</div>

{{-- =========================
| CALISTHENICS WORKOUT DETAIL
| (conditional – via JS)
========================= --}}
<div
  id="calisthenics-fields"
  class="mt-6 p-4 border rounded-lg bg-gray-50"
>
  <div class="flex items-center justify-between mb-3">
    <h3 class="font-semibold text-gray-800">
      Workout Progressions
    </h3>

    <button
      type="button"
      id="add-progression"
      class="text-sm text-indigo-600 hover:underline cursor-pointer"
    >
      + Add Progression
    </button>
  </div>

  <div id="progression-list" class="space-y-4">
    {{-- injected via JS --}}
    <template id="progression-template">
      <div class="progression-item p-3 border rounded-lg bg-white">

        <input
          type="hidden"
          name="progressions[__INDEX__][id]"
          value=""
        />

        <div class="flex justify-between items-center mb-2">
          <span class="font-medium text-gray-700">Progression</span>
          <button
            type="button"
            class="remove-progression text-red-500 text-sm cursor-pointer"
          >
            ✕
          </button>
        </div>

        <label class="block text-sm mb-1 text-gray-600">
          Progression Name
        </label>
        <input
          type="text"
          name="progressions[__INDEX__][name]"
          class="w-full border rounded px-3 py-2 border-gray-300"
          placeholder="Wall Handstand / Band Assist"
        />

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 mt-3">
          <input
            type="number"
            name="progressions[__INDEX__][sets]"
            placeholder="Sets"
            class="border rounded px-3 py-2"
          />
          <input
            type="number"
            name="progressions[__INDEX__][reps]"
            placeholder="Reps"
            class="border rounded px-3 py-2"
          />
          <input
            type="number"
            name="progressions[__INDEX__][hold_seconds]"
            placeholder="Hold (sec)"
            class="border rounded px-3 py-2"
          />
          <input
            type="number"
            step="0.5"
            name="progressions[__INDEX__][weight]"
            placeholder="Weight (kg)"
            class="border rounded px-3 py-2"
          />
        </div>
      </div>
    </template>
  </div>
</div>

<script>
  window.oldFormData = {
    category_id: @json(old('category_id')),
    tema_id: @json(old('tema_id')),
    progressions: @json(old('progressions', [])),
  };
</script>
