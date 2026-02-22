<tr
  data-goal-id="{{ $goal->id }}"
  class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 transition"
>
  {{-- NAME --}}
  <td class="px-4 py-3 font-medium whitespace-nowrap">
    {{ $goal->name }}
  </td>

  {{-- DESCRIPTION --}}
  <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
    {{ \Illuminate\Support\Str::limit($goal->description, 60) }}
  </td>

  {{-- ACTION --}}
  <td class="px-4 py-3 text-center space-x-8">
    <button
      class="text-indigo-600 hover:text-indigo-800 meal-btn-edit-goal cursor-pointer"
      title="Edit"
      data-goal-id="{{ $goal->id }}"
      data-name="{{ $goal->name }}"
      data-description="{{ $goal->description }}"
    >
      <i class="fa-solid fa-pen-to-square"></i>
    </button>

    <button
      class="text-red-600 hover:text-red-800 meal-btn-delete-goal cursor-pointer"
      title="Delete"
      data-goal-id="{{ $goal->id }}"
    >
      <i class="fa-solid fa-trash"></i>
    </button>
  </td>
</tr>