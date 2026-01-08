@props([
  'type' => 'button'
])

<button
  type="{{ $type }}"
  {{ $attributes->merge([
    'class' => '
      inline-flex items-center justify-center
      px-4 py-2
      text-sm font-medium
      rounded-lg
      text-gray-700
      bg-gray-100
      hover:bg-gray-200
      hover:text-gray-900
      transition
      cursor-pointer
      focus:outline-none
      focus:ring-2 focus:ring-indigo-500/40
      disabled:opacity-50
      disabled:cursor-not-allowed
    '
  ]) }}
>
  {{ $slot }}
</button>
