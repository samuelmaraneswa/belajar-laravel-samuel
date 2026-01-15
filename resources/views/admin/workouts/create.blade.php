<x-admin-layout>
  <div class="max-w-2xl mx-auto bg-white shadow-[0_2px_8px_rgba(0,0,0,0.3)] rounded-xl p-8 font-hanken mb-10">

    <x-admin.page-title title="Tambah Workout" />

    <x-hr />

    <x-form action="{{route('admin.workout.store')}}" enctype="multipart/form-data" class="space-y-6">
      {{-- Title --}}
      <x-input label="Title" name="title" placeholder="Contoh: Push up" class="border-gray-300" />

      @error('title')
        <p class="text-sm text-red-600 mt-1">{{$message}}</p>
      @enderror

      @error('slug')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      {{-- Kategori --}}
      <x-select label="Kategori" name="workout_category_id" :options="$categories->pluck('name','id')" placeholder="--Pilih Kategori--" class="border-gray-300" />

      @error('workout_category_id')
        <p class="text-sm text-red-600 mt-1"> {{$message}} </p>
      @enderror

      {{-- Type --}}
      <x-select 
        label="Workout Type" 
        name="type"
        :options="['machine' => 'Machine', 'bodyweight' => 'Bodyweight']"
        placeholder="--Pilih Type--"
        class="border-gray-300"
      />

      @error('type')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      {{-- Movement --}}
      <x-select 
        label="Movement Type"
        name="movement"
        :options="['compound' => 'Compound', 'isolation' => 'Isolation']"
        placeholder="--Pilih Movement--"
        class="border-gray-300"
      />

      @error('movement')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      {{-- Difficulty --}}
      <x-select label="Difficulty (optional)" name="difficulty" :options="['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced']" placeholder="--Pilih Difficulty--" />

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
          value="{{ old('difficulty_factor') }}"
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
      <x-checkbox-group label="Workout Context" name="contexts" :items="$contexts->pluck('name','id')" />

      @error('contexts')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      {{-- Equipments --}}
      <x-checkbox-group label="Equipments (Optional)" name="equipments" :items="$equipments->pluck('name','id')" />

      {{-- Primary Muscle --}}
      <x-checkbox-group label="Primary Muscle" name="primary_muscles" :items="$muscles->pluck('name','id')" />
      
      @error('primary_muscles')
        <p class="text-sm text-red-600 
        mt-1">{{ $message }}</p>
      @enderror

      {{-- Secondary Muscle --}}
      <x-checkbox-group label="Secondary Muscles" name="secondary_muscles" :items="$muscles->pluck('name','id')" />
      
      @error('secondary_muscles')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      {{-- Deskripsi --}}
      <x-textarea label="Deskripsi" name="description" rows="4" placeholder="Deskripsi..." />

      @error('description')
        <p class="text-sm text-red-600 mt-1"> {{$message}} </p>
      @enderror

      {{-- Intructions --}}
      <div>
        <label class="block font-semibold mb-2">Instructions (Step by Step)</label>

        <ul id="instruction-list" class="space-y-2">
          @forelse(old('instructions', ['']) as $i => $step)
            <li class="flex gap-2">
              <input
                type="text"
                name="instructions[]"
                value="{{ $step }}"
                class="flex-1 border rounded px-3 py-2"
                placeholder="Step {{ $i+1 }}"
                required
              />
              <button type="button" class="remove-step text-red-600">✕</button>
            </li>
          @empty
          @endforelse
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

      @error('image')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      {{-- GIF (Optional) --}}
      <x-input
        label="GIF Demonstration (Optional)"
        name="gif"
        type="file"
        accept="image/gif"
        class="block w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border-gray-300"
      />

      @error('gif')
        <p class="text-sm text-red-600">{{ $message }}</p>
      @enderror

      {{-- Video --}}
      <x-input label="Video" name="video" type="file" accept="video/*" class="block w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border-gray-300 " />

      {{-- Submit --}}
      <div class="flex justify-end">
        <x-button type="submit" class="bg-indigo-600 text-white hover:bg-indigo-700 hover:text-white/90">Tambah</x-button>
      </div>

    </x-form>
  </div>
</x-admin-layout>
