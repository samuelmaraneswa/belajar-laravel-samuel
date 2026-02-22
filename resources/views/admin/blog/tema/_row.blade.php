<tr
  data-tema-id="{{ $tema->id }}"
  class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 transition"
>
  {{-- CATEGORY --}}
  <td class="px-4 py-3 font-medium whitespace-nowrap">
    {{ $tema->category->name ?? '-' }}
  </td>

  {{-- NAME --}}
  <td class="px-4 py-3 font-medium whitespace-nowrap">
    {{ $tema->name }}
  </td>

  {{-- DESCRIPTION --}}
  <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
    {{ Str::limit($tema->description, 60) }}
  </td>

  {{-- ACTION --}}
  <td class="px-4 py-3 text-center space-x-8">
    <button
      class="text-indigo-600 hover:text-indigo-800 blog-btn-edit-tema cursor-pointer"
      title="Edit"
      data-tema-id="{{ $tema->id }}"
      data-category="{{ $tema->category_id }}"
      data-name="{{ $tema->name }}"
      data-description="{{ $tema->description }}"
      data-active="{{ $tema->is_active ? 1 : 0 }}"
    >
      <i class="fa-solid fa-pen-to-square"></i>
    </button>

    <button
      class="text-red-600 hover:text-red-800 blog-btn-delete-tema cursor-pointer"
      title="Delete"
      data-tema-id="{{ $tema->id }}"
    >
      <i class="fa-solid fa-trash"></i>
    </button>
  </td>
</tr>
