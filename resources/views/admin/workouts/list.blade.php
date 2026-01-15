<x-admin-layout>
  <div class="max-w-7xl mx-auto font-hanken">

    <x-alert type="success" />

    {{-- Top Section --}}
    <div class="flex justify-between items-center mb-6">
      <div class="hidden sm:block">
        <x-admin.page-title title="All Workouts" />
      </div>

      <x-form action="{{url('/admin/workouts')}}" method="GET" class="flex-1">
        <div class="flex items-center mx-4 relative">

          {{-- INPUT WRAPPER --}}
          <x-input inline id="search" name="search" value="{{request('search')}}" placeholder="Cari workout..." autocomplete="off" :unstyled="true" class="w-full h-9 px-4 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200" />

          {{-- Clear icon --}}
          <i
            id="searchIcon"
            class="fa-solid fa-magnifying-glass absolute right-3
                  text-gray-400 cursor-pointer">
          </i>

          {{-- Suggestions --}}
          <x-admin.search-suggestions id="suggestions" />

        </div>
      </x-form>

      <a href={{route('admin.workout.create')}}>
        <x-button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 hover:text-white/90">
          <i class="fa fa-plus text-lg"></i>
          <span class="hidden sm:inline pl-1 text-sm">Tambah</span>
        </x-button>
      </a>
    </div>

    {{-- Muscle Groups --}}
    <x-muscle-groups :muscles="$muscles" />

    @if ($workouts->isEmpty())
    <div class="text-center text-gray-500 py-20">
      Belum ada workout. Tambahkan workout pertama.
    </div>
    @else
    <div id="workoutGrid">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">

        @foreach ($workouts as $workout)
        {{-- CARD --}}
        <x-admin.card class="p-4">

          {{-- TITLE --}}
          <h3 class="font-bold text-xl text-gray-800 mb-2">
            {{ $loop->iteration }}. {{ Str::title($workout->title) }}
          </h3>

          {{-- IMAGE --}}
          <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-3">
            @if ($workout->image_thumb)
            <img src="{{ asset('storage/'.$workout->image_thumb) }}"
              class="w-full h-full object-cover scale-115" style="object-position: 40px 50%;">
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
              <p class="text-sm text-gray-500">Category workout:</p>
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
            <a href="{{route('admin.workout.show', $workout->slug)}}"
              class="hover:bg-indigo-600 rounded bg-indigo-500 px-3 py-1.5 text-white">
              View
            </a>
            <a href="{{ route('admin.workouts.edit', $workout) }}"
              class="hover:bg-green-600 rounded bg-green-500 px-3 py-1.5 text-white">
              Edit
            </a>
            <form action="{{ route('admin.workouts.destroy', $workout) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin hapus workout ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="hover:bg-red-600 rounded bg-red-500 px-3 py-1.5 text-white">
                Delete
              </button>
            </form>
          </div>

        </x-admin.card>
        @endforeach

      </div>
    </div>

    <div id="pagination" class="mt-8 flex justify-center"></div>
    @endif

  </div>
</x-admin-layout>