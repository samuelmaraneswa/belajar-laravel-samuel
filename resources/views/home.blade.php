<x-layout>
  <section
    class="relative w-full bg-cover bg-center"
    style="
      min-height: calc(100vh - 71px);
      background-image: url('{{ asset('images/generate-background.jpg') }}');
    "
  >
    {{-- overlay --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-[3px]"></div>

    {{-- CONTENT --}}
    <div
      class="pt-8 sm:pt-0 relative min-h-[calc(100vh-71px)]
             flex flex-col justify-center
             px-4 sm:px-6 lg:px-8
             text-center text-white pb-16 sm:pb-0"
    >

      {{-- HERO --}}
      <div class="mb-10 sm:mb-12">
        <h1
          class="mt-4 sm:mt-0 text-2xl sm:text-3xl md:text-4xl lg:text-5xl
                 font-bold leading-tight mb-4"
        >
          Your Personalized 30-Day Workout Program
        </h1>

        <p
          class="max-w-md sm:max-w-lg mx-auto
                 text-sm sm:text-base
                 text-gray-200 mb-6"
        >
          Let me help you build your ideal body.
          Train smarter with a personalized 30-day workout plan.
        </p>

        <a
          href="{{ route('user.programs.create') }}"
          class="inline-flex items-center justify-center
                w-full sm:w-auto
                bg-green-600 px-6 sm:px-8 py-3
                rounded-lg font-semibold
                hover:bg-green-700 transition"
        >
          Generate My Workout Now
        </a>
      </div>

      {{-- FEATURES --}}
      <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
        <div class="bg-white/90 rounded-xl p-4 sm:p-6 text-gray-800 text-center">

          <!-- icon + title -->
          <div class="flex items-center justify-center gap-2 mb-2 sm:block">
            <span class="text-xl block sm:mx-auto">📅</span>
            <b class="block text-sm sm:text-base sm:mt-1">
              30 Days Structured Plan
            </b>
          </div>

          <p class="text-xs sm:text-sm text-gray-600">
            Rest days & workout days balanced automatically.
          </p>
        </div>

        <div class="bg-white/90 rounded-xl p-4 sm:p-6 text-gray-800 text-center">

          <div class="flex items-center justify-center gap-2 mb-2 sm:block">
            <span class="text-xl block sm:mx-auto">📊</span>
            <b class="block text-sm sm:text-base sm:mt-1">
              Progress Tracking
            </b>
          </div>

          <p class="text-xs sm:text-sm text-gray-600">
            Track sets, days, and full program completion.
          </p>
        </div>

        <div class="bg-white/90 rounded-xl p-4 sm:p-6 text-gray-800 text-center">

          <div class="flex items-center justify-center gap-2 mb-2 sm:block">
            <span class="text-xl block sm:mx-auto">🔊</span>
            <b class="block text-sm sm:text-base sm:mt-1">
              Guided Sets
            </b>
          </div>

          <p class="text-xs sm:text-sm text-gray-600">
            Reps counter & audio support per set.
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- WORKOUT PREVIEW --}}
  <section class="bg-gray-50 py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- HEADER --}}
      <div class="text-center mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">
          Explore Workouts
        </h2>
        <p class="text-gray-500 max-w-md mx-auto">
          Discover exercises you can use in your workout program.
        </p>
      </div>

      {{-- CARDS --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 sm:mb-10">
        @foreach ($workouts as $workout)
          <x-workout-card :workout="$workout" />
        @endforeach
      </div>

      {{-- VIEW MORE --}}
      <div class="text-center">
        <x-action-button href="{{ url('/workouts') }}" class="">
          View All Workouts <span>→</span>
        </x-action-button>
      </div>
    </div>
  </section>

  {{-- FOODS PREVIEW --}}
  <section class="bg-gray-200 py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- HEADER --}}
      <div class="text-center mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">
          Food Nutrition Database
        </h2>
        <p class="text-gray-500 max-w-md mx-auto">
          Check calories, macros, and micronutrients of your favorite foods.
        </p>
      </div>

      {{-- FOOD CARDS --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach ($foods as $food)
          <div class="bg-gray-50 border rounded-xl p-5 hover:shadow transition">
            <h3 class="font-semibold text-gray-800 mb-2">
              {{ $food->name }}
            </h3>

            <p class="text-sm text-gray-600">
              {{ $food->nutrition->calories_kcal ?? '-' }} kcal
            </p>

            <a href="{{ url('/foods') }}"
              class="text-sm text-indigo-600 hover:underline mt-3 inline-block">
              View Details →
            </a>
          </div>
        @endforeach
      </div>

      {{-- VIEW MORE --}}
      <div class="text-center">
        <x-action-button href="{{ url('/foods') }}">
          Explore All Foods <span>→</span>
        </x-action-button>
      </div>

    </div>
  </section>

  {{-- BLOG PREVIEW --}}
  <section class="bg-white py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      {{-- HEADER --}}
      <div class="text-center mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">
          Latest Posts
        </h2>
        <p class="text-gray-500 max-w-md mx-auto">
          Learn techniques, progressions, and fitness insights.
        </p>
      </div>

      {{-- BLOG CARDS --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach ($latestPosts as $post)
          <x-blog-card :post="$post" />
        @endforeach
      </div>

      {{-- VIEW MORE --}}
      <div class="text-center">
        <x-action-button href="{{ url('/blogs') }}">
          View My Blogs <span>→</span>
        </x-action-button>
      </div>

    </div>
  </section>

</x-layout>
