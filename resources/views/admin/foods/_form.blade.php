{{-- =========================
| BASIC INFORMATION
========================= --}}
<div class="space-y-6">

  <x-input
    label="Food Name"
    name="name"
    placeholder="Contoh: Dada Ayam"
    value="{{ old('name', $food->name ?? '') }}"
  />

  <x-textarea
    label="Description"
    name="description"
    rows="3"
    :value="old('description', $food->description ?? '')"
  />

  <x-input
    label="Image"
    name="image"
    type="file"
    accept="image/*"
  />

  @if(isset($food) && $food->image)
    <p class="text-sm text-gray-500">
      Image saat ini: {{ $food->image }}
    </p>
  @endif

  <div>
    <label class="inline-flex items-center gap-2">
      <input
        type="checkbox"
        name="is_active"
        value="1"
        {{ old('is_active', $food->is_active ?? true) ? 'checked' : '' }}
      >
      <span class="text-sm text-gray-600">Active</span>
    </label>
  </div>

  {{-- =========================
  | SERVING CONFIGURATION
  ========================= --}}
  <div class="mt-8 border-t pt-6 space-y-6">

    <h3 class="text-lg font-semibold text-gray-800">
      Serving Configuration
    </h3>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

      {{-- Serving Base Value --}}
      <x-input
        label="Serving Base Value"
        name="serving_base_value"
        type="number"
        step="0.01"
        value="{{ old('serving_base_value', $food->serving_base_value ?? 100) }}"
      />

      {{-- Serving Unit --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
          Serving Unit
        </label>
        <select
          name="serving_unit"
          id="serving_unit"
          class="w-full border rounded-lg px-3 py-2 text-sm"
        >
          @php
            $unit = old('serving_unit', $food->serving_unit ?? 'g');
          @endphp

          <option value="g" {{ $unit === 'g' ? 'selected' : '' }}>Gram (g)</option>
          <option value="ml" {{ $unit === 'ml' ? 'selected' : '' }}>Milliliter (ml)</option>
          <option value="pcs" {{ $unit === 'pcs' ? 'selected' : '' }}>Piece (pcs)</option>
          <option value="tbsp" {{ $unit === 'tbsp' ? 'selected' : '' }}>Tablespoon (tbsp)</option>
          <option value="tsp" {{ $unit === 'tsp' ? 'selected' : '' }}>Teaspoon (tsp)</option>
          <option value="butir" {{ $unit === 'butir' ? 'selected' : '' }}>Butir (butir)</option>
          <option value="tongkol" {{ $unit === 'tongkol' ? 'selected' : '' }}>Tongkol (tongkol)</option>
          <option value="siung" {{ $unit === 'siung' ? 'selected' : '' }}>Siung (siung)</option>
        </select>
      </div>

      {{-- Density (only for ml) --}}
      <div id="densityWrapper">
        <x-input
          label="Density (g/ml)"
          name="density"
          type="number"
          step="0.0001"
          value="{{ old('density', $food->density ?? '') }}"
        />
        <p class="text-xs text-gray-500 mt-1">
          Required only for volume-based foods (ml).
        </p>
      </div>

    </div>

  </div>

</div>

{{-- =========================
| NUTRITION
========================= --}}
<div class="mt-10 border-t pt-6 space-y-8">

  <h3 class="text-lg font-semibold text-gray-800">
    Nutrition Information
  </h3>

  {{-- MACRONUTRIENTS --}}
  <div>
    <h4 class="font-medium text-gray-700 mb-3">Macronutrients</h4>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
      @foreach([
        'calories_kcal' => 'Calories (kcal)',
        'protein_g' => 'Protein (g)',
        'fat_g' => 'Fat (g)',
        'carbs_g' => 'Carbs (g)',
        'fiber_g' => 'Fiber (g)',
        'sugar_g' => 'Sugar (g)',
        'water_g' => 'Water (g)',
        'alcohol_g' => 'Alcohol (g)',
      ] as $field => $label)

        <x-input
          :label="$label"
          :name="$field"
          type="number"
          step="0.01"
          :value="old($field, $food->nutrition->$field ?? '')"
        />

      @endforeach
    </div>
  </div>

  {{-- FAT DETAIL --}}
  <div>
    <h4 class="font-medium text-gray-700 mb-3">Fat Detail</h4>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
      @foreach([
        'saturated_fat_g' => 'Saturated Fat (g)',
        'monounsaturated_fat_g' => 'Mono Fat (g)',
        'polyunsaturated_fat_g' => 'Poly Fat (g)',
        'trans_fat_g' => 'Trans Fat (g)',
        'cholesterol_mg' => 'Cholesterol (mg)',
      ] as $field => $label)

        <x-input
          :label="$label"
          :name="$field"
          type="number"
          step="0.01"
          :value="old($field, $food->nutrition->$field ?? '')"
        />

      @endforeach
    </div>
  </div>

  {{-- MINERALS --}}
  <div>
    <h4 class="font-medium text-gray-700 mb-3">Minerals</h4>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
      @foreach([
        'sodium_mg' => 'Sodium (mg)',
        'potassium_mg' => 'Potassium (mg)',
        'calcium_mg' => 'Calcium (mg)',
        'iron_mg' => 'Iron (mg)',
        'magnesium_mg' => 'Magnesium (mg)',
        'zinc_mg' => 'Zinc (mg)',
      ] as $field => $label)

        <x-input
          :label="$label"
          :name="$field"
          type="number"
          step="0.01"
          :value="old($field, $food->nutrition->$field ?? '')"
        />

      @endforeach
    </div>
  </div>

  {{-- VITAMINS --}}
  <div>
    <h4 class="font-medium text-gray-700 mb-3">Vitamins</h4>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
      @foreach([
        'vitamin_a_mcg' => 'Vitamin A (mcg)',
        'vitamin_b1_mg' => 'Vitamin B1 (mg)',
        'vitamin_b2_mg' => 'Vitamin B2 (mg)',
        'vitamin_b3_mg' => 'Vitamin B3 (mg)',
        'vitamin_b6_mg' => 'Vitamin B6 (mg)',
        'vitamin_b12_mcg' => 'Vitamin B12 (mcg)',
        'vitamin_c_mg' => 'Vitamin C (mg)',
        'vitamin_d_mcg' => 'Vitamin D (mcg)',
        'vitamin_e_mg' => 'Vitamin E (mg)',
        'vitamin_k_mcg' => 'Vitamin K (mcg)',
        'folate_mcg' => 'Folate (mcg)',
      ] as $field => $label)

        <x-input
          :label="$label"
          :name="$field"
          type="number"
          step="0.01"
          :value="old($field, $food->nutrition->$field ?? '')"
        />

      @endforeach
    </div>
  </div>

</div>
