<x-guest-layout>
    <h2 class="text-lg font-bold mb-4">Verify OTP</h2>

    @if (session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('verify.otp.post') }}">
        @csrf

        <div>
            <x-input-label for="otp_code" :value="__('Enter OTP Code')" />
            <x-text-input id="otp_code" type="text" name="otp_code" required autofocus />
            <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button>Verify</x-primary-button>
        </div>
    </form>
</x-guest-layout>
