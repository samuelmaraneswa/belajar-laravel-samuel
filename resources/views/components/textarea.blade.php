@props(['label' => null, 'name', 'rows' => 4, 'value' => '', 'placeholder' => '', 'unstyled' => false])

<div class="mb-4">
  @if ($label)
    <label class="block mb-1 text-gray-600">
      {{$label}}
    </label>
  @endif

  <textarea name="{{$name}}" rows="{{$rows}}" placeholder="{{$placeholder}}" {{$unstyled ? $attributes : $attributes->merge(['class' => 'w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring'])}}>
    {{old($name, $value)}}
  </textarea>
</div>