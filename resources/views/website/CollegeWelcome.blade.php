@extends('layouts.assessment')

@section('content')
<style>
    /* ===== GLOBAL STYLES ===== */
    :root {
        --primary: #27ae60;
        --secondary: #8e44ad;
        --accent: #9b59b6;
        --dark-bg: #0d0c22;
        --card-bg: rgba(30, 29, 50, 0.85);
        --text-light: #ffffff;
        --text-muted: #bdc3c7;
        --border-glow: rgba(155, 89, 182, 0.3);
        --hover-glow: rgba(155, 89, 182, 0.2);
        --purple-glow: rgba(142, 68, 173, 0.4);
        --success-glow: rgba(46, 204, 113, 0.3);
        --star-glow: rgba(255, 255, 255, 0.1);
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-light);
        overflow-x: hidden;
        height: auto !important;
        position: relative;
    }

    /* ===== VIDEO BACKGROUND ===== */
    .video-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
    }



    /* ===== NAVBAR ===== */
    .navbar-custom {
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        padding: 1rem 2rem;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .navbar-brand {
        font-weight: 700;
        color: var(--text-light);
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 10px;
        text-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
    }

    .nav-link {
        color: var(--text-light);
        font-weight: 500;
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        letter-spacing: 0.5px;
    }

    .nav-link:hover {
        background: var(--border-glow);
        color: white;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 0 15px rgba(155, 89, 182, 0.5);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: var(--accent);
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 60%;
    }

    /* ===== FLOATING ELEMENTS (STICKERS) ===== */
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    .floating-element {
        position: absolute;
        animation: float 12s ease-in-out infinite;
        filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.4));
        z-index: 1;
        opacity: 0.7;
        transition: transform 0.5s ease;
        font-size: 2.5rem;
    }

    .floating-element:hover {
        opacity: 1;
        transform: scale(1.1) rotate(10deg) !important;
        filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.7));
    }

    .floating-element:nth-child(1) {
        top: 10%;
        left: 5%;
        animation-delay: 0s;
        transform: rotate(-10deg);
    }

    .floating-element:nth-child(2) {
        top: 25%;
        right: 8%;
        animation-delay: -5s;
        transform: rotate(15deg);
    }

    .floating-element:nth-child(3) {
        bottom: 15%;
        left: 20%;
        animation-delay: -9s;
        transform: rotate(-5deg);
    }

    .floating-element:nth-child(4) {
        top: 45%;
        left: 30%;
        animation-delay: -7s;
        transform: rotate(10deg);
    }

    .floating-element:nth-child(5) {
        bottom: 10%;
        right: 20%;
        animation-delay: -3s;
        transform: rotate(-15deg);
    }

    @keyframes float {
        0% { transform: translate(0px, 0px) rotate(0deg); }
        50% { transform: translate(20px, -20px) rotate(5deg); }
        100% { transform: translate(0px, 0px) rotate(0deg); }
    }

    /* ===== FORM CONTAINER ===== */
    .form-container {
        max-width: 600px;
        margin: 120px auto 60px;
        background: var(--card-bg);
        backdrop-filter: blur(16px);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.15);
        position: relative;
        overflow: hidden;
        animation: pulseGlow 3s ease-in-out infinite alternate;
        z-index: 5;
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, transparent, var(--purple-glow) 25%, transparent 50%);
        opacity: 0.4;
        animation: rotateGlow 12s linear infinite;
        z-index: -1;
    }

    .form-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-align: center;
        color: var(--text-light);
        animation: fadeInUp 0.8s ease-out;
    }

    .welcome-message {
        font-size: 1.3rem;
        color: var(--text-light);
        margin-bottom: 25px;
        text-align: center;
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    /* ===== STEP BOX ===== */
    .step-box {
        background: rgba(52, 152, 219, 0.15);
        border: 1px solid rgba(52, 152, 219, 0.3);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 25px;
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }

    .step-box h5 {
        color: #3498db;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .step-box p {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* ===== INTEREST OPTIONS ===== */
    .interest-option {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 14px;
        padding: 14px 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .interest-option:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .interest-option.selected {
        background: rgba(155, 89, 182, 0.2);
        border-color: var(--accent);
        box-shadow: 0 0 15px var(--border-glow);
        animation: pulseSelect 0.5s ease-in-out;
    }

    @keyframes pulseSelect {
        0% { transform: scale(1); }
        50% { transform: scale(1.03); }
        100% { transform: scale(1); }
    }

    .interest-checkbox {
        opacity: 0;
        position: absolute;
    }

    .checkmark {
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        position: relative;
        z-index: 2;
    }

    .interest-option.selected .checkmark {
        background: var(--accent);
        border-color: var(--accent);
    }

    .interest-option.selected .checkmark::after {
        content: '✓';
        color: white;
        font-size: 12px;
        font-weight: bold;
    }

    .interest-label {
        flex: 1;
        color: var(--text-light);
        font-weight: 500;
        user-select: none;
        transition: color 0.2s ease;
    }

    .interest-option.selected .interest-label {
        color: white;
    }

    /* ===== PROCEED BUTTON ===== */
    .btn-proceed {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        border: none;
        border-radius: 16px;
        padding: 16px 24px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(46, 204, 113, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        margin-top: 20px;
    }

    .btn-proceed:hover {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 25px rgba(46, 204, 113, 0.5);
    }

    .btn-proceed:disabled {
        background: rgba(255, 255, 255, 0.1);
        cursor: not-allowed;
        box-shadow: none;
        transform: none;
    }

    /* ===== ERROR MESSAGE ===== */
    .alert-danger-custom {
        background: rgba(231, 76, 60, 0.15);
        border: 1px solid rgba(231, 76, 60, 0.3);
        border-radius: 12px;
        padding: 12px;
        margin-top: 15px;
        color: #e74c3c;
        display: none;
        animation: fadeIn 0.3s ease;
    }

    .alert-danger-custom.show {
        display: block;
    }

    /* ===== REMINDERS BOX ===== */
    .reminders-box {
        background: rgba(241, 196, 15, 0.1);
        border: 1px solid rgba(241, 196, 15, 0.3);
        border-radius: 16px;
        padding: 20px;
        margin-top: 30px;
        animation: fadeInUp 0.8s ease-out 0.6s both;
    }

    .reminders-box h5 {
        color: #f1c40f;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .reminders-box ul {
        padding-left: 20px;
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .reminders-box li {
        margin-bottom: 8px;
    }

    /* ===== FOOTER ===== */
    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(13, 12, 34, 0.8);
        backdrop-filter: blur(10px);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 15px 20px;
        text-align: center;
        z-index: 1000;
        box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.8s ease-out;
    }

    footer p {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin: 0;
    }

    footer a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    footer a:hover {
        color: white;
        text-decoration: underline;
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes rotateGlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes pulseGlow {
        from { box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6); }
        to { box-shadow: 0 20px 60px rgba(155, 89, 182, 0.3); }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .form-container {
            padding: 30px 20px;
            margin: 100px 10px 40px;
        }
        .navbar-custom {
            padding: 0.8rem 1rem;
        }
        .nav-link {
            padding: 0.5rem 0.8rem;
            font-size: 0.9rem;
        }
        .interest-option {
            padding: 12px;
            font-size: 0.95rem;
        }
        .floating-element {
            font-size: 2rem;
        }
    }
</style>

<!-- ===== VIDEO BACKGROUND ===== -->
<video class="video-bg" autoplay muted loop playsinline>
    <source src="{{ asset('images/educational.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
</video>
<div class="overlay"></div>

<!-- ===== FLOATING 3D ICONS (STICKERS) ===== -->
<div class="floating-elements">
    <div class="floating-element">🧠</div>
    <div class="floating-element">🚀</div>
    <div class="floating-element">📚</div>
    <div class="floating-element">🎯</div>
    <div class="floating-element">💡</div>
</div>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-custom" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1v-1a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1V6a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1v2a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h2a1 1 0 0 0 1 1z"/>
            </svg>
            AI Course Suggestion
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Assessment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">AI Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ===== WELCOME CONTAINER ===== -->
<div class="form-container">
    <h3 class="form-title">Welcome to Our Assessment Test!</h3>
    
    <div class="welcome-message">
        👋 Welcome, <strong>{{ $data['name'] }}</strong>!
    </div>

    <div class="step-box">
        <h5>Step 1: Select Your Interests</h5>
        <p><strong>Choose at least 2 categories</strong> that best represent your interests. The quiz questions will be tailored based on your selection.</p>
    </div>

    <form id="interestForm">
        @csrf
        <div class="row g-3 mb-3">
            @php
                $categories = [
                    'science & technology' => 'Science & Technology',
                    'business & management' => 'Business & Management',
                    'education & teaching' => 'Education & Teaching',
                    'arts_communication_library' => 'Arts, Communication & Library',
                    'social & public services' => 'Social & Public Services',
                    'hospitality_tourism_service' => 'Hospitality, Tourism & Service Industry'
                ];
            @endphp

            @foreach($categories as $key => $label)
                <div class="col-md-6">
                    <label class="interest-option" for="interest_{{ $loop->index }}">
                        <input type="checkbox" class="interest-checkbox" name="interests[]" value="{{ $key }}" id="interest_{{ $loop->index }}">
                        <span class="checkmark"></span>
                        <span class="interest-label">{{ $label }}</span>
                    </label>
                </div>
            @endforeach
        </div>

        <div id="error-message" class="alert-danger-custom">
            Please select at least 2 interest categories.
        </div>

        <button type="submit" id="proceedBtn" class="btn-proceed" disabled>
            Proceed to Quiz ➡️
        </button>
    </form>

    <div class="reminders-box">
        <h5>Ready? Here are a few reminders before you start the quiz:</h5>
        <ul>
            <li><strong>Questions will be shown based on your selected interests.</strong></li>
            <li><strong>Rate each statement honestly</strong> using: Very Interested (5), Slightly Interested (4), Interested (3), Not Interested (2).</li>
            <li><strong>Make sure you're in a stable internet connection area</strong> to avoid any interruptions.</li>
        </ul>
        <p><strong>Good luck!</strong> 🍀</p>
    </div>
</div>

<!-- ===== FOOTER ===== -->
<footer>
    <p>© 2025 AI College Hub | Designed with 💖 by <a href="#">Your Team</a></p>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.interest-checkbox');
    const proceedBtn = document.getElementById('proceedBtn');
    const errorMessage = document.getElementById('error-message');

    // Update visual selection
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.closest('.interest-option');
            if (this.checked) {
                label.classList.add('selected');
            } else {
                label.classList.remove('selected');
            }
            validateSelection();
        });
    });

    function validateSelection() {
        const checked = document.querySelectorAll('.interest-checkbox:checked');
        if (checked.length >= 2) {
            proceedBtn.disabled = false;
            errorMessage.classList.remove('show');
        } else {
            proceedBtn.disabled = true;
            errorMessage.classList.add('show');
        }
    }

    document.getElementById('interestForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const checked = document.querySelectorAll('.interest-checkbox:checked');
        if (checked.length < 2) {
            errorMessage.classList.add('show');
            return;
        }

        const formData = new FormData(this);
        fetch("{{ route('college.interests.submit') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('college.quiz.show') }}";
            }
        })
        .catch(error => {
            alert('Something went wrong. Please try again.');
        });
    });
});
</script>
@endsection