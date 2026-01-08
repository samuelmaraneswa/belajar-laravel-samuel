<aside id="adminSidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r transform -translate-x-full md:translate-x-0 transition-transform duration-200">
  <div class="h-14 px-6 flex items-center font-semibold border-b shadow-sm">
    Admin Menu
  </div>

  <nav class="p-4 space-y-1">
    {{-- <a href="/admin" class="block px-3 py-2 rounded hover:bg-gray-100">
      Dashboard
    </a> --}}
    <x-admin.nav-link href="/admin" :active="request()->is('admin')">
      Dashboard
    </x-admin.nav-link>
    
    <x-admin.nav-link href="/users">
      Users
    </x-admin.nav-link>
    
    <x-admin.nav-link href="/admin/workouts"  :active="request()->is('admin/workouts*')">
      Workouts
    </x-admin.nav-link>
  </nav>
</aside>