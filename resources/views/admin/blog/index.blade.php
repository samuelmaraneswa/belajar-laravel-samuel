<x-admin-layout>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">

    {{-- ALL POSTS --}}
    <x-admin.stat-card
      title="All Posts"
      :value="$totalPosts"
      icon="newspaper"
      color="indigo"
      href="{{ route('admin.blog.posts.index') }}"
    />

    @php
      $categoryStyles = [
        'calisthenics' => ['icon' => 'hand-fist', 'color' => 'red'],
        'gym'          => ['icon' => 'dumbbell', 'color' => 'green'],
        'cooking'      => ['icon' => 'utensils', 'color' => 'yellow'],
        'mobility'     => ['icon' => 'arrows-rotate', 'color' => 'indigo'],
      ];
    @endphp

    @foreach ($categories as $category)
      @php
        $style = $categoryStyles[$category->slug] ?? [
          'icon' => 'folder',
          'color' => 'indigo',
        ];
      @endphp

      <x-admin.stat-card
        :title="$category->name"
        :value="$category->posts_count"
        :icon="$style['icon']"
        :color="$style['color']"
        href="{{ route('admin.blog.posts.index', ['category' => $category->slug]) }}"
      />
    @endforeach

  </div>
</x-admin-layout>
