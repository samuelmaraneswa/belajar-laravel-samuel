<header class="bg-white shadow-sm sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between border-b">

    {{-- kiri --}}
    <div class="flex items-center gap-1 sm:gap-2">
      <x-button id="userSidebarToggle" class="md:hidden p-0 w-9 h-9">
        <i class="fa-solid fa-bars"></i>
      </x-button>

      <div class="font-semibold text-gray-800 truncate">
        <span class="hidden sm:inline">My Dashboard</span>
        <span class="sm:hidden">Dashboard</span>
      </div>
    </div>

    {{-- kanan --}}
    <div class="flex items-center gap-2 relative">
      {{-- notification --}}
      <x-button class="w-9 h-9 sm:w-10 sm:h-10 p-0">
        <i class="fa-regular fa-bell text-base sm:text-lg"></i>
      </x-button>
      
      {{-- message --}}
      <x-button class="w-9 h-9 sm:w-10 sm:h-10 p-0">
        <i class="fa-regular fa-envelope text-base sm:text-lg"></i>
      </x-button>

      {{-- avatar + dropdown --}}
      <div class="relative">
        <x-button id="userMenuBtn" class="px-2! py-1!">
          <img
            src="{{ auth()->user()->avatar
              ? asset('storage/'.auth()->user()->avatar)
              : asset('images/default-avatar.jpg') }}"
            class="w-7 h-7 sm:w-8 sm:h-8 rounded-full object-cover"
            alt="Avatar"
          > 
        </x-button>

        <div id="userMenu"
             class="hidden absolute right-0 w-40 bg-white border rounded-lg shadow overflow-hidden mt-1">
          <a href="/profile"
             class="block px-4 py-2 text-sm hover:bg-gray-100">
            Profile
          </a>

          <x-form action="{{ route('logout') }}">
            <x-button type="submit"
              class="w-full justify-start bg-transparent hover:bg-gray-100 rounded-none">
              Logout
            </x-button>
          </x-form>
        </div>
      </div>
    </div>

  </div>
</header>
