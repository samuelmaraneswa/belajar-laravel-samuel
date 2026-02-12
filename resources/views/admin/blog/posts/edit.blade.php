<x-admin-layout>

  <div class="max-w-4xl mx-auto bg-white rounded-xl p-8">

    <x-admin.page-title title="Edit Blog Post" />

    <x-hr />

    <x-form
      action="{{ route('admin.blog.posts.update', $post->slug) }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-6"
    >
      @method('PUT')

      @include('admin.blog.posts._form', ['post' => $post])

      <div class="flex justify-end">
        <x-button type="submit">
          Update
        </x-button>
      </div>
    </x-form>

  </div>
</x-admin-layout>

<script>
  window.editFormData = {
    category_id: @json($post->category_id),
    tema_id: @json($post->tema_id),
    progressions: @json($post->workoutDetails ?? []),
  };
</script>