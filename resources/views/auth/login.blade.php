<x-layout title="Login">
  <x-auth-card>
    <x-auth-title>Login</x-auth-title>

    @if ($errors->any())
      <div class="mb-4 text-sm text-red-600 text-center">
        {{$errors->first()}}
      </div>
    @endif

    <x-form action="/login">
      <x-input label="Email" name="email" type="email" />
      <x-input label="Password" name="password" type="password" />

      <x-button type="submit" class="w-full mt-4">Login</x-button>
    </x-form>

    <!-- link register -->
    <p class="mt-4 text-sm text-center text-gray-600">
      Belum punya akun?
      <a href="/register" class="text-indigo-600 hover:underline">
        Daftar di sini
      </a>
    </p>
    
  </x-auth-card>
</x-layout>