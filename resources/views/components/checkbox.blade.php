@props([
  'label' => null,
  'name',
  'checked' => false
])

<div class="flex items-center gap-2 mb-4">
  <input
    type="checkbox"
    name="{{ $name }}"
    id="{{ $name }}"
    value="1"
    {{ old($name, $checked) ? 'checked' : '' }}
    {{ $attributes->merge([
      'class' => 'rounded border-gray-300 text-indigo-600 focus:ring-indigo-500'
    ]) }}
  >

  @if ($label)
    <label for="{{ $name }}" class="text-sm text-gray-700">
      {{ $label }}
    </label>
  @endif
</div>
