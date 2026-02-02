<x-user.layout>

  <h1 class="text-2xl font-bold mb-6">My Programs</h1>

  <div class="grid gap-4">
    @forelse ($programs as $program)
      <a href="{{ route('programs.show', $program) }}"
         class="group block rounded-xl border bg-white p-5
                transition hover:shadow-md hover:border-gray-300">

        {{-- TITLE --}}
        <div class="flex items-start justify-between gap-3">
          <h2 class="text-lg font-semibold text-gray-900">
            {{ $program->title }}
          </h2>

          <span class="shrink-0 rounded-full bg-gray-100 px-3 py-1
                       text-xs font-medium text-gray-600 capitalize">
            {{ $program->level }}
          </span>
        </div>

        {{-- META --}}
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
