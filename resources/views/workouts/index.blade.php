<x-layout title="Workouts">
  <div class="max-w-7xl mx-auto mt-10 px-4 font-hanken">

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-gray-800">Workouts</h1>
      
      <form method="GET" action="{{ url('/workouts') }}" class="flex-1">
        <div class="flex items-center mx-10 relative">
        
          {{-- INPUT WRAPPER --}}
          <input
            type="text"
            id="search"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari workout..."
            autocomplete="off"
            class="w-full h-10 px-4 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200"
          >

          {{-- Clear icon --}}
          <i
            id="searchIcon"
            class="fa-solid fa-magnifying-glass absolute right-3
                  text-gray-400 cursor-pointer">
          </i>

          {{-- Suggestions --}}
          <div 
            id="suggestions"
            class="absolute left-0 right-0 top-full bg-white border rounded shadow hidden z-50">
          </div>

        </div>
      </form>

      <a href="/workouts/create"
        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
        + Tambah Workout
      </a>
    </div>
    

    @if ($workouts->isEmpty())
      <div class="text-center text-gray-500 py-20">
        Belum ada workout. Tambahkan workout pertama.
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">

        @foreach ($workouts as $workout)
          {{-- CARD --}}
          <div class="bg-white hover:shadow-lg transition rounded-xl overflow-hidden h-full flex flex-col p-4">

            {{-- TITLE --}}
            <h3 class="font-bold text-xl text-gray-800 mb-2">
              {{ $loop->iteration }}. {{ $workout->title }}
            </h3>

            {{-- IMAGE --}}
            <div class="h-56 bg-gray-100 rounded-lg overflow-hidden mb-3">
              @if ($workout->image_thumb)
                <img src="{{ asset('storage/'.$workout->image_thumb) }}"
                    class="w-full h-full object-cover">
              @else
                <div class="flex items-center justify-center h-full text-gray-400">
                  No Image
                </div>
              @endif
            </div>

            {{-- CONTENT (FLEX-1) --}}
            <div class="flex-1">
              {{-- CATEGORY --}}
              <div class="flex items-center gap-2 mb-2">
                <p class="text-sm text-gray-500">Muscle target:</p>
                <span class="inline-block text-sm bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">
                  {{ $workout->category->name ?? '-' }}
                </span>
              </div>

              {{-- DESCRIPTION --}}
              <p class="text-gray-600">
                {{ \Illuminate\Support\Str::limit($workout->description ?? 'Tidak ada deskripsi', 200) }}
              </p>
            </div>

            {{-- ACTION BUTTONS (AUTO BOTTOM) --}}
            <div class="flex gap-3 mt-auto pt-4 text-sm">
              <a href="{{route('admin.workout.show', $workout)}}"
                class="hover:bg-indigo-600 rounded bg-indigo-500 px-3 py-1.5 text-white">
                View
              </a>
              <a href="#"
                class="hover:bg-green-600 rounded bg-green-500 px-3 py-1.5 text-white">
                Edit
              </a>
              <a href="#"
                class="hover:bg-red-600 rounded bg-red-500 px-3 py-1.5 text-white">
                Delete
              </a>
            </div>

          </div>
        @endforeach

      </div>

      <div class="mb-20 flex justify-center">
        {{ $workouts->onEachSide(1)->links('pagination::tailwind') }}
      </div>

    @endif

  </div>
</x-layout>