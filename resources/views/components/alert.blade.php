@props([
  'type' => 'success', // success | error | info
])

@php
  $styles = [
    'success' => 'bg-green-100 text-green-700',
    'error' => 'bg-red-100 text-red-700',
    'info' => 'bg-blue-100 text-blue-700'
  ]
@endphp

@if (session($type))
  <div class="mb-4 rounded-lg px-4 py-2 {{$styles[$type]}}">
    {{session($type)}}
  </div>
@endif