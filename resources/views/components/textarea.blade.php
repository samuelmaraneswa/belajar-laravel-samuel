@props([
  'label' => null,
  'name',
  'rows' => 4,
  'value' => '',
  'placeholder' => '',
  'unstyled' => false
])

<div class="mb-4">
  @if ($label)
    <label class="block mb-1 text-gray-600">
      {{ $label }}
    </label>
  @endif

  <textarea
    name="{{ $name }}"
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    {{ $unstyled
      ? $attributes
      : $attributes->merge([
          'class' =>
            'w-full border rounded px-3 py-2 focus:outline-none focus:ring ' .
            ($errors->has($name) ? 'border-red-500 focus:ring-red-200' : 'border-gray-300')
        ])
    }}
  >{{ old($name, $value) }}</textarea>

  @error($name)
    <p class="text-sm text-red-600 mt-1">
      {{ $message }}
    </p>
  @enderror
</div>
