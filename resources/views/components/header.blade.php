<header class="bg-white shadow">

  {{-- BAR ATAS --}}
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

    {{-- HAMBURGER (mobile kiri) --}}
    <button
      id="mobileMenuBtn"
      class="md:hidden order-1 text-xl relative z-50
            w-10 h-9 flex items-center justify-center">
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
        @php
          $dashboardUrl = auth()->user()->role === 'admin'
            ? route('admin.dashboard')
            : route('user.dashboard');
        @endphp

        <div class="relative">
          {{-- avatar --}}
          <x-button id="userMenuBtn" class="px-2! py-1!">
            <img src="{{ auth()->user()->avatar
              ? asset('storage/'.auth()->user()->avatar)
              : asset('images/default-avatar.jpg') }}"
              class="w-7 h-7 sm:w-8 sm:h-8 rounded-full object-cover"
              alt="Avatar">
          </x-button>

          {{-- dropdown --}}
          <div id="userMenu"
              class="hidden cursor-pointer absolute z-30 right-0 mt-0.5 w-44 bg-white border rounded-lg shadow overflow-hidden">
            
            <a href="{{ $dashboardUrl }}"
              class="block px-4 py-2 text-sm hover:bg-gray-100">
              Dashboard
            </a>

            <a href="/profile"
              class="block px-4 py-2 text-sm hover:bg-gray-100">
              Profile
            </a>

            <x-form action="{{ route('logout') }}">
              <button type="submit"
                class="w-full cursor-pointer text-left px-4 py-2 text-sm hover:bg-gray-100">
                Logout
              </button>
            </x-form>
          </div>
        </div>
        @endauth

    </div>

  </div>

</header>

<div
  id="mobileOverlay"
  class="fixed inset-0 bg-black/40 z-40 md:hidden
         opacity-0 transition-opacity duration-300 hidden">
</div>

<div id="mobileSidebar" class="fixed top-17.5 left-0 h-[calc(100%-72px)] w-[70%] bg-black hidden md:hidden z-40 p-6 space-y-4">
  <x-nav-link href="/" class="block">Home</x-nav-link>
  <x-nav-link href="/blogs" class="block">Blogs</x-nav-link>
  <x-nav-link href="/workouts" class="block" :active="request()->is('workouts*')">Workouts</x-nav-link>
  <x-nav-link href="/artikels" class="block" :active="request()->is('artikels*')">Artikels</x-nav-link>
  <x-nav-link href="/meals" class="block" :active="request()->is('meals*')">Meals</x-nav-link>
  <x-nav-link href="/calorie" class="block" :active="request()->is('calorie*')">Calorie</x-nav-link>
</div>