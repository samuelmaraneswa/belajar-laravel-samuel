<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">

  @if ($workouts->isEmpty())
    <div class="col-span-full text-center text-gray-500 py-20">
      Belum ada workout.
    </div>
  @else

    @foreach ($workouts as $workout)
    {{-- CARD --}}
    <x-admin.card class="p-4">

      {{-- TITLE --}}
      <h3 class="font-bold text-xl text-gray-800 mb-2">
        {{ ($workouts instanceof \Illuminate\Pagination\AbstractPaginator
            ? $workouts->firstItem()
            : 1) + $loop->index
        }}. {{ $workout->title }}
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
        <a href="{{ route('admin.workout.show', $workout->slug) }}?context={{ request('context') }}"
          class="hover:bg-indigo-600 rounded bg-indigo-500 px-3 py-1.5 text-white">
          View
        </a>
        <a href="{{ route('admin.workout.edit', $workout) }}"
          class="hover:bg-green-600 rounded bg-green-500 px-3 py-1.5 text-white">
          Edit
        </a>
        <form action="{{ route('admin.workout.destroy', $workout) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus workout ini?')">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="hover:bg-red-600 rounded bg-red-500 px-3 py-1.5 text-white cursor-pointer">
            Delete
          </button>
        </form>
      </div>

    </x-admin.card>
    @endforeach
  
  @endif

</div>