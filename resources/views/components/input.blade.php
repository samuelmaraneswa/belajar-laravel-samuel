@props([
  'label' => null,
  'name',
  'type' => 'text',
  'value' => '',
  'placeholder' => '',
  'unstyled' => false,
  'inline' => false
])

@if ($inline)
  <input 
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes }}
  >
@else
  <div class="mb-4">
    @if ($label)
      <label class="block text-sm mb-1 text-gray-600">
        {{ $label }}
      </label>
    @endif

    <input 
      type="{{ $type }}"
      name="{{ $name }}"
      value="{{ old($name, $value) }}"
      placeholder="{{ $placeholder }}"
      {{ $unstyled
        ? $attributes
        : $attributes->merge([
            'class' =>
              'w-full border rounded px-3 py-2 focus:outline-none focus:ring ' .
              ($errors->has($name) ? 'border-red-500 focus:ring-red-200' : 'border-gray-300')
          ])
      }}
    >

    @error($name)
      <p class="text-sm text-red-600 mt-1">
        {{ $message }}
      </p>
    @enderror
  </div>
@endif
