@props(['href', 'active' => false])

<a href="{{$href}}" {{$attributes->merge(['class' => 'block px-3 py-2 rounded ' . ($active ? 'bg-gray-100 font-semibold text-gray-600' : 'hover:bg-gray-100 text-gray-700')])}}>
  {{$slot}}
</a>