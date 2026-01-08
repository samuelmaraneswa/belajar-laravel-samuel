@props(['title', 'value' => '-', 'icon' => null, 'color' => 'indigo', 'href' => null])

@php
  $colors = [
    'indigo' => 'bg-indigo-100 text-indigo-600',
    'green' => 'bg-green-100 text-green-600',
    'red' => 'bg-red-100 text-red-600',
    'yellow' => 'bg-yellow-100 text-red-600',
    'blue' => 'bg-blue-100 text-blue-600'
  ];
@endphp

<a href="{{$href ?? '#'}}" class="bg-white rounded-lg p-5 shadow-sm flex items-start gap-4 hover:shadow-md hover:bg-gray-50 transition">
  @if ($icon)
    <div class="w-11 h-11 rounded-lg flex items-center justify-center {{ $colors[$color] }}">
      <i class="fa-solid fa-{{ $icon }} text-lg"></i>
    </div>
  @endif

  <div class="flex flex-col">
    <div class="text-lg text-gray-700">
      {{ $title }}
    </div>

    <div class="text-base text-gray-700">
      <span class="text-gray-500">Total:</span>
      <span class="font-semibold text-gray-500">{{ $value }}</span>
    </div>
  </div>
</a>