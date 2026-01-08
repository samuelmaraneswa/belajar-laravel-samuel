@props(['label' => null, 'name', 'options' => [], 'placeholder' => null, 'selected' => null, 'unstyled' => false])

<div class="mb-4">
  @if($label)
    <label class="block text-sm mb-1 text-gray-600">
      {{$label}}
    </label>
  @endif

  <select name="{{$name}}" {{$unstyled ? $attributes : $attributes->merge([
    'class' => 'w-full border rounded px-3 py-2 focus:outline-none focus:ring'
  ])}}>

    @if ($placeholder)
      <option value="">{{$placeholder}}</option>
    @endif

    @foreach ($options as $key => $text)
      <option value="{{$key}}" {{old($name, $selected) == $key ? 'selected' : ''}}>
        {{$text}}
      </option>
    @endforeach
  </select>
</div>