<aside id="adminSidebar"
  class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r
         transform -translate-x-full md:translate-x-0 transition-transform duration-200">

  <div class="h-14 px-6 flex items-center font-semibold border-b shadow-sm">
    Admin Menu
  </div>

  <nav class="p-4 space-y-1">

     <x-user.nav-link href="{{ url('/') }}" target="_blank">
      <i class="fa-solid fa-globe w-4"></i>
      <span>View Website</span>
    </x-user.nav-link>

    <x-admin.nav-link href="/admin" :active="request()->is('admin')">
      Dashboard
    </x-admin.nav-link>

    <x-admin.nav-link href="/users">
      Users
    </x-admin.nav-link>

    {{-- WORKOUTS --}}
    <div class="">

      <div class="flex items-center justify-between rounded {{ request()->routeIs('admin.workout.*') ? 'bg-gray-100' : 'hover:bg-gray-100' }}">
        <x-admin.nav-link
          href="{{ route('admin.workout.index') }}"
          :active="false"
          class="flex-1"
        >
          Workouts
        </x-admin.nav-link>

        <button
          type="button"
          data-submenu-toggle="workouts"
          class="ml-2 p-2 cursor-pointer"
        >
          <i data-submenu-icon class="fa-solid fa-chevron-down text-xs transition-transform"></i>
        </button>
      </div>

      {{-- SUBMENU --}}
      <div
        data-submenu="workouts"
        class="ml-4 mt-1 space-y-1 border-l pl-3 hidden"
      >
        <x-admin.nav-link
          href="{{ route('admin.workout.list') }}"
          :active="request()->fullUrlIs(route('admin.workout.list'))"
          class="text-sm"
        >
          All Workouts
        </x-admin.nav-link>

        @foreach ($workoutContexts as $context)
          <x-admin.nav-link
            href="{{ route('admin.workout.list', ['context' => $context->slug]) }}"
            :active="request()->get('context') === $context->slug"
            class="text-sm"
          >
            {{ $context->name }}
          </x-admin.nav-link>
        @endforeach
      </div>

    </div>

  </nav>
</aside>
