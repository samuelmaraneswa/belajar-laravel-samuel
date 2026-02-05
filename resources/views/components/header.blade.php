<header class="bg-white shadow">

  {{-- BAR ATAS --}}
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

    {{-- HAMBURGER (mobile kiri) --}}
    <button id="mobileMenuBtn" class="md:hidden order-1 text-xl relative z-50">
      <i id="menuIcon" class="fa-solid fa-bars"></i>
    </button>

    {{-- LOGO (mobile tengah, desktop kiri) --}}
    <div class="order-2 md:order-1">
      <x-brand />
    </div>

    {{-- MENU (desktop saja, tengah) --}}
    <nav class="hidden md:flex space-x-6 md:order-2">
      <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
      <x-nav-link href="/blogs" :active="request()->is('blogs*')">Blogs</x-nav-link>
      <x-nav-link href="/workouts" :active="request()->is('workouts*')">Workouts</x-nav-link>
      <x-nav-link href="/artikels" :active="request()->is('artikels*')">Artikels</x-nav-link>
      <x-nav-link href="/meals" :active="request()->is('meals*')">Meals</x-nav-link>
      <x-nav-link href="/calorie" :active="request()->is('calorie*')">Calorie</x-nav-link>
    </nav>

    {{-- USER (selalu kanan) --}}
    <div class="order-3 md:order-3">
      @guest
        <x-nav-link href="{{ route('login') }}" :active="request()->is('login*')" class="text-gray-800">Login</x-nav-link>
      @endguest

      @auth
        <x-form action="{{route('logout')}}" class="inline">
          <x-button type="submit">Logout</x-button>
        </x-form>
      @endauth
    </div>

  </div>

</header>
<div id="mobileOverlay" class="hidden fixed inset-0 bg-black/40 md:hidden"></div>

<div id="mobileSidebar" class="fixed top-17.5 left-0 h-[calc(100%-72px)] w-[70%] bg-black hidden md:hidden z-40 p-6 space-y-4">
  <x-nav-link href="/" class="block">Home</x-nav-link>
  <x-nav-link href="/blogs" class="block">Blogs</x-nav-link>
  <x-nav-link href="/workouts" class="block" :active="request()->is('workouts*')">Workouts</x-nav-link>
  <x-nav-link href="/artikels" class="block" :active="request()->is('artikels*')">Artikels</x-nav-link>
  <x-nav-link href="/meals" class="block" :active="request()->is('meals*')">Meals</x-nav-link>
  <x-nav-link href="/calorie" class="block" :active="request()->is('calorie*')">Calorie</x-nav-link>
</div>