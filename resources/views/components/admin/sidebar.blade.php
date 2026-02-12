<aside
  id="adminSidebar"
  class="fixed left-0 top-14 z-40 w-64 bg-white border-r
         transform -translate-x-full md:translate-x-0
         transition-transform duration-200
         h-[calc(100vh-3.5rem)]"
>
  <nav class="h-full p-4 space-y-1 overflow-y-auto">
    <x-user.nav-link href="{{ url('/') }}">
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
    <div>
      <div class="flex items-center justify-between rounded
        {{ request()->routeIs('admin.workout.*') ? 'bg-gray-100' : 'hover:bg-gray-100' }}">
        <x-admin.nav-link
          href="{{ route('admin.workout.index') }}"
          :active="false"
          class="flex-1"
        >
          Workouts
        </x-admin.nav-link>

        <button type="button" data-submenu-toggle="workouts" class="ml-2 p-2">
          <i data-submenu-icon class="fa-solid fa-chevron-down text-xs transition-transform"></i>
        </button>
      </div>

      <div data-submenu="workouts" class="ml-4 mt-1 space-y-1 border-l pl-3 hidden">
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

    {{-- BLOG --}}
    <div>
      <div class="flex items-center justify-between rounded
        {{ request()->routeIs('admin.blog.*') ? 'bg-gray-100' : 'hover:bg-gray-100' }}">
        <x-admin.nav-link
          href="{{ route('admin.blog.index') }}"
          :active="false"
          class="flex-1"
        >
          Blog
        </x-admin.nav-link>

        <button type="button" data-submenu-toggle="blog" class="ml-2 p-2">
          <i data-submenu-icon class="fa-solid fa-chevron-down text-xs transition-transform"></i>
        </button>
      </div>

      <div data-submenu="blog" class="ml-4 mt-1 space-y-1 border-l pl-3 hidden">
        <x-admin.nav-link
          href="{{ route('admin.blog.categories.index') }}"
          :active="request()->routeIs('admin.blog.categories.*')"
          class="text-sm"
        >
          Categories
        </x-admin.nav-link>

        <x-admin.nav-link
          href="{{ route('admin.blog.tema.index') }}"
          :active="request()->routeIs('admin.blog.tema.*')"
          class="text-sm"
        >
          Tema
        </x-admin.nav-link>

        <x-admin.nav-link
          href="{{ route('admin.blog.posts.index') }}"
          :active="request()->routeIs('admin.blog.posts.*')"
          class="text-sm"
        >
          Posts
        </x-admin.nav-link>
      </div>
    </div>
  </nav>
</aside>
