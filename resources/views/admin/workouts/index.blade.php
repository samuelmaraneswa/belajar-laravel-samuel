<x-admin-layout>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">

    {{-- ALL WORKOUTS --}}
    <x-admin.stat-card
      title="All Workouts"
      :value="$totalWorkouts"
      icon="dumbbell"
      color="indigo"
      href="{{ route('admin.workout.list') }}"
    />

    @php
      $contextStyles = [
        'gym-workout' => [
          'icon' => 'dumbbell',
          'color' => 'green',
        ],
        'home-workout' => [
          'icon' => 'house',
          'color' => 'yellow',
        ],
        'calisthenics' => [
          'icon' => 'person-running',
          'color' => 'red',
        ],
        'gymnastic' => [
          'icon' => 'person-circle-check',
          'color' => 'red',
        ],
        'cardiovaskular' => [
          'icon' => 'heart-pulse',
          'color' => 'red',
        ],
        'mobility' => [
          'icon' => 'arrows-rotate',
          'color' => 'red',
        ],
      ];
    @endphp

    {{-- CONTEXT-BASED WORKOUTS --}}
    @foreach ($contexts as $context)
      @php
        $style = $contextStyles[$context->slug] ?? [
          'icon' => 'dumbbell',
          'color' => 'indigo',
        ];
      @endphp

      <x-admin.stat-card
        :title="$context->name"
        :value="$context->workouts_count"
        :icon="$style['icon']"
        :color="$style['color']"
        href="{{ route('admin.workout.list', ['context' => $context->slug]) }}"
      />
    @endforeach

  </div>
</x-admin-layout>
