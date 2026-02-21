<tr
  data-id="{{ $category->id }}"
  class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 transition"
>
  <td class="px-4 py-3 font-medium whitespace-nowrap">
    {{ $category->name }}
  </td>

  <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
    {{ Str::limit($category->description, 60) }}
  </td>

  <td class="px-4 py-3 text-center space-x-8">
    <button
      class="text-indigo-600 hover:text-indigo-800 btn-edit cursor-pointer"
      data-id="{{ $category->id }}"
      data-name="{{ $category->name }}"
      data-description="{{ $category->description }}"
    >
      <i class="fa-solid fa-pen-to-square"></i>
    </button>

    <button
      class="text-red-600 hover:text-red-800 btn-delete cursor-pointer"
      data-id="{{ $category->id }}"
    >
      <i class="fa-solid fa-trash"></i>
    </button>
  </td>
</tr>