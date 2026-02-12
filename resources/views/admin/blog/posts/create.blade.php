<x-admin-layout>
  <div class="max-w-4xl mx-auto bg-white rounded-xl p-8">

    <x-admin.page-title title="Create Blog Post" />

    <x-hr />

    <x-form
      action="{{ route('admin.blog.posts.store') }}"
      enctype="multipart/form-data"
      class="space-y-6"
    >
      @include('admin.blog.posts._form')

      <div class="flex justify-end">
        <x-button
          type="submit"
          class="bg-indigo-600 text-white hover:bg-indigo-700 hover:text-white/90"
        >
          Save
        </x-button>
      </div>

    </x-form>

  </div>
</x-admin-layout>
