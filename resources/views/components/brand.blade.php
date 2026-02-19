<a href="/" class="flex items-center h-full">
    <img 
        src="{{ asset('images/logo.png') }}" 
        alt="Logo"
        class="h-12 sm:h-16 w-auto object-contain"
    >

    {{-- Mobile: Workout saja --}}
    <span class="ml-1 font-bold text-lg text-gray-600 sm:hidden">
        Workout
    </span>

    {{-- Desktop: MaskWorkout --}}
    <span class="ml-1 sm:ml-2 font-bold text-lg text-gray-600 hidden sm:inline">
        {{ trim($slot) !== '' ? $slot : 'MaskWorkout' }}
    </span>
    
</a>
