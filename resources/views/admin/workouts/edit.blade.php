{{-- resources/views/admin/workouts/edit.blade.php --}}

<x-admin-layout>
  <div class="max-w-2xl mx-auto bg-white shadow-[0_2px_8px_rgba(0,0,0,0.3)] rounded-xl p-8 font-hanken mb-10">

    <x-admin.page-title title="Edit Workout" />
    <x-hr />

    <x-form
      action="{{ route('admin.workout.update', $workout) }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-6"
    >
      @csrf
      @method('PUT')

      {{-- Form Fields --}}
      @include('admin.workouts._form', ['workout' => $workout])

      {{-- Submit --}}
      <div class="flex justify-end">
        <x-button type="submit" class="bg-indigo-600 text-white hover:bg-indigo-700 hover:text-white/90">
          Update
        </x-button>
      </div>
    </x-form>

  </div>
</x-admin-layout>
