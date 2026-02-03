<x-user.layout>

  <h1 class="text-2xl font-bold mb-6">My Programs</h1>

  <div class="grid gap-4">
    @forelse ($programs as $program)
      <a href="{{ route('programs.show', $program) }}"
         class="group block rounded-xl border bg-white p-5
                transition hover:shadow-md hover:border-gray-300">

        <div class="flex items-start justify-between gap-3">
          <h2 class="text-lg font-semibold text-gray-900">
            {{ $program->title }}
          </h2>

          <span class="shrink-0 rounded-full bg-gray-100 px-3 py-1
                       text-xs font-medium text-gray-600 capitalize">
            {{ $program->level }}
          </span>
        </div>

        <div class="mt-2 flex flex-wrap items-center gap-2 text-sm text-gray-500">
          <span class="capitalize">
            {{ str_replace('_', ' ', $program->goal) }}
          </span>

          <span class="opacity-50">•</span>

          <span>
            {{ ucfirst($program->context) }}
          </span>

          <span class="opacity-50">•</span>

          <span>
            {{ $program->created_at->diffForHumans() }}
          </span>
        </div>

      </a>
    @empty
      <p class="text-gray-500">No programs yet.</p>
    @endforelse
  </div>

</x-user.layout>

{{-- <x-user.layout>

  <h1 class="text-2xl font-bold mb-6">My Programs</h1>

  <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($programs as $program)
      <div
        class="group relative rounded-2xl border bg-white p-5
               transition hover:-translate-y-0.5 hover:shadow-lg">

        <div class="space-y-1">
          <h2 class="text-lg font-semibold text-gray-900 leading-snug">
            {{ $program->title }}
          </h2>

          <div class="flex items-center justify-between text-xs text-gray-600">
            <span class="capitalize font-medium">
              Level: {{ $program->level }}
            </span>

            <span class="shrink-0 capitalize font-medium">
              {{ $program->created_at->diffForHumans() }}
            </span>
          </div>
        </div>

        <div class="mt-3 space-y-1 text-sm text-gray-500">
          <div class="capitalize">
            Goal: {{ str_replace('_', ' ', $program->goal) }}
          </div>
          <div>
            Tipe: {{ ucfirst($program->context) }} 
          </div>
          <hr class="mt-3 border-gray-400">
        </div>

        <div class="mt-5 flex items-center justify-between gap-3">
          <a href="{{ route('programs.show', $program) }}"
             class="inline-flex items-center justify-center
                    rounded-lg bg-black px-4 py-2
                    text-sm font-medium text-white
                    transition hover:bg-gray-800">
            View
          </a>

          <form method="POST" action="">
            @csrf
            @method('DELETE')
            <button
              type="submit"
              onclick="return confirm('Delete this program?')"
              class="text-sm font-medium bg-red-600 rounded-lg cursor-pointer px-4 py-2 text-white transition hover:text-white hover:bg-red-700">
              Delete
            </button>
          </form>
        </div>

      </div>
    @empty
      <p class="text-gray-500">No programs yet.</p>
    @endforelse
  </div>

</x-user.layout> --}}
