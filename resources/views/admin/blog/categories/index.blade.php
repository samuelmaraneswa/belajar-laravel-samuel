<x-admin-layout>
  <div data-page="blog-category">

    <div class="">

      {{-- HEADER --}}
      <div class="flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">Blog Categories</h1>

        <x-action-button
          id="btn-create-blog-category"
          class="cursor-pointer
                px-3.5! py-2.5! text-sm
                sm:px-5 sm:py-3 sm:text-base">
          <span class="sm:hidden">+ Add</span>
          <span class="hidden sm:inline">+ Add Category</span>
        </x-action-button>
      </div>

      {{-- CATEGORY TABLE --}}
      <div class="mt-4 overflow-x-auto border border-gray-500 rounded-lg">
        <table class="min-w-max w-full border-collapse">
          <thead class="bg-indigo-500 text-white">
            <tr>
              <th class="px-4 py-3 text-left text-base font-semibold whitespace-nowrap">Name</th>
              <th class="px-4 py-3 text-left text-base font-semibold whitespace-nowrap">Description</th>
              <th class="px-4 py-3 text-cnter text-base font-semibold whitespace-nowrap w-32">Action</th>
            </tr>
          </thead>

          <tbody id="blog-category-table-body">
            @forelse ($categories as $category)
              @include('admin.blog.categories._row', ['category' => $category])
            @empty
              <tr id="blog-empty-category">
                <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                  Belum ada blog category.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>

    {{-- CREATE CATEGORY MODAL --}}
    <div
      id="blog-category-modal"
      class="fixed inset-0 z-50 p-6 sm:p-0 hidden items-center justify-center
            bg-black/50 backdrop-blur-sm
            transition-opacity duration-200">
      <div
        id="blog-category-modal-content"
        class="bg-white rounded-xl w-full max-w-md p-6
              transform transition-all duration-200
              scale-95 opacity-0"
      >
        <h2 id="blog-category-modal-title" class="text-xl font-bold mb-4">
          Add Blog Category
        </h2>

        <x-form
          action="{{ route('admin.blog.categories.store') }}"
          method="POST"
          id="blog-category-form"
          data-mode="create"
        >

          {{-- ID untuk EDIT --}}
          <input type="hidden" name="blog-id" id="blog-category-id">

          <x-input
            label="Name"
            name="name"
            placeholder="Calisthenics"
            autocomplete="off"
          />

          <x-textarea
            label="Description"
            name="description"
            rows="3"
            placeholder="Journey belajar calisthenics"
          />

          <x-checkbox
            name="is_active"
            label="Active"
            :checked="true"
          />

          <div class="flex justify-end gap-2 pt-4">
            <x-button
              id="blog-btn-close-modal"
            >
              Cancel
            </x-button>

            <x-button
              type="submit"
              class="bg-indigo-600 text-white hover:bg-indigo-700 hover:text-white"
            >
              Save
            </x-button>
          </div>
        </x-form>
      </div>
    </div>

  </div>
</x-admin-layout>
