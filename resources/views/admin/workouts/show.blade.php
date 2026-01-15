<x-admin-layout class="mb-10">
  
  <x-admin.page-title :title="Str::title($workout->title)" />

  {{-- Anchor Menu --}}
  <nav data-anchor-menu class="sticky top-14 pt-2 bg-white z-30 mt-3 -mx-5 px-5">
    <div class="flex gap-6">
      <a href="#description" data-anchor-link class="anchor-link">Deskripsi</a>
      <a href="#instructions" data-anchor-link class="anchor-link">Instruksi</a>
      <a href="#sets-reps" data-anchor-link class="anchor-link">Sets & Reps</a>
      <a href="#similar" data-anchor-link class="anchor-link">Similar</a>
    </div>
  </nav>

  {{-- Section Description Start --}}
  <section id="description" class="scroll-mt-24 mt-7">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
      
      {{-- Gif --}}
      @if ($workout->gif)
      <div class="bg-gray-100 rounded-lg overflow-hidden">
        <img src="{{asset('storage/' . $workout->gif)}}" alt="{{$workout->title}} animation" class="w-full object-contain">
      </div>
      @endif
      
      {{-- Description --}}
      <div>
        <h2 class="text-lg font-bold text-gray-800 mb-2">Deskripsi</h2>
        
        <p class="text-gray-700 leading-relaxed mb-4">
          {{ $workout->description }}
        </p>
        
        {{-- META INFO --}}
        <div class="flex flex-wrap gap-2 text-sm">
          
          {{-- Difficulty --}}
          @if ($workout->difficulty)
            <span
            class="inline-flex items-center px-3 py-1 rounded-full
            bg-gray-200 text-gray-800 font-medium">
            Difficulty: {{ Str::title($workout->difficulty) }}
          </span>
          @endif
        
          {{-- Equipments --}}
          @if ($workout->equipments->count())
            @foreach ($workout->equipments as $equipment)
            <span
              class="inline-flex items-center px-3 py-1 rounded-full
              bg-gray-200 text-gray-800 font-medium">
              Equipments: {{ Str::title($equipment->name) }}
            </span>
            @endforeach
          @endif
        </div>
      </div>
    </div>

    {{-- Target Muscles Worked Start --}}
    <p class="text-xl font-bold text-gray-600 mt-8">Target muscles worked</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4 items-start">
      {{-- left --}}
      <div class="flex justify-center">
        <div class="max-w-xs">
          @include('svg.body-map-front')
        </div>
      </div>
      
      {{-- center --}}
      <div class="flex justify-center">
        <div class="max-w-xs">
          @include('svg.body-map-back')
        </div>
      </div>

      {{-- Muscles List --}}
      <div>
        <h3 class="font-semibold text-gray-800 mb-2 underline text-lg">Primary Muscle</h3>
        <ul class="mb-4 space-y-1 text-red-500">
          @foreach ($workout->muscles->where('pivot.role','primary') as $m)
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-circle text-[10px]"></i> 
            <span class="font-bold">{{$m->name}}</span>
          </li>
          @endforeach
        </ul>
        
        <h3 class="font-semibold text-gray-800 mb-2 underline text-lg">Secondary Muscle</h3>
        <ul class="mb-4 space-y-1 text-green-500">
          @forelse ($workout->muscles->where('pivot.role','secondary') as $m)
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-circle text-[10px]"></i> 
            <span class="font-bold">{{$m->name}}</span>
          </li>
          @empty
          <p class="text-gray-800">None</p>
          @endforelse
        </ul>
      </div>
    </div>
    {{-- Target Muscles Worked End --}}
  </section>
  {{-- Section Description End --}}

  {{-- Instructions Start --}}
  <section id="instructions" class="my-8">

    {{-- TITLE --}}
    <h2 class="text-lg font-bold text-gray-800 mb-4">
      Instruksi
    </h2>

    {{-- IMAGE --}}
    <div class="bg-gray-200 rounded-lg overflow-hidden mb-6 h-80">
      <img
        src="{{ asset('storage/' . $workout->image) }}"
        alt="{{ $workout->title }}"
        class="w-full h-full object-contain"
      >
    </div>

    {{-- STEP BY STEP --}}
    <ol class="space-y-3 mb-6">
      @foreach ($workout->instructions as $step)
        <li class="flex gap-3">
          <span
            class="shrink-0 w-7 h-7 rounded-full
                  bg-gray-800 text-white text-sm
                  flex items-center justify-center font-semibold">
            {{ $step->step }}
          </span>

          <p class="text-gray-700 leading-relaxed">
            {{ $step->instruction }}
          </p>
        </li>
      @endforeach
    </ol>

    {{-- VIDEO (OPTIONAL) --}}
    @if ($workout->video)
      <div class="bg-gray-200 rounded-lg overflow-hidden h-80">
        <video controls muted class="w-full h-full object-contain">
          <source src="{{ asset('storage/' . $workout->video) }}" type="video/mp4">
          Browser tidak mendukung video.
        </video>
      </div>
    @endif

  </section>
  {{-- Instructions End --}}

  {{-- Sets & Reps Start --}}
  <section id="sets-reps" class="my-8">
    <h3 class="text-xl font-bold mt-8 mb-4 text-gray-600">Training Recommendation</h3>
  
    <x-form action="{{route('admin.workout.calculate', $workout)}}" id="calculateForm" >
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- left : input form --}}
        <div class="border rounded-lg p-5 bg-gray-50">
          <div class="grid grid-cols-2 gap-4">
            
            <div>
              <x-select label="Gender" name="gender" :options="['male' => 'Male', 'female' => 'Female']" placeholder="Gender" :unstyled="true" class="w-3/4 rounded-lg border border-gray-300 text-sm p-2" />
                <p class="text-xs text-red-500 mt-1 hidden" data-error="gender">
                Enter a valid value
              </p>
            </div> 
            
            <div>
              <x-input :unstyled="true" label="Age" name="age" type="number" placeholder="Your age" class="border border-gray-300 p-2 text-sm w-3/4 rounded-lg" autocomplete="off" />
              <p class="text-xs text-red-500 mt-1 hidden" data-error="age">
                Enter a valid value
              </p>
            </div>
            
            <div>
              <x-input :unstyled="true" label="Weight" name="weight" type="number" placeholder="Weight in kg" class="border border-gray-300 p-2 text-sm w-3/4 rounded-lg" autocomplete="off" />
              <p class="text-xs text-red-500 mt-1 hidden" data-error="weight">
                Enter a valid value
              </p>
            </div>
            
            <div>
              <x-input :unstyled="true" label="Height" name="height" type="number" placeholder="Height in cm" class="border border-gray-300 p-2 text-sm w-3/4 rounded-lg" autocomplete="off" />
              <p class="text-xs text-red-500 mt-1 hidden" data-error="height">
                Enter a valid value
              </p>
            </div>
            
            <x-button type="submit" class="col-span-2 w-2/4 bg-gray-300 mx-auto">Calculate</x-button>
          </div>
        </div>
        
        {{-- RIGHT : RESULT --}}
        <div id="calculateResult" class="border rounded-lg p-5 text-sm text-gray-500">
          Fill the form and click <b>Calculate</b>.
        </div>
      </div>
    </x-form>
  </section>
  {{-- Sets & Reps End --}}

  {{-- Similar Start --}}
  <section id="similar" class="mt-10">
    <h2 class="text-lg font-bold text-gray-800 mb-4">
      Similar Workouts
    </h2>

    @include('admin.workouts._cards', [
      'workouts' => $similarWorkouts
    ])
  </section>
  {{-- Similar End --}}

  <script>
    window.muscles = {
      primary: @json($workout->muscles->where('pivot.role', 'primary')->pluck('slug')),
      secondary: @json($workout->muscles->where('pivot.role', 'secondary')->pluck('slug')),
    }
    
    window.workoutMeta = {
      type: '{{ $workout->type }}',              // machine | bodyweight | dumbbell | barbell
      movement: '{{ $workout->movement }}',      // compound | isolation
      difficulty: {{ $workout->difficulty }},    // contoh: 1, 0.7, 0.35
    } 
    </script>

</x-admin-layout>