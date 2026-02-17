<a
  {{ $attributes->merge([
    'class' => '
      inline-flex items-center gap-2
      px-5 py-2.5 sm:px-6 text-sm sm:text-base sm:py-3 rounded-xl
      bg-indigo-600 text-white sm:font-semibold
      hover:bg-indigo-700 transition cursor-pointer
    '
  ]) }}
>
  {{ $slot }}
</a>
