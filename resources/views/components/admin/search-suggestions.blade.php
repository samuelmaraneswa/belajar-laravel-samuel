@props(['id' => 'suggestions'])

<div id="{{$id}}" {{$attributes->merge([
  'class' => 'absolute left-0 right-0 top-full bg-white border rounded shadow hidden z-30'
])}}>
  {{$slot}}
</div>