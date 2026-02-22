<x-admin-layout>
  <div data-page="meals-category">
    <div>

      {{-- HEADER --}}
      <div class="flex items-center justify-between">
        <h1 class="text-xl md:text-2xl font-bold">Meal Categories</h1>

        <x-action-button
          id="btn-create-meals-category"
          class="cursor-pointer px-3.5! py-2.5! text-sm sm:px-5 sm:py-3 sm:text-base">
          <span class="sm:hidden">+ Add</span>
          <span class="hidden sm:inline">+ Add Category</span>
        </x-action-button>
      </div>

      {{-- TABLE --}}
      <div class="mt-4 overflow-x-auto border border-gray-500 rounded-lg">
        <table class="min-w-max w-full border-collapse">
          <thead class="bg-indigo-500 text-white">
            <tr>
              <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Name</th>
              <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Description</th>
              <th class="px-4 py-3 text-center font-semibold w-32">Action</th>
            </tr>
          </thead>

          <tbody id="meals-category-table-body">
            @forelse ($categories as $category)
              @include('admin.meals.categories._row', ['category' => $category])
            @empty
              <tr id="meals-empty-category">
                <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                  Belum ada meal category.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>

    {{-- MODAL --}}
    <div data-page="meal-category">
      <div
        id="meals-category-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-6">
        <div
          id="meals-category-modal-content"
          class="bg-white rounded-xl w-full max-w-md p-6 scale-95 opacity-0 transition"
        >
          <h2 id="meals-category-modal-title" class="text-xl font-bold mb-4">
            Add Meal Category
          </h2>

          <x-form
            action="{{ route('admin.meal.categories.store') }}"
            method="POST"
            id="meals-category-form"
            data-mode="create"
          >

            <input type="hidden" name="meals-id" id="meals-category-id">

            <x-input
              label="Name"
              name="name"
              placeholder="High Protein"
              autocomplete="off"
            />

            <x-textarea
              label="Description"
              name="description"
              rows="3"
              placeholder="Kategori makanan tinggi protein"
            />

            <div class="flex justify-end gap-2 pt-4">
              <x-button id="meals-btn-close-modal">Cancel</x-button>

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
  </div>

</x-admin-layout>