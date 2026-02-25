<x-user.layout>
  <form id="wizardForm"
        method="POST"
        action="{{ route('user.programs.store') }}"
        class="max-w-md mx-auto space-y-6">
    @csrf

    @if (session('error'))
      <div id="programError" class="p-3 text-sm text-red-700 bg-red-100 rounded">
        {{ session('error') }}
      </div>
    @endif

    {{-- HIDDEN STATE --}}
    <input type="hidden" name="goal">
    <input type="hidden" name="context">
    <input type="hidden" name="gender">
    <input type="hidden" name="age">
    <input type="hidden" name="height">
    <input type="hidden" name="weight">
    <input type="hidden" name="target_weight">
    <input type="hidden" name="level">

    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-sm">
      <p class="text-center font-semibold text-blue-800 mb-2">
        🚀 Fitur yang masih tersedia:
      </p>
      <p class="text-center text-sm -mt-1">Goal: <strong>Muscle Gain</strong>, Place: <strong>Gym</strong>, Gender: <strong>Male/Female</strong>, Age: <strong>18 - 35</strong>, Height: <strong>155 - 175</strong>, Weight: <strong>55 - 70</strong>, Target Weight: <strong>65 - 85</strong>, Level: <strong>Beginner</strong></p>
    </div>
    
    {{-- STEP 1 : GOAL --}}
    <section data-step="goal">
      <h1 class="text-2xl font-bold text-center mb-6">What is your goal?</h1>
      <div class="grid gap-4">
        <button type="button" data-value="fat_loss" data-disabled="1" class="wizard-option">Fat Loss</button>
        <button type="button" data-value="muscle_gain" class="wizard-option">Muscle Gain</button>
        <button type="button" data-value="calisthenics" data-disabled="1" class="wizard-option">Calisthenics</button>
        <button type="button" data-value="endurance" data-disabled="1" class="wizard-option">Endurance</button>
      </div>
    </section>

    {{-- STEP 2 : CONTEXT --}}
    <section data-step="context" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-6">Where will you train?</h1>
      <div class="grid gap-4">
        <button type="button" data-value="gym" class="wizard-option">Gym</button>
        <button type="button" data-value="home" data-disabled="1" class="wizard-option">Home</button>
        <button type="button" data-value="calisthenics" data-disabled="1" class="wizard-option">Calisthenics</button>
      </div>
    </section>

    {{-- STEP 3 : GENDER --}}
    <section data-step="gender" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-6">Your gender</h1>
      <div class="grid grid-cols-2 gap-4">
        <button type="button" data-value="male" class="wizard-option">Male</button>
        <button type="button" data-value="female" class="wizard-option">Female</button>
      </div>
    </section>

    {{-- STEP 4 : AGE --}}
    <section data-step="age" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-4">Your age</h1>
      <p class="text-sm text-gray-500 text-center mb-2"> Age range: 13–70 years </p>
      <input type="number" class="wizard-input" data-input="age" placeholder="Age (years)">
      <button type="button" class="wizard-next">Continue</button>
    </section>

    {{-- STEP 5 : HEIGHT --}}
    <section data-step="height" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-4">Your height</h1>
      <p class="text-sm text-gray-500 text-center mb-2"> Height range: 120–220 cm </p>
      <input type="number" class="wizard-input" data-input="height" placeholder="Height (cm)">
      <button type="button" class="wizard-next">Continue</button>
    </section>

    {{-- STEP 6 : CURRENT WEIGHT --}}
    <section data-step="weight" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-4">Your current weight</h1>
      <p class="text-sm text-gray-500 text-center mb-2"> Weight range: 30–200 kg </p>
      <input type="number" class="wizard-input" data-input="weight" placeholder="Weight (kg)">
      <button type="button" class="wizard-next">Continue</button>
    </section>

    {{-- STEP : TARGET WEIGHT --}}
    <section data-step="target_weight" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-4">
        Target weight
      </h1>
      <input type="number" class="wizard-input" data-input="target_weight" placeholder="Target weight (kg)">
      <button type="button" class="wizard-next">Continue</button>
    </section>

    {{-- STEP 7 : LEVEL --}}
    <section data-step="level" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-6">Your level</h1>
      <div class="grid gap-4">
        <button type="button" data-value="beginner" class="wizard-option">Beginner</button>
        <button type="button" data-value="intermediate" class="wizard-option">Intermediate</button>
        <button type="button" data-value="advanced" class="wizard-option">Advanced</button>
      </div>
    </section>

  </form>

  @vite('resources/js/programs/generateWizard.js')
</x-user.layout>
