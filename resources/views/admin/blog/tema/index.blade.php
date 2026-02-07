<x-admin-layout>
  <div class="">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
      <h1 class="text-xl md:text-2xl font-bold">Blog Tema</h1>

      <x-action-button
        id="btn-create-tema"
        class="cursor-pointer
              px-3.5! py-2.5! text-sm
              sm:px-5 sm:py-3 sm:text-base">
        <span class="sm:hidden">+ Add</span>
        <span class="hidden sm:inline">+ Add Tema</span>
      </x-action-button>
    </div>

    {{-- TEMA TABLE --}}
    <div class="mt-4 overflow-x-auto border border-gray-500 rounded-lg">
      <table class="min-w-max w-full border-collapse">
        <thead class="bg-indigo-500 text-white">
          <tr>
            <th class="px-4 py-3 text-left text-base font-semibold whitespace-nowrap">
              Category
            </th>
            <th class="px-4 py-3 text-left text-base font-semibold whitespace-nowrap">
              Name
            </th>
            <th class="px-4 py-3 text-left text-base font-semibold whitespace-nowrap">
              Description
            </th>
            <th class="px-4 py-3 text-center text-base font-semibold whitespace-nowrap w-32">
              Action
            </th>
          </tr>
        </thead>

        <tbody id="tema-table-body">
          @forelse ($temas as $tema)
            @include('admin.blog.tema._row', ['tema' => $tema])
          @empty
            <tr id="empty-tema">
              <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                Belum ada blog tema.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>

  {{-- CREATE / EDIT TEMA MODAL --}}
  <div
    id="tema-modal"
    class="fixed inset-0 z-50 p-6 sm:p-0 hidden items-center justify-center
          bg-black/50 backdrop-blur-sm
          transition-opacity duration-200"
  >
    <div
      id="tema-modal-content"
      class="bg-white rounded-xl w-full max-w-md p-6
            transform transition-all duration-200
            scale-95 opacity-0"
    >
      <h2 id="tema-modal-title" class="text-xl font-bold mb-4">
        Add Blog Tema
      </h2>

      <x-form
        action="{{ route('admin.blog.tema.store') }}"
        method="POST"
        id="tema-form"
        data-mode="create"
      >

        {{-- ID untuk EDIT --}}
        <input type="hidden" name="id" id="tema-id">

        {{-- CATEGORY --}}
        <div class="mb-4">
          <label class="block text-sm mb-1 text-gray-600">Category</label>
          <select
            name="category_id"
            class="w-full border rounded px-3 py-2 border-gray-300 focus:outline-none focus:ring"
          >
            <option value="">-- Pilih Category --</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>

        <x-input
          label="Name"
          name="name"
          placeholder="Handstand"
          autocomplete="off"
        />

        <x-textarea
          label="Description"
          name="description"
          rows="3"
          placeholder="Journey handstand"
        />

        <x-checkbox
          name="is_active"
          label="Active"
          :checked="true"
        />

        <div class="flex justify-end gap-2 pt-4">
          <x-button id="btn-close-tema-modal">
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

</x-admin-layout>
