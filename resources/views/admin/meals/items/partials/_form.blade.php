<form id="meals-item-form" class="space-y-6">

  @csrf

  {{-- CATEGORY --}}
  <x-select
    label="Category"
    name="category_id"
    :options="$categories->pluck('name','id')"
    placeholder="-- Pilih Category --"
    :selected="old('category_id', $meal->category_id ?? null)"
  />

  {{-- GOAL --}}
  <x-select
    label="Goal"
    name="goal_id"
    :options="$goals->pluck('name','id')"
    placeholder="-- Pilih Goal (Opsional) --"
    :selected="old('goal_id', $meal->goal_id ?? null)"
  />

  {{-- TITLE --}}
  <x-input
    label="Title"
    name="title"
    placeholder="Contoh: Ayam Gulai"
    value="{{ old('title', $meal->title ?? '') }}"
  />

  {{-- DESCRIPTION --}}
  <x-textarea
    label="Description"
    name="description"
    rows="4"
    placeholder="Deskripsi singkat..."
    :value="old('description', $meal->description ?? '')"
  />

  {{-- PREP TIME --}}
  <x-input
    label="Preparation Time (minutes)"
    name="prep_time"
    type="number"
    placeholder="Contoh: 45"
    value="{{ old('prep_time', $meal->prep_time ?? '') }}"
  />

  {{-- IMAGE --}}
  <x-input
    label="Image"
    name="image"
    type="file"
    accept="image/*"
  />

  {{-- VIDEO URL --}}
  <x-input
    label="Video URL"
    name="video_url"
    placeholder="https://youtube.com/..."
    value="{{ old('video_url', $meal->video_url ?? '') }}"
  />

  {{-- =========================================
      INGREDIENTS (meal_food)
  ========================================== --}}
  <div id="meals-ingredients-section"
       class="p-4 border rounded-lg bg-gray-50">

    <div class="flex justify-between items-center mb-3">
      <h3 class="font-semibold">Ingredients</h3>

      <button type="button"
        id="meals-add-ingredient-btn"
        class="text-indigo-600 text-sm cursor-pointer">
        + Add Ingredient
      </button>
    </div>

    <div id="meals-ingredients-list" class="space-y-3"></div>

    {{-- TEMPLATE --}}
    <template id="meals-ingredient-template">
      <div class="meals-ingredient-item p-3 border rounded bg-white">

        <div class="flex justify-between items-center mb-2">
          <span class="text-sm font-medium">Ingredient</span>
          <button type="button"
            class="meals-remove-ingredient text-red-500 text-sm cursor-pointer">
            ✕
          </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

          <select name="ingredients[__INDEX__][food_id]"
                  class="border rounded px-3 py-2">
            <option value="">-- Pilih Food --</option>
            @foreach($foods as $food)
              <option value="{{ $food->id }}">
                {{ $food->name }}
              </option>
            @endforeach
          </select>

          <input type="number"
            step="0.01"
            name="ingredients[__INDEX__][quantity]"
            placeholder="Quantity"
            class="border rounded px-3 py-2" />

        </div>

      </div>
    </template>

  </div>


  {{-- =========================================
      STEPS (meal_steps)
  ========================================== --}}
  <div id="meals-steps-section"
       class="p-4 border rounded-lg bg-gray-50">

    <div class="flex justify-between items-center mb-3">
      <h3 class="font-semibold">Cooking Steps</h3>

      <button type="button"
        id="meals-add-step-btn"
        class="text-indigo-600 text-sm cursor-pointer">
        + Add Step
      </button>
    </div>

    <div id="meals-steps-list" class="space-y-3"></div>

    {{-- TEMPLATE --}}
    <template id="meals-step-template">
      <div class="meals-step-item p-3 border rounded bg-white">

        <div class="flex justify-between items-center mb-2">
          <span class="text-sm font-medium">Step</span>
          <button type="button"
            class="meals-remove-step text-red-500 text-sm cursor-pointer">
            ✕
          </button>
        </div>

        <input type="hidden"
          name="steps[__INDEX__][step_number]"
          value="__STEP_NUMBER__">

        <textarea
          name="steps[__INDEX__][instruction]"
          rows="3"
          placeholder="Tuliskan langkah memasak..."
          class="w-full border rounded px-3 py-2"
        ></textarea>

      </div>
    </template>

  </div>


  {{-- ACTION BUTTON --}}
  <div class="flex justify-end gap-3 pt-4">
    <button type="button"
      id="meals-btn-cancel"
      class="px-4 py-2 bg-gray-200 rounded cursor-pointer hover:bg-gray-300">
      Batal
    </button>

    <button type="submit"
      class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 cursor-pointer text-white rounded">
      Simpan
    </button>
  </div>

</form>