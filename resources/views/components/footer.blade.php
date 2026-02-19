<footer class="bg-black text-white">
    
    <div class="max-w-7xl mx-auto px-6 pt-12 pb-4">

        <div class="grid md:grid-cols-3 gap-12 text-center items-start">

            {{-- LEFT : ABOUT --}}
            <div>
                <h3 class="text-xl font-semibold mb-4">About</h3>
                <p class="text-sm text-gray-300 leading-loose max-w-sm mx-auto">
                    I built this platform to challenge myself and commit to changing my life — and hopefully inspire others to do the same.
                    I hope it reaches people who want to grow together.
                    This website is dedicated to fitness, gym training, and healthy living.
                </p>
            </div>

            {{-- CENTER : BRAND --}}
            <div>
              <a href="/" class="inline-block group">
                  <h2 class="text-3xl font-bold tracking-wide mb-6">
                      MaskWorkout
                  </h2>

                  <div class="flex justify-center">
                      <img 
                          src="{{ asset('images/logo.png') }}" 
                          alt="Logo"
                          class="h-40 md:h-52 w-auto object-contain"
                      >
                  </div>
              </a>
            </div>

            {{-- RIGHT : CONTACT --}}
            <div>
                <h3 class="text-xl font-semibold mb-4">Get in touch</h3>

                <div class="flex items-center justify-center gap-3 mb-4">
                    <i class="fa-brands fa-whatsapp text-xl"></i>
                    <span class="text-sm">082169956714</span>
                </div>

                <a href="#" class="text-sm text-gray-300 hover:text-white underline">
                    About Author
                </a>
            </div>

        </div>

        <x-hr  />

        {{-- Bottom --}}
        <div class="mt-2 text-center text-xs text-gray-500">
            © {{ date('Y') }} MaskWorkout. All rights reserved.
        </div>

    </div>

</footer>
