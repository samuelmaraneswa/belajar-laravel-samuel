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
        placeholder="--Pilih Tipe Workout--"
        class="border-gray-300"
      />

      @error('type')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      {{-- Primary Muscle --}}
      <x-checkbox-group label="Primary Muscle" name="primary_muscles" :items="$muscles->pluck('name','id')" />
      
      @error('primary_muscles')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
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

      {{-- Gambar --}}
      <x-input label="Image" name="image" type="file" class="block w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border-gray-300" />

      @error('image')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      {{-- Video --}}
      <x-input label="Video" name="video" type="file" accept="video/*" class="block w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border-gray-300 " />

      {{-- Button --}}
      <div class="flex justify-end">
        <x-button type="submit" class="bg-indigo-600 text-white hover:bg-indigo-700 hover:text-white/90">Tambah</x-button>
      </div>

    </x-form>
  </div>
</x-admin-layout>
