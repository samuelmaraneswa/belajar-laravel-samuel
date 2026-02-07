<a
  {{ $attributes->merge([
    'class' => '
      inline-flex items-center gap-2
      px-6 py-3 rounded-xl
      bg-indigo-600 text-white font-semibold
      hover:bg-indigo-700 transition cursor-pointer
    '
  ]) }}
>
  {{ $slot }}
</a>
