@php
  $nutrition = $food->nutrition;
@endphp

<div class="space-y-6">

  {{-- TITLE --}}
  <div>
    <h2 class="text-2xl font-bold text-gray-800">
      {{ $food->name }}
    </h2>

    <p class="text-sm text-gray-500">
      Serving Size:
      {{ $nutrition->serving_base_gram ?? 100 }} gram
    </p>
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
      <span>{{ $nutrition->calories_kcal ?? '-' }} kcal</span>
    </div>

    {{-- FAT --}}
    <div class="flex justify-between font-semibold  border-b border-gray-300">
      <span>Lemak</span>
      <span>{{ $nutrition->fat_g ?? '-' }} g</span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Lemak Jenuh</span>
      <span>{{ $nutrition->saturated_fat_g ?? '-' }} g</span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Lemak tak Jenuh Ganda</span>
      <span>{{ $nutrition->polyunsaturated_fat_g ?? '-' }} g</span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Lemak tak Jenuh Tunggal</span>
      <span>{{ $nutrition->monounsaturated_fat_g ?? '-' }} g</span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Trans Fat</span>
      <span>{{ $nutrition->trans_fat_g ?? '-' }} g</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Kolesterol</span>
      <span>{{ $nutrition->cholesterol_mg ?? '-' }} mg</span>
    </div>

    {{-- PROTEIN --}}
    <div class="flex justify-between font-semibold border-b border-gray-300">
      <span>Protein</span>
      <span>{{ $nutrition->protein_g ?? '-' }} g</span>
    </div>

    {{-- CARBS --}}
    <div class="flex justify-between font-semibold border-b border-gray-300">
      <span>Karbohidrat</span>
      <span>{{ $nutrition->carbs_g ?? '-' }} g</span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Serat</span>
      <span>{{ $nutrition->fiber_g ?? '-' }} g</span>
    </div>

    <div class="ml-4 flex justify-between border-b border-gray-300">
      <span>Gula</span>
      <span>{{ $nutrition->sugar_g ?? '-' }} g</span>
    </div>

    {{-- WATER & ALCOHOL --}}
    <div class="flex justify-between border-b border-gray-300">
      <span>Air</span>
      <span>{{ $nutrition->water_g ?? '-' }} g</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Alkohol</span>
      <span>{{ $nutrition->alcohol_g ?? '-' }} g</span>
    </div>

    {{-- MINERALS --}}
    <div class="flex justify-between border-b border-gray-300">
      <span>Sodium</span>
      <span>{{ $nutrition->sodium_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Kalium</span>
      <span>{{ $nutrition->potassium_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Kalsium</span>
      <span>{{ $nutrition->calcium_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Zat Besi</span>
      <span>{{ $nutrition->iron_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Magnesium</span>
      <span>{{ $nutrition->magnesium_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Zinc</span>
      <span>{{ $nutrition->zinc_mg ?? '-' }} mg</span>
    </div>

    {{-- VITAMINS --}}
    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin A</span>
      <span>{{ $nutrition->vitamin_a_mcg ?? '-' }} mcg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B1</span>
      <span>{{ $nutrition->vitamin_b1_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B2</span>
      <span>{{ $nutrition->vitamin_b2_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B3</span>
      <span>{{ $nutrition->vitamin_b3_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B6</span>
      <span>{{ $nutrition->vitamin_b6_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin B12</span>
      <span>{{ $nutrition->vitamin_b12_mcg ?? '-' }} mcg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin C</span>
      <span>{{ $nutrition->vitamin_c_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin D</span>
      <span>{{ $nutrition->vitamin_d_mcg ?? '-' }} mcg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin E</span>
      <span>{{ $nutrition->vitamin_e_mg ?? '-' }} mg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Vitamin K</span>
      <span>{{ $nutrition->vitamin_k_mcg ?? '-' }} mcg</span>
    </div>

    <div class="flex justify-between border-b border-gray-300">
      <span>Folat</span>
      <span>{{ $nutrition->folate_mcg ?? '-' }} mcg</span>
    </div>

  </div>

</div>
