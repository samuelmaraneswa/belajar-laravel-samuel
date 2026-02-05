@props([
  'label' => null,
  'name',
  'options' => [],
  'placeholder' => null,
  'selected' => null,
  'unstyled' => false
])

<div class="mb-4">
  @if($label)
    <label class="block text-sm mb-1 text-gray-600">
      {{ $label }}
    </label>
  @endif

  <select
  name="{{ $name }}"
  {{ $unstyled
    ? $attributes
    : $attributes->merge([
        'class' =>
          'w-full border rounded px-3 py-2 text-sm md:text-base h-10 md:h-11 leading-tight focus:outline-none focus:ring ' .
          ($errors->has($name) ? 'border-red-500 focus:ring-red-200' : 'border-gray-300')
      ])
  }}
>
    @if ($placeholder)
      <option value="">{{ $placeholder }}</option>
    @endif

    @foreach ($options as $key => $text)
      <option value="{{ $key }}" {{ old($name, $selected) == $key ? 'selected' : '' }}>
        {{ $text }}
      </option>
    @endforeach
  </select>

  @error($name)
    <p class="text-sm text-red-600 mt-1">
      {{ $message }}
    </p>
  @enderror
</div>
