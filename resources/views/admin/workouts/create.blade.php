<x-admin-layout>
  <div class="max-w-2xl mx-auto bg-white shadow-[0_2px_8px_rgba(0,0,0,0.3)] rounded-xl p-8 font-hanken mb-10">

    <x-admin.page-title title="Tambah Workout" />

    <x-hr />

    <x-form action="{{route('admin.workout.store')}}" enctype="multipart/form-data" class="space-y-6">
      @include('admin.workouts._form')

      {{-- Submit --}}
      <div class="flex justify-end">
        <x-button type="submit" class="bg-indigo-600 text-white hover:bg-indigo-700 hover:text-white/90">Tambah</x-button>
      </div>
    </x-form>
  </div>
</x-admin-layout>
