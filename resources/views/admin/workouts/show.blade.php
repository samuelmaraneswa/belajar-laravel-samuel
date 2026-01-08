<x-admin-layout class="mb-10">
  
  <x-admin.page-title :title="$workout->title" />

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-6">
    <div class="bg-gray-200 rounded-lg overflow-hidden">
      <img src="{{ asset('storage/' . $workout->image) }}" alt="{{ $workout->title }}" class="w-full max-h-80 object-contain">
    </div>

    @if ($workout->video)
      <div class="bg-gray-200 rounded-lg overflow-hidden">
        <video controls autoplay muted class="w-full max-h-80 object-contain">
        <source src="{{ asset('storage/' . $workout->video) }}" type="video/mp4">
        Browser tidak mendukung video.
      </video>
      </div>
    @endif
  </div>

  <p class="text-gray-700 leading-relaxed indent-5">{{ $workout->description }}</p>

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

  <script>
    window.muscles = {
      primary: @json($workout->muscles->where('pivot.role', 'primary')->pluck('slug')),
      secondary: @json($workout->muscles->where('pivot.role', 'secondary')->pluck('slug')),
    }

    window.workoutMeta = {
      type: 'machine' // atau 'bodyweight'
    } 
  </script>

</x-admin-layout>