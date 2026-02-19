<x-admin-layout>
  <div class="max-w-5xl mx-auto bg-white rounded-xl p-8">

    <x-admin.page-title title="Edit Food" />

    <x-hr />

    <x-form
      action="{{ route('admin.foods.update', $food) }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-6"
    >
      @include('admin.foods._form')

      <div class="flex justify-end">
        <x-button
          type="submit"
          class="bg-indigo-600 text-white hover:bg-indigo-700 hover:text-white">
          Update
        </x-button>
      </div>

    </x-form>

  </div>
</x-admin-layout>
