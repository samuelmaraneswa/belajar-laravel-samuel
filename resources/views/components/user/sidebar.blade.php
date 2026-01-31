<aside id="userSidebar"
  class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r
         transform -translate-x-full md:translate-x-0
         transition-transform duration-200">

  {{-- header sidebar --}}
  <div class="h-14 px-6 flex items-center font-semibold border-b shadow-sm">
    User Menu
  </div>

  <nav class="p-4 space-y-1">
    
    <x-user.nav-link href="{{ url('/') }}" target="_blank">
      <i class="fa-solid fa-globe w-4"></i>
      <span>View Website</span>
    </x-user.nav-link>

    {{-- Dashboard --}}
    <x-user.nav-link href="/dashboard" :active="request()->is('dashboard')">
      <i class="fa-solid fa-house w-4"></i>
      <span>Dashboard</span>
    </x-user.nav-link>

    {{-- My Programs --}}
    <x-user.nav-link href="/programs" :active="request()->is('programs')">
      <i class="fa-regular fa-calendar w-4"></i>
      <span>My Programs</span>
    </x-user.nav-link>

    {{-- Generate --}}
    <x-user.nav-link href="/programs/generate" :active="request()->is('programs/generate')">
      <i class="fa-solid fa-plus w-4"></i>
      <span>Generate Program</span>
    </x-user.nav-link>

    {{-- Profile --}}
    <x-user.nav-link href="/profile" :active="request()->is('profile')">
      <i class="fa-regular fa-user w-4"></i>
      <span>Profile</span>
    </x-user.nav-link>

    {{-- Divider --}}
    <div class="my-3 border-t"></div>

    {{-- Logout --}}
    <x-form action="{{ route('logout') }}">
      <x-button
        type="submit"
        class="w-full justify-start bg-transparent hover:bg-gray-100 text-gray-700"
      >
        <i class="fa-solid fa-right-from-bracket w-4"></i>
        <span>Logout</span>
      </x-button>
    </x-form>

  </nav>
</aside>
