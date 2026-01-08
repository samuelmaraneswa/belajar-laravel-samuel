@props(['action', 'method' => 'POST'])

<form action="{{$action}}" method="{{strtoupper($method)}}" {{$attributes}}>
  @if (strtoupper($method) !== 'GET')
    @csrf  
  @endif
  {{$slot}}
</form>