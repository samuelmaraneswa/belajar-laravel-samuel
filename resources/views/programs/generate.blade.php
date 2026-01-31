<x-user.layout>
  <form id="wizardForm"
        method="POST"
        action="{{ route('program.generate.store') }}"
        class="max-w-md mx-auto mt-16 space-y-12">
    @csrf

    {{-- HIDDEN STATE --}}
    <input type="hidden" name="goal">
    <input type="hidden" name="context">
    <input type="hidden" name="gender">
    <input type="hidden" name="age">
    <input type="hidden" name="height">
    <input type="hidden" name="weight">
    <input type="hidden" name="level">

    {{-- STEP 1 : GOAL --}}
    <section data-step="goal">
      <h1 class="text-2xl font-bold text-center mb-6">What is your goal?</h1>
      <div class="grid gap-4">
        <button type="button" data-value="fat_loss" class="wizard-option">Fat Loss</button>
        <button type="button" data-value="muscle_gain" class="wizard-option">Muscle Gain</button>
        <button type="button" data-value="calisthenics" class="wizard-option">Calisthenics</button>
        <button type="button" data-value="endurance" class="wizard-option">Endurance</button>
      </div>
    </section>

    {{-- STEP 2 : CONTEXT --}}
    <section data-step="context" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-6">Where will you train?</h1>
      <div class="grid gap-4">
        <button type="button" data-value="gym" class="wizard-option">Gym</button>
        <button type="button" data-value="home" class="wizard-option">Home</button>
        <button type="button" data-value="calisthenics" class="wizard-option">Calisthenics</button>
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
      <h1 class="text-2xl font-bold text-center mb-6">Your age</h1>
      <input type="number" class="wizard-input" data-input="age" placeholder="Age (years)">
      <button type="button" class="wizard-next">Continue</button>
    </section>

    {{-- STEP 5 : HEIGHT --}}
    <section data-step="height" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-6">Your height</h1>
      <input type="number" class="wizard-input" data-input="height" placeholder="Height (cm)">
      <button type="button" class="wizard-next">Continue</button>
    </section>

    {{-- STEP 6 : WEIGHT --}}
    <section data-step="weight" class="hidden">
      <h1 class="text-2xl font-bold text-center mb-6">Your weight</h1>
      <input type="number" class="wizard-input" data-input="weight" placeholder="Weight (kg)">
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
</x-user.layout>
