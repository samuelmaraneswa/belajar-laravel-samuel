<x-admin-layout>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">

    <x-admin.stat-card title="Workouts" value="{{ $totalWorkouts }}" icon="dumbbell" color="indigo" href="/admin/workouts" />

    <x-admin.stat-card title="Programs" value="{{ $totalPrograms }}" icon="clipboard-list" color="blue" href="/admin/programs" />
    
    <x-admin.stat-card title="Articles" value="{{ $totalArticles }}" icon="newspaper" color="blue" href="/admin/articles" />

    <x-admin.stat-card title="Users" value="{{ $totalUsers }}" icon="users" color="green" href="/admin/users" />

    <x-admin.stat-card title="Meals" value="{{ $totalMeals }}" icon="utensils" color="yellow" href="/admin/meals" />

    <x-admin.stat-card title="Foods" value="{{ $totalFoods }}" icon="carrot" color="red" href="/admin/foods" />

    <x-admin.stat-card title="Blog Posts" value="{{ $totalPosts }}" icon="pen" color="indigo" href="/admin/blog-posts" />

  </div>
</x-admin-layout>