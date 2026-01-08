@props(['title'])

<h1 {{$attributes->merge(['class' => 'text-2xl font-bold text-gray-800'])}}>
  {{$title}}
</h1>