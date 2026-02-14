<x-admin-layout>
  <div class="max-w-5xl mx-auto font-hanken">

    {{-- PAGE TITLE --}}
    <x-admin.page-title title="Informasi Gizi" />

    {{-- SEARCH --}}
<div class="mt-6 mb-8 flex items-center justify-between gap-4">

  <x-form action="{{ route('admin.foods.index') }}" method="GET" class="flex-1">
    <div class="relative w-full">

      <x-input
        inline
        name="search"
        value="{{ $search }}"
        placeholder="Cari makanan..."
        autocomplete="off"
        :unstyled="true"
        class="w-full h-10 px-4 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
      />

      <button type="submit"
        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-indigo-600 cursor-pointer">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>

    </div>
  </x-form>

  {{-- ADD FOOD --}}
  <a href="{{ route('admin.foods.create') }}">
    <x-button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 hover:text-white">
      <i class="fa fa-plus"></i>
      <span class="hidden sm:inline pl-1 text-sm">Tambah</span>
    </x-button>
  </a>

</div>


    @php
      $nutrition = $food->nutrition ?? null;
    @endphp

    {{-- NUTRITION TABLE --}}
    <div class="bg-white rounded-xl shadow p-6">

      {{-- TITLE --}}
      <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">
          {{ $food->name ?? '-' }}
        </h2>
        <p class="text-sm text-gray-500">
          Ukuran Porsi: {{ $nutrition->serving_base_gram ?? 100 }} gram (g)
        </p>
      </div>

      <hr class="my-4">

      <div class="space-y-2 text-sm">

        {{-- ENERGY --}}
        <div class="flex justify-between font-semibold">
          <span>Energi</span>
          <span>
            {{ $nutrition->calories_kcal ?? '-' }} kcal
          </span>
        </div>

        {{-- FAT --}}
        <div class="flex justify-between font-semibold">
          <span>Lemak</span>
          <span>{{ $nutrition->fat_g ?? '-' }} g</span>
        </div>

        <div class="pl-4 flex justify-between">
          <span>Lemak Jenuh</span>
          <span>{{ $nutrition->saturated_fat_g ?? '-' }} g</span>
        </div>

        <div class="pl-4 flex justify-between">
          <span>Lemak tak Jenuh Ganda</span>
          <span>{{ $nutrition->polyunsaturated_fat_g ?? '-' }} g</span>
        </div>

        <div class="pl-4 flex justify-between">
          <span>Lemak tak Jenuh Tunggal</span>
          <span>{{ $nutrition->monounsaturated_fat_g ?? '-' }} g</span>
        </div>

        <div class="pl-4 flex justify-between">
          <span>Trans Fat</span>
          <span>{{ $nutrition->trans_fat_g ?? '-' }} g</span>
        </div>

        {{-- CHOLESTEROL --}}
        <div class="flex justify-between">
          <span>Kolesterol</span>
          <span>{{ $nutrition->cholesterol_mg ?? '-' }} mg</span>
        </div>

        {{-- PROTEIN --}}
        <div class="flex justify-between font-semibold">
          <span>Protein</span>
          <span>{{ $nutrition->protein_g ?? '-' }} g</span>
        </div>

        {{-- CARBS --}}
        <div class="flex justify-between font-semibold">
          <span>Karbohidrat</span>
          <span>{{ $nutrition->carbs_g ?? '-' }} g</span>
        </div>

        <div class="pl-4 flex justify-between">
          <span>Serat</span>
          <span>{{ $nutrition->fiber_g ?? '-' }} g</span>
        </div>

        <div class="pl-4 flex justify-between">
          <span>Gula</span>
          <span>{{ $nutrition->sugar_g ?? '-' }} g</span>
        </div>

        {{-- MINERALS --}}
        <div class="flex justify-between">
          <span>Sodium</span>
          <span>{{ $nutrition->sodium_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Kalium</span>
          <span>{{ $nutrition->potassium_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Kalsium</span>
          <span>{{ $nutrition->calcium_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Zat Besi</span>
          <span>{{ $nutrition->iron_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Magnesium</span>
          <span>{{ $nutrition->magnesium_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Zinc</span>
          <span>{{ $nutrition->zinc_mg ?? '-' }} mg</span>
        </div>

        {{-- VITAMINS --}}
        <div class="flex justify-between">
          <span>Vitamin A</span>
          <span>{{ $nutrition->vitamin_a_mcg ?? '-' }} mcg</span>
        </div>

        <div class="flex justify-between">
          <span>Vitamin B1</span>
          <span>{{ $nutrition->vitamin_b1_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Vitamin B2</span>
          <span>{{ $nutrition->vitamin_b2_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Vitamin B3</span>
          <span>{{ $nutrition->vitamin_b3_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Vitamin B6</span>
          <span>{{ $nutrition->vitamin_b6_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Vitamin B12</span>
          <span>{{ $nutrition->vitamin_b12_mcg ?? '-' }} mcg</span>
        </div>

        <div class="flex justify-between">
          <span>Vitamin C</span>
          <span>{{ $nutrition->vitamin_c_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Vitamin D</span>
          <span>{{ $nutrition->vitamin_d_mcg ?? '-' }} mcg</span>
        </div>

        <div class="flex justify-between">
          <span>Vitamin E</span>
          <span>{{ $nutrition->vitamin_e_mg ?? '-' }} mg</span>
        </div>

        <div class="flex justify-between">
          <span>Vitamin K</span>
          <span>{{ $nutrition->vitamin_k_mcg ?? '-' }} mcg</span>
        </div>

        <div class="flex justify-between">
          <span>Folat</span>
          <span>{{ $nutrition->folate_mcg ?? '-' }} mcg</span>
        </div>

      </div>
    </div>

  </div>
</x-admin-layout>
