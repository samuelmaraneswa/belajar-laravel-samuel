<x-user.layout>

  <h1 class="text-2xl font-bold mb-6">My Programs</h1>

  <div class="grid gap-4">
    @forelse ($programs as $program)

      @php
        $progress = (float) ($program->progress ?? 0);
      @endphp

      <a href="{{ route('user.programs.show', $program) }}"
         class="group block rounded-xl border bg-white p-5
                transition hover:shadow-md hover:border-gray-300">

        <div class="flex items-start justify-between gap-6">

          {{-- LEFT CONTENT --}}
          <div class="flex-1">
            <h2 class="text-lg font-semibold text-gray-900">
              {{ $program->title }}
            </h2>

            <div class="mt-2 flex flex-wrap items-center gap-2 text-sm text-gray-500">
              <span class="capitalize">
                {{ str_replace('_', ' ', $program->goal) }}
              </span>

              <span class="opacity-50">•</span>

              <span>{{ ucfirst($program->context) }}</span>

              <span class="opacity-50">•</span>

              <span>{{ $program->created_at->diffForHumans() }}</span>
            </div>
          </div>

          {{-- RIGHT SIDE (LEVEL + CIRCLE) --}}
          <div class="flex flex-col items-center shrink-0">

            <span class="mb-2 rounded-full bg-gray-100 px-3 py-1
                         text-xs font-medium text-gray-600 capitalize">
              {{ $program->level }}
            </span>

            <div class="w-12 h-12 relative">
              <svg viewBox="0 0 36 36" class="w-full h-full -rotate-90">

                <path
                  d="M18 2 a 16 16 0 0 1 0 32 a 16 16 0 0 1 0 -32"
                  fill="none"
                  stroke="#e5e7eb"
                  stroke-width="3"
                />

                <path
                  d="M18 2 a 16 16 0 0 1 0 32 a 16 16 0 0 1 0 -32"
                  fill="none"
                  stroke="{{ $progress >= 100 ? '#16a34a' : '#2563eb' }}"
                  stroke-width="3"
                  stroke-dasharray="{{ $progress }}, 100"
                  stroke-linecap="round"
                />
              </svg>

              <div class="absolute inset-0 flex items-center justify-center
                          text-[11px] font-semibold text-gray-700">
                {{ number_format($progress, 0) }}%
              </div>
            </div>

          </div>

        </div>

      </a>

    @empty
      <p class="text-gray-500">No programs yet.</p>
    @endforelse
  </div>

</x-user.layout>