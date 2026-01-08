@props(['label' => null, 'name', 'items' => [], 'checked' => []])

<div class="mb-4">
  @if ($label)
    <label class="block text-gray-700 mb-2 font-semibold">
      {{$label}}
    </label>
  @endif

  @foreach ($items as $id => $text)
    <label class="inline-flex items-center mr-4 mb-2">
      <input type="checkbox" name="{{$name}}[]" value="{{$id}}" {{in_array($id, old($name, $checked)) ? 'checked' : ''}}>
      <span class="ml-2">{{$text}}</span>
    </label>
  @endforeach
</div>