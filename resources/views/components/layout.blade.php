<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{$title ?? 'Workout App'}}</title>

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <x-header />

  <div {{ $attributes->merge(['class' => 'content']) }}>
    {{$slot}}
  </div>

  <x-footer />

  {{-- SweetAlert (ADMIN ONLY) --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>