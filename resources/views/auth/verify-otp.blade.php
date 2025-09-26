<x-guest-layout>
    <h2 class="h5 fw-bold mb-4">Verify OTP</h2>

    @if (session('status'))
        <div class="alert alert-success mb-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verify.otp.post') }}">
        @csrf

        <div class="mb-3">
            <label for="otp_code" class="form-label">{{ __('Enter OTP Code') }}</label>
            <input id="otp_code" type="text"
                   class="form-control @error('otp_code') is-invalid @enderror"
                   name="otp_code" required autofocus>

            @error('otp_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary w-100">
                {{ __('Verify') }}
            </button>
        </div>
    </form>
</x-guest-layout>
