<x-layout title="Verify Email">
  <x-auth-card>
    <x-auth-title>Verifikasi Email</x-auth-title>

    <p class="text-sm text-gray-600 mb-4">
      Kami sudah mengirim link verifikasi ke email Anda.
      Silakan cek inbox (atau spam).
    </p>

    @if (session('success'))
      <p class="text-sm text-green-600 mb-2">
        {{ session('success') }}
      </p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <x-button type="submit" class="w-full">
        Kirim Ulang Email Verifikasi
      </x-button>
    </form>
  </x-auth-card>
</x-layout>
