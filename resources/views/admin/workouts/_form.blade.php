{{-- Title --}}
<x-input label="Title" name="title" placeholder="Contoh: Push up" value="{{ old('title', $workout->title ?? '') }}" class="border-gray-300" />

@error('slug')
  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror

{{-- Kategori --}}
<x-select
  label="Kategori"
  name="workout_category_id"
  :options="$categories->pluck('name','id')"
  :selected="old('workout_category_id', $workout->workout_category_id ?? null)"
  placeholder="--Pilih Kategori--"
/>

{{-- Type --}}
<x-select 
  label="Workout Type" 
  name="type"
  :options="['machine' => 'Machine', 'bodyweight' => 'Bodyweight', 'assisted' => 'Assisted', 'resistance-band' => 'Resistance Band']"
  placeholder="--Pilih Type--"
  :selected="old('type', $workout->type ?? null)"
  class="border-gray-300"
/>

{{-- Movement --}}
<x-select 
  label="Movement Type"
  name="movement"
  :options="['compound' => 'Compound', 'isolation' => 'Isolation']"
  placeholder="--Pilih Movement--"
  :selected="old('movement', $workout->movement ?? null)"
  class="border-gray-300"
/>

{{-- Difficulty --}}
<x-select label="Difficulty (optional)" name="difficulty" :options="['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced']" placeholder="--Pilih Difficulty--" :selected="old('difficulty', $workout->difficulty ?? null)" />

{{-- Difficulty Factor --}}
<div>
  <label class="block font-semibold mb-1">
    Difficulty Factor
  </label>

  <input
    type="number"
    name="difficulty_factor"
    step="0.05"
    min="0.2"
    max="1.5"
    value="{{ old('difficulty_factor', $workout->difficulty_factor ?? '') }}"
    class="w-full border rounded px-3 py-2 border-gray-300"
    placeholder="Contoh: 1.0 / 0.7 / 0.35"
  />

  <p class="text-xs text-gray-500 mt-1">
    0.3–0.4 (isolation ringan) · 0.6–0.8 (compound sedang) · 0.9–1.1 (compound berat)
  </p>

  @error('difficulty_factor')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
  @enderror
</div>

{{-- Contexts --}}
<x-checkbox-group 
  label="Workout Context" 
  name="contexts[]"
  :items="$contexts->pluck('name','id')" 
  :selected="old(
    'contexts',
    isset($workout) ? $workout->contexts->pluck('id')->toArray() : []
  )" 
/>

@error('contexts')
  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror

{{-- Equipments --}}
<x-checkbox-group 
  label="Equipments (Optional)" 
  name="equipments[]" 
  :items="$equipments->pluck('name','id')" 
  :selected="old(
    'equipments',
    isset($workout)
      ? $workout->equipments->pluck('id')->toArray()
      : []
  )"
/>

{{-- Primary Muscle --}}
<x-checkbox-group 
  label="Primary Muscle" 
  name="primary_muscles[]" 
  :items="$muscles->pluck('name','id')"
  :selected="old(
    'primary_muscles',
    isset($workout)
      ? $workout->muscles->where('pivot.role','primary')->pluck('id')->toArray()
      : []
  )" 
/>

@error('primary_muscles')
  <p class="text-sm text-red-600 
  mt-1">{{ $message }}</p>
@enderror

{{-- Secondary Muscle --}}
<x-checkbox-group 
  label="Secondary Muscles" 
  name="secondary_muscles[]" 
  :items="$muscles->pluck('name','id')"
  :selected="old(
    'secondary_muscles',
    isset($workout)
      ? $workout->muscles->where('pivot.role','secondary')->pluck('id')->toArray()
      : []
  )" 
/>

@error('secondary_muscles')
  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror

{{-- Deskripsi --}}
<x-textarea
  label="Deskripsi"
  name="description"
  rows="4"
  placeholder="Deskripsi..."
  :value="$workout->description ?? ''"
/>

{{-- Intructions --}}
<div>
  <label class="block font-semibold mb-2">Instructions (Step by Step)</label>

  @php
    $steps = old(
      'instructions',
      isset($workout)
        ? $workout->instructions->pluck('instruction')->toArray()
        : ['']
    );
  @endphp

  <ul id="instruction-list" class="space-y-2">
    @foreach($steps as $i => $step)
      <li class="flex gap-2">
        <input
          type="text"
          name="instructions[]"
          value="{{ $step }}"
          class="flex-1 border rounded px-3 py-2"
          placeholder="Step {{ $i + 1 }}"
          required
        />
        <button type="button" class="remove-step text-red-600">✕</button>
      </li>
    @endforeach
  </ul>

  <button
    type="button"
    id="add-step"
    class="mt-2 text-sm text-indigo-600 hover:underline cursor-pointer"
  >
    + Tambah Step
  </button>

  @error('instructions')
    <p class="text-sm text-red-600">{{ $message }}</p>
  @enderror
</div>

{{-- Gambar --}}
<x-input label="Image" name="image" type="file" accept="image/*" class="block w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border-gray-300" />

{{-- GIF (Optional) --}}
<x-input
  label="GIF Demonstration (Optional)"
  name="gif"
  type="file"
  accept="image/gif"
  class="block w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border-gray-300"
/>

{{-- Video --}}
<x-input label="Video" name="video" type="file" accept="video/*" class="block w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border-gray-300 " />
