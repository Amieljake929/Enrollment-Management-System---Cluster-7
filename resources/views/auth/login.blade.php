<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestlink College Of the Philippines</title>
    <link rel="icon" href="{{ asset('images/logo300.png') }}">
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .main-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: 100%;
        }
        .login-form-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            padding: 2rem;
            order: 1;
        }
        .login-form-wrapper {
            width: 100%;
            max-width: 380px;
        }
        .branding-container {
            display: none;
        }
        .btn-custom-login {
            background-color: #5044e4;
            border: none;
            color: white;
            padding: 0.75rem;
            width: 100%;
            font-size: 1rem;
            border-radius: 2rem;
            transition: background-color 0.3s;
            font-weight: 700;
        }
        .btn-custom-login:hover {
            background-color: #3f38b7;
        }
        .form-control {
            border-radius: 0.5rem;
        }
        .form-control:focus {
            border-color: #5044e4;
            box-shadow: 0 0 0 0.25rem rgba(98, 89, 202, 0.25);
        }
        .invalid-feedback {
            font-size: .875em;
        }
        .fw-bold {
            font-weight: 700 !important;
        }
        .password-wrapper {
            position: relative;
        }
        .password-wrapper .form-control {
            padding-right: 2.5rem;
        }
        #togglePassword {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        @media (min-width: 992px) {
            .main-container {
                flex-direction: row;
            }
            .login-form-container {
                width: 50%;
                justify-content: flex-end;
                padding-right: 4rem;
                order: 1;
            }
            .branding-container {
                width: 50%;
                color: white;
                display: flex;
                align-items: flex-start;
                justify-content: center;
                flex-direction: column;
                text-align: left;
                position: relative;
                background-image: url("{{ asset('images/branding.png') }}");
                background-size: cover;
                background-position: center;
                order: 2;
                padding-left: 4rem;
            }
            .branding-container h1 {
                font-size: 3.5rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
            }
            .branding-container p {
                margin-top: 0.5rem;
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Login Form Section -->
        <div class="login-form-container">
            <div class="login-form-wrapper">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/bcp.png') }}" alt="Logo" style="width: 130px;">
                    <h2 class="mt-3 fw-bold">Sign in</h2>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-3">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Username <span class="text-danger">*</span></label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus autocomplete="username">

                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="password-wrapper">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>

                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    

                    <!-- Forgot Password & Submit -->
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <button type="submit" class="btn btn-custom-login">
                            {{ __('Sign in') }}
                        </button>
                    </div>

                    <!-- Register Link -->
                    
                </form>
            </div>
        </div>

        <!-- Branding Section (Right Side on Desktop) -->
        <div class="branding-container">
            <h1>School Management<br>System III</h1>
            <p>Enrollment Management System</p>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Toggle the eye icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>