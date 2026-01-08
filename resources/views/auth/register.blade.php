<x-layout title="Register">
  <x-auth-card>
    <x-auth-title>Register</x-auth-title>

    <x-form action="/register">
      <x-input label="Name" name="name" />
      <x-input label="Email" name="email" type="email" />
      <x-input label="Password" name="password" type="password" />
      <x-input label="Confirm Password" name="password_confirmation" type="password" />

      <x-button type="submit" class="w-full mt-4">
        Register
      </x-button>
    </x-form>

    <p class="mt-4 text-sm text-center text-gray-600">
      Sudah punya akun?
      <a href="/login" class="text-indigo-600 hover:underline">
        Login
      </a>
    </p>
  </x-auth-card>
</x-layout>
