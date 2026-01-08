@props(['href', 'active' => false])

<a href="{{ $href }}"
  {{ $attributes->merge([ 'class' => 'block md:inline-flex w-full md:w-auto items-center justify-start md:justify-center

      px-2 py-1.5 md:px-4 md:py-2   /* ⬅️ mobile lebih kecil */
      text-sm md:text-base        /* ⬅️ mobile lebih kecil */

      font-medium
      rounded-md md:rounded-lg
      transition
      ' . (
        $active
          ? 'text-gray-800 bg-gray-100'
          : 'text-gray-200 md:text-gray-700
             hover:bg-gray-800 md:hover:bg-gray-100
             hover:text-white md:hover:text-gray-900'
      )
  ]) }}
>
  {{ $slot }}
</a>
