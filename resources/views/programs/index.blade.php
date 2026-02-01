<x-user.layout>

  <h1 class="text-2xl font-bold mb-4">My Programs</h1>

  <div class="space-y-3">
    @forelse ($programs as $program)
      <a href="{{ route('programs.show', $program) }}"
         class="block border rounded p-4 hover:bg-gray-50">

        <div class="font-semibold capitalize">
          {{ str_replace('_', ' ', $program->goal) }} · {{ $program->level }}
        </div>

        <div class="text-sm text-gray-500">
          {{ ucfirst($program->context) }} · Created {{ $program->created_at->diffForHumans() }}
        </div>
      </a>
    @empty
      <p class="text-gray-500">No programs yet.</p>
    @endforelse
  </div>

</x-user.layout>
