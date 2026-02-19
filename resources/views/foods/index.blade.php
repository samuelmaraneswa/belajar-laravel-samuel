<x-layout title="Foods">
  <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-8 font-hanken">

    {{-- ================= SEARCH AJAX ================= --}}
    <form id="foodSearchForm">
      <div class="relative max-w-4xl mx-auto mb-4">

        <input
          type="text"
          id="foodSearch"
          placeholder="Cari makanan..."
          autocomplete="off"
          data-suggest-url="/foods/suggest"
          class="w-full h-11 px-4 pr-20 border rounded-xl
                focus:outline-none focus:ring focus:ring-indigo-200"
        >

        {{-- CLEAR ICON --}}
        <i
          id="clearFoodIcon"
          style="display:none"
          class="fa-solid fa-xmark absolute right-12 top-1/2
                -translate-y-1/2 text-red-500 cursor-pointer z-10">
        </i>

        {{-- SEARCH ICON --}}
        <i
          id="searchFoodIcon"
          class="fa-solid fa-magnifying-glass absolute right-4 top-1/2
                -translate-y-1/2 text-gray-400 cursor-pointer z-10">
        </i>

        <div
          id="foodSuggestions"
          class="absolute left-0 right-0 top-full bg-white border
                rounded-xl shadow hidden z-50 max-h-75 overflow-y-auto">
        </div>  
      </div>

      <p id="foodNotFound"
        class="text-red-600 text-sm text-center mb-4 hidden">
      </p>

    </form>


    {{-- 3 COLUMN LAYOUT --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8 items-start">

      {{-- ================= CENTER : RINGKASAN ================= --}}
      <div class="bg-gray-100 rounded-xl shadow p-6 order-1 lg:order-2 h-fit">

        <h2 class="text-xl font-bold mb-4">Ringkasan Gizi</h2>
        <p id="foodTitleSummary" class="text-xl font-bold mb-4">-</p>

        <div class="flex items-center gap-2 text-sm mb-2">
          <span>Serving:</span>
          <input type="number" id="servingInput" value="" class="w-20 border rounded px-2 py-1">
          <span>gr</span>
          <button id="calculateBtn"
            class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">
            Calculate
          </button>
        </div>
        <p class="text-xs text-red-600 mb-4 flex items-center gap-1">
          Choose your serving size here ↑
        </p>

        <div class="grid grid-cols-2 gap-4 text-center">

          <div class="bg-white border rounded-lg p-3">
            <p class="text-sm text-gray-500">Kal</p>
            <p class="text-lg font-bold" id="summary_kal">-</p>
          </div>

          <div class="bg-white border rounded-lg p-3">
            <p class="text-sm text-gray-500">Lemak</p>
            <p class="text-lg font-bold" id="summary_fat">- g</p>
          </div>

          <div class="bg-white border rounded-lg p-3">
            <p class="text-sm text-gray-500">Karb</p>
            <p class="text-lg font-bold" id="summary_carb">- g</p>
          </div>

          <div class="bg-white border rounded-lg p-3">
            <p class="text-sm text-gray-500">Prot</p>
            <p class="text-lg font-bold" id="summary_protein">- g</p>
          </div>

        </div>

        <div class="mt-10">
          <img
            id="foodImage"
            src=""
            alt=""
            class="w-full h-48 object-cover rounded-lg hidden border border-b-indigo-700"
          >
        </div>

      </div>

      {{-- ================= LEFT : INFORMASI GIZI ================= --}}
      <div class="bg-white rounded-xl shadow p-6 order-2 lg:order-1 h-fit">

        <h2 class="text-xl font-bold mb-4">Informasi Gizi</h2>
        <p id="foodTitleDetail" class="text-xl font-bold mb-4">-</p>

        <div class="space-y-2 text-sm">
          {{-- SEMUA FIELD TETAP (tidak diubah) --}}
          <div class="flex justify-between font-semibold border-b pb-1">
            <span>Energi</span><span id="energy">- kcal</span>
          </div>

          <div class="flex justify-between font-semibold border-b pb-1">
            <span>Lemak</span><span id="fat">- g</span>
          </div>

          <div class="pl-4 flex justify-between">
            <span>Lemak Jenuh</span><span id="sat_fat">- g</span>
          </div>

          <div class="pl-4 flex justify-between">
            <span>Lemak tak Jenuh Ganda</span><span id="poly_fat">- g</span>
          </div>

          <div class="pl-4 flex justify-between">
            <span>Lemak tak Jenuh Tunggal</span><span id="mono_fat">- g</span>
          </div>

          <div class="pl-4 flex justify-between border-b pb-1">
            <span>Trans Fat</span><span id="trans_fat">- g</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Kolesterol</span><span id="cholesterol">- mg</span>
          </div>

          <div class="flex justify-between font-semibold border-b pb-1">
            <span>Protein</span><span id="protein">- g</span>
          </div>

          <div class="flex justify-between font-semibold border-b pb-1">
            <span>Karbohidrat</span><span id="carbs">- g</span>
          </div>

          <div class="pl-4 flex justify-between">
            <span>Serat</span><span id="fiber">- g</span>
          </div>

          <div class="pl-4 flex justify-between border-b pb-1">
            <span>Gula</span><span id="sugar">- g</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Air</span><span id="water">- g</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Alkohol</span><span id="alcohol">- g</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Sodium</span><span id="sodium">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Kalium</span><span id="potassium">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Kalsium</span><span id="calcium">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Zat Besi</span><span id="iron">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Magnesium</span><span id="magnesium">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Zinc</span><span id="zinc">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin A</span><span id="vit_a">- mcg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin B1</span><span id="vit_b1">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin B2</span><span id="vit_b2">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin B3</span><span id="vit_b3">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin B6</span><span id="vit_b6">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin B12</span><span id="vit_b12">- mcg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin C</span><span id="vit_c">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin D</span><span id="vit_d">- mcg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin E</span><span id="vit_e">- mg</span>
          </div>

          <div class="flex justify-between border-b pb-1">
            <span>Vitamin K</span><span id="vit_k">- mcg</span>
          </div>

          <div class="flex justify-between">
            <span>Folat</span><span id="folate">- mcg</span>
          </div>
        </div>
      </div>

      {{-- ================= RIGHT : MAKANAN LAIN ================= --}}
      <div class="bg-white rounded-xl shadow p-6 order-3 h-fit">

        <h2 class="text-xl font-bold mb-4">
          Informasi Gizi Makanan Lain
        </h2>

        <div id="otherFoods" class="space-y-1 text-sm max-h-150 overflow-y-auto">
          @foreach(\App\Models\Food::where('is_active', true)->limit(10)->get() as $food)
            <button
              data-slug="{{ $food->slug }}"
              class="w-full text-left cursor-pointer hover:underline px-3 py-2 rounded hover:bg-gray-100 flex items-center gap-2 other-food-item">

              <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
              <span>{{ $food->name }}</span>

            </button>
          @endforeach
        </div>

      </div>

    </div>

  </div>
</x-layout>
