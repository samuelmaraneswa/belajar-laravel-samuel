@props(['label' => null, 'name', 'items' => [], 'selected' => []])

<div class="mb-4">
  @if ($label)
    <label class="block text-gray-700 mb-2 font-semibold">
      {{ $label }}
    </label>
  @endif

  @foreach ($items as $id => $text)
    <label class="inline-flex items-center mr-4 mb-2">
      <input
        type="checkbox"
        name="{{ $name }}"
        value="{{ $id }}"
        @checked(in_array($id, old(str_replace('[]','',$name), $selected)))
      >
      <span class="ml-2">{{ $text }}</span>
    </label>
  @endforeach
</div>
