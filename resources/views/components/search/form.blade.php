@props([
  'action',
  'name' => 'search',
  'placeholder' => 'Cari...',
])

<form method="GET" action="{{ url($action) }}">
  <div class="relative max-w-4xl mx-auto mb-4">
    <input
      type="text"
      id="searchPublic"
      name="{{ $name }}"
      value="{{ request($name) }}"
      placeholder="{{ $placeholder }}"
      autocomplete="off"
      data-suggest-url="{{ $attributes->get('suggestUrl') }}"
      class="w-full h-11 px-4 pr-20 border rounded-xl
             focus:outline-none focus:ring focus:ring-indigo-200"
    >

    {{-- CLEAR ICON (❌) --}}
    <i
      id="clearIconPublic"
      style="display:none"
      class="fa-solid fa-xmark absolute right-12 top-1/2
            -translate-y-1/2 text-red-500 cursor-pointer z-10">
    </i>

    {{-- SEARCH ICON (🔍) --}}
    <i
      id="searchIconPublic"
      class="fa-solid fa-magnifying-glass absolute right-4 top-1/2
             -translate-y-1/2 text-gray-400 cursor-pointer z-10">
    </i>

    <div
      id="suggestionsPublic"
      class="absolute left-0 right-0 top-full bg-white border
             rounded-xl shadow hidden z-50 max-h-75 overflow-y-auto">
    </div>
  </div>
</form>
