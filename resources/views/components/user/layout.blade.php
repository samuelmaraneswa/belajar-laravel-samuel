@props(['title' => 'User Dashboard'])

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{$title}}</title>

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="">
  {{-- header --}}
  <x-user.header />

  {{-- sidebar --}}
  <x-user.sidebar />

  {{-- overlay mobile --}}
  <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-30 hidden md:hidden"></div>

  <main {{$attributes->merge(['class' => 'md:ml-64 p-5'])}}>
    {{$slot}}
  </main>

  {{-- SweetAlert (ADMIN ONLY) --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>