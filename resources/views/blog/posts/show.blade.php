<x-layout :title="$post->title">

  <div class="max-w-4xl mx-auto px-4 sm:px-8 mt-8 mb-16 font-hanken">

    <div class="bg-white rounded-2xl shadow-sm p-6 sm:p-8">

      {{-- TITLE --}}
      <h1 class="text-3xl font-bold text-gray-900 mb-3">
        {{ $post->title }}
      </h1>

      {{-- META --}}
      <div class="text-sm text-gray-500 mb-6">
        {{ $post->category->name ?? '-' }}
        •
        {{ $post->tema->name ?? '-' }}
        •
        {{ $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y') }}
      </div>
      
      {{-- VIDEO --}}
      @php
        $youtubeId = null;

        if (!empty($post->video_url)) {
          $url = $post->video_url;

          if (str_contains($url, 'youtu.be')) {
            $youtubeId = basename(parse_url($url, PHP_URL_PATH));
          } elseif (str_contains($url, 'youtube.com')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
            $youtubeId = $query['v'] ?? null;
          }
        }
      @endphp

      @if ($youtubeId)
        <div class="aspect-video w-full mb-6 rounded-xl overflow-hidden">
          <iframe
            src="https://www.youtube.com/embed/{{ $youtubeId }}"
            class="w-full h-full"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>
      @endif

      {{-- CONTENT --}}
      <div class="prose max-w-none text-gray-800">
        {!! nl2br(e($post->content)) !!}
      </div>

      {{-- WORKOUT PROGRESSION (jika calisthenics) --}}
      @if ($post->isCalisthenics() && $post->workoutDetails->count())
        <div class="mt-10">

          <h2 class="text-xl font-semibold mb-4">
            Workout Details
          </h2>

          <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-xl overflow-hidden">

              <thead class="bg-gray-100 text-gray-700">
                <tr>
                  <th class="text-left px-4 py-3">Progression</th>
                  <th class="text-left px-4 py-3">Sets</th>
                  <th class="text-left px-4 py-3">Reps</th>
                  <th class="text-left px-4 py-3">Hold (sec)</th>
                  <th class="text-left px-4 py-3">Weight (kg)</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-200">
                @foreach ($post->workoutDetails as $detail)
                  <tr class="bg-white">
                    <td class="px-4 py-3 font-medium text-gray-800">
                      {{ $detail->progression ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                      {{ $detail->sets ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                      {{ $detail->reps ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                      {{ $detail->hold_seconds ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                      {{ $detail->weight ?? '-' }}
                    </td>
                  </tr>
                @endforeach
              </tbody>

            </table>
          </div>

        </div>
      @endif

    </div>

  </div>

</x-layout>
