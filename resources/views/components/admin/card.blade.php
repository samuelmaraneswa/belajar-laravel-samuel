<div {{$attributes->merge([
  'class' => 'bg-white rounded-xl overflow-hidden flex flex-col h-full transition hover:shadow-lg'
])}}>
  {{$slot}}
</div>