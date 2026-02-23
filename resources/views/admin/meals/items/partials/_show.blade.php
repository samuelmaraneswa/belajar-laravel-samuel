<div class="space-y-8">

  {{-- TITLE --}}
  <div>
    <h1 class="text-2xl font-bold text-gray-900">
      {{ $meal->title }}
    </h1>

    <div class="text-sm text-gray-500 mt-1">
      {{ $meal->category->name ?? '-' }}
      @if($meal->goal)
        • {{ $meal->goal->name }}
      @endif
      @if($meal->prep_time)
        • {{ $meal->prep_time }} menit
      @endif
    </div>
  </div>


  {{-- VIDEO --}}
  @php
    $youtubeId = null;

    if (!empty($meal->video_url)) {

      $url = $meal->video_url;

      if (str_contains($url, 'youtu.be')) {
        $youtubeId = basename(parse_url($url, PHP_URL_PATH));
      }
      elseif (str_contains($url, 'youtube.com')) {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        $youtubeId = $query['v'] ?? null;
      }
    }
  @endphp

  @if ($youtubeId)
    <div class="aspect-video w-full rounded-xl overflow-hidden">
      <iframe
        src="https://www.youtube.com/embed/{{ $youtubeId }}"
        class="w-full h-full"
        frameborder="0"
        allowfullscreen>
      </iframe>
    </div>
  @endif


  {{-- DESCRIPTION --}}
  <div>
    <h2 class="font-semibold text-lg mb-2">Description</h2>
    <p class="text-gray-700 leading-relaxed">
      {{ $meal->description }}
    </p>
  </div>


  {{-- INGREDIENTS --}}
  <div>
    <h2 class="font-semibold text-lg mb-3">Ingredients</h2>

    @foreach($meal->foods as $food)
      @php
        $rawQty = $food->pivot->quantity;

        $qty = number_format($rawQty, 2, '.', '');

        $fractions = [
          '0.50' => '1/2',
          '0.33' => '1/3',
          '0.25' => '1/4',
          '0.20' => '1/5',
          '0.67' => '2/3',
        ];

        if (isset($fractions[$qty])) {
          $displayQty = $fractions[$qty];
        } else {
          $displayQty = fmod($rawQty, 1) == 0
              ? (int) $rawQty
              : rtrim(rtrim($qty, '0'), '.');
        }

        $unit = $food->serving_unit;
      @endphp

      <li class="flex justify-between border-b border-gray-400 pb-1 mb-1 text-sm">
        <span>{{ $food->name }}</span>
        <span class="text-gray-500">
          {{ $displayQty }} {{ $unit }}
        </span>
      </li>
    @endforeach
  </div>

  {{-- STEPS --}}
  @if($meal->steps->count())
    <div>
      <h2 class="font-semibold text-lg mb-3">Cooking Steps</h2>

      <ol class="space-y-3 list-decimal list-inside">
        @foreach($meal->steps->sortBy('step_number') as $step)
          <li class="text-sm text-gray-700">
            {{ $step->instruction }}
          </li>
        @endforeach
      </ol>
    </div>
  @endif

</div>