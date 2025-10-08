<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFA Verification</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Center everything vertically and horizontally */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Wrap logo and card together for proper alignment */
        .mfa-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px; /* space between logo and card */
            max-width: 400px;
        }

        .otp-input-group {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 24px 0;
        }
        .otp-input {
            width: 50px;
            height: 60px;
            font-size: 24px;
            text-align: center;
            border: 2px solid #ced4da;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .otp-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .otp-input.error {
            border-color: #dc3545;
        }
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            width: 100%;
        }
        .card-header {
            background: #f8f9fa;
            border-bottom: none;
            padding: 24px 24px 0;
        }
        .btn-primary {
            padding: 10px;
            font-weight: 600;
            border-radius: 8px;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 0; /* removed extra margin */
        }
        .logo {
            max-width: 180px;
            height: auto;
        }
    </style>
</head>
<body>

<div class="mfa-wrapper">
    <!-- Logo Section -->
    <div class="logo-container">
        <img src="{{ asset('images/bcp.png') }}" alt="BCP Logo" width="90" height="90" class="logo">
    </div>

    <!-- Main MFA Card -->
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h4 class="mb-2">Multi-Factor Authentication</h4>
            <p class="text-muted mb-0">Enter the 6-digit code from your authenticator app</p>
        </div>
        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('mfa.verify') }}" id="mfaForm">
                @csrf
                <div class="otp-input-group">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text"
                               class="otp-input"
                               maxlength="1"
                               inputmode="numeric"
                               pattern="[0-9]"
                               data-index="{{ $i }}"
                               autocomplete="off"
                               aria-label="Digit {{ $i + 1 }} of 6">
                    @endfor
                </div>

                <!-- Hidden field to submit the full OTP -->
                <input type="hidden" id="otp_code" name="otp_code" required>

                <button type="submit" class="btn btn-primary w-100 mt-2" id="verifyBtn">
                    Verify Code
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.otp-input');
    const hiddenInput = document.getElementById('otp_code');
    const form = document.getElementById('mfaForm');
    const verifyBtn = document.getElementById('verifyBtn');

    if (inputs.length > 0) {
        inputs[0].focus();
    }

    inputs.forEach((input, index) => {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateHiddenInput();
        });

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && !this.value && index > 0) {
                inputs[index - 1].focus();
            }
        });

        input.addEventListener('paste', function (e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text');
            const digits = paste.replace(/[^0-9]/g, '').substring(0, 6);
            if (digits) {
                digits.split('').forEach((digit, i) => {
                    if (inputs[i]) inputs[i].value = digit;
                });
                const lastFilled = Math.min(digits.length - 1, inputs.length - 1);
                inputs[lastFilled].focus();
                updateHiddenInput();
            }
        });
    });

    function updateHiddenInput() {
        const fullCode = Array.from(inputs).map(input => input.value).join('');
        hiddenInput.value = fullCode;
        verifyBtn.disabled = fullCode.length !== 6;
    }

    form.addEventListener('submit', function (e) {
        const fullCode = hiddenInput.value;
        if (fullCode.length !== 6) {
            e.preventDefault();
            inputs.forEach(input => input.classList.add('error'));
            setTimeout(() => inputs.forEach(input => input.classList.remove('error')), 2000);
            return false;
        }
    });
});
</script>

</body>
</html>