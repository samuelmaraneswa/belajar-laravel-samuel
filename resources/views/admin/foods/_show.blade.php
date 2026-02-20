@php
  $nutrition = $food->nutrition;
  $baseValue = $food->serving_base_value;
  $unit = $food->serving_unit;
@endphp

<div class="space-y-2">

  {{-- TITLE --}}
  <div>
    <h2 class="text-2xl font-bold text-gray-800">
      {{ $food->name }}
    </h2>

    <div class="mt-2 flex items-center gap-2 text-sm overflow-x-auto flex-nowrap pb-2">
      <span class="text-gray-500 whitespace-nowrap">Serving Size:</span>

      <input
        type="number"
        id="servingInput"
        value="{{ rtrim(rtrim($baseValue, '0'), '.') }}"
        step="1"
        min="1"
        class="w-20 border rounded px-2 py-1 text-sm"
        data-base="{{ $baseValue }}"
      >

      <span>{{ $unit }}</span>

      <button
        type="button"
        id="calculateBtn"
        class="px-3 py-1.5 bg-gray-300 text-black rounded text-xs hover:bg-gray-400 cursor-pointer"
      >
        Calculate
      </button>

      <p class="text-sm text-red-700 whitespace-nowrap">&larr; Choose your serving size.</p>
    </div>
  </div>

  <hr>

  {{-- BASIC INFO --}}
  <div class="grid grid-cols-2 gap-4 text-sm">

    <div>
      <span class="font-medium">Status:</span>
      @if($food->is_active)
        <span class="text-green-600">Active</span>
      @else
        <span class="text-red-600">Inactive</span>
      @endif
    </div>

    @if($food->image)
      <div class="col-span-2">
        <img
          src="{{ asset('storage/' . $food->image) }}"
          class="w-40 rounded-lg border"
        >
      </div>
    @endif

  </div>

  <hr>

  {{-- NUTRITION COMPLETE --}}
  <div class="space-y-2 text-sm">

    {{-- ENERGY --}}
    <div class="flex justify-between font-semibold border-b border-gray-300">
      <span>Energi</span>
      <span data-base="{{ $nutrition->calories_kcal ?? 0 }}" data-unit="kcal">
        {{ $nutrition->calories_kcal ?? '-' }} kcal
      </span>
    </div>

    {{-- FAT --}}
    <div class="flex justify-between font-semibold border-b border-gray-300">
      <span>Lemak</span>
      <span data-base="{{ $nutrition->fat_g ?? 0 }}" data-unit="g">
        {{ $nutrition->fat_g ?? '-' }} g
      </span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Lemak Jenuh</span>
      <span data-base="{{ $nutrition->saturated_fat_g ?? 0 }}" data-unit="g">
        {{ $nutrition->saturated_fat_g ?? '-' }} g
      </span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Lemak tak Jenuh Ganda</span>
      <span data-base="{{ $nutrition->polyunsaturated_fat_g ?? 0 }}" data-unit="g">
        {{ $nutrition->polyunsaturated_fat_g ?? '-' }} g
      </span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Lemak tak Jenuh Tunggal</span>
      <span data-base="{{ $nutrition->monounsaturated_fat_g ?? 0 }}" data-unit="g">
        {{ $nutrition->monounsaturated_fat_g ?? '-' }} g
      </span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Trans Fat</span>
      <span data-base="{{ $nutrition->trans_fat_g ?? 0 }}" data-unit="g">
        {{ $nutrition->trans_fat_g ?? '-' }} g
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Kolesterol</span>
      <span data-base="{{ $nutrition->cholesterol_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->cholesterol_mg ?? '-' }} mg
      </span>
    </div>

    {{-- PROTEIN --}}
    <div class="flex justify-between font-semibold border-b border-gray-300">
      <span>Protein</span>
      <span data-base="{{ $nutrition->protein_g ?? 0 }}" data-unit="g">
        {{ $nutrition->protein_g ?? '-' }} g
      </span>
    </div>

    {{-- CARBS --}}
    <div class="flex justify-between font-semibold border-b border-gray-300">
      <span>Karbohidrat</span>
      <span data-base="{{ $nutrition->carbs_g ?? 0 }}" data-unit="g">
        {{ $nutrition->carbs_g ?? '-' }} g
      </span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Serat</span>
      <span data-base="{{ $nutrition->fiber_g ?? 0 }}" data-unit="g">
        {{ $nutrition->fiber_g ?? '-' }} g
      </span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Gula</span>
      <span data-base="{{ $nutrition->sugar_g ?? 0 }}" data-unit="g">
        {{ $nutrition->sugar_g ?? '-' }} g
      </span>
    </div>

    {{-- WATER & ALCOHOL --}}
    <div class="flex justify-between border-b border-gray-300">
      <span>Air</span>
      <span data-base="{{ $nutrition->water_g ?? 0 }}" data-unit="g">
        {{ $nutrition->water_g ?? '-' }} g
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Alkohol</span>
      <span data-base="{{ $nutrition->alcohol_g ?? 0 }}" data-unit="g">
        {{ $nutrition->alcohol_g ?? '-' }} g
      </span>
    </div>

    {{-- MINERALS --}}
    <div class="flex justify-between border-b border-gray-300">
      <span>Sodium</span>
      <span data-base="{{ $nutrition->sodium_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->sodium_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Kalium</span>
      <span data-base="{{ $nutrition->potassium_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->potassium_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Kalsium</span>
      <span data-base="{{ $nutrition->calcium_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->calcium_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Zat Besi</span>
      <span data-base="{{ $nutrition->iron_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->iron_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Magnesium</span>
      <span data-base="{{ $nutrition->magnesium_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->magnesium_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Zinc</span>
      <span data-base="{{ $nutrition->zinc_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->zinc_mg ?? '-' }} mg
      </span>
    </div>

    {{-- VITAMINS --}}
    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin A</span>
      <span data-base="{{ $nutrition->vitamin_a_mcg ?? 0 }}" data-unit="mcg">
        {{ $nutrition->vitamin_a_mcg ?? '-' }} mcg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B1</span>
      <span data-base="{{ $nutrition->vitamin_b1_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->vitamin_b1_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B2</span>
      <span data-base="{{ $nutrition->vitamin_b2_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->vitamin_b2_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B3</span>
      <span data-base="{{ $nutrition->vitamin_b3_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->vitamin_b3_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B6</span>
      <span data-base="{{ $nutrition->vitamin_b6_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->vitamin_b6_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B12</span>
      <span data-base="{{ $nutrition->vitamin_b12_mcg ?? 0 }}" data-unit="mcg">
        {{ $nutrition->vitamin_b12_mcg ?? '-' }} mcg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin C</span>
      <span data-base="{{ $nutrition->vitamin_c_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->vitamin_c_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin D</span>
      <span data-base="{{ $nutrition->vitamin_d_mcg ?? 0 }}" data-unit="mcg">
        {{ $nutrition->vitamin_d_mcg ?? '-' }} mcg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin E</span>
      <span data-base="{{ $nutrition->vitamin_e_mg ?? 0 }}" data-unit="mg">
        {{ $nutrition->vitamin_e_mg ?? '-' }} mg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin K</span>
      <span data-base="{{ $nutrition->vitamin_k_mcg ?? 0 }}" data-unit="mcg">
        {{ $nutrition->vitamin_k_mcg ?? '-' }} mcg
      </span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Folat</span>
      <span data-base="{{ $nutrition->folate_mcg ?? 0 }}" data-unit="mcg">
        {{ $nutrition->folate_mcg ?? '-' }} mcg
      </span>
    </div>

  </div>

</div>