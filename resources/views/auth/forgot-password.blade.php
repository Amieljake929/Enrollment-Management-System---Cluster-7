<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-4">
        <div class="w-100" style="max-width: 480px;">
            <!-- Card -->
            <div class="bg-white p-4 p-md-5 shadow-sm rounded">
                <div class="text-center mb-4">
                    <h2 class="h4 fw-bold text-primary">Forgot Password?</h2>
                    <p class="text-muted small mb-0">
                        Enter your email to receive a password reset link.
                    </p>
                </div>

                <div class="mb-4 text-center text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus>

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>