<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Personal Information - Bestlink SHS</title>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Lottie Web Component -->
<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
<style>
:root {
    --primary-color: #203B6B;
    --secondary-color: #ffffff;
    --dark-bg: #121a2a;
    --light-bg: #f8f9fa;
    --accent-blue: #4f6ef7;
    --accent-purple: #a051e0;
    --accent-green: #4cd964;
}

body {
    font-family: 'Poppins', sans-serif;
    color: #333;
    background-color: var(--light-bg);
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.nav-link {
    color: var(--primary-color);
    font-weight: 500;
    transition: color 0.3s ease;
}
.nav-link:hover {
    color: var(--accent-blue);
}
.navbar-brand {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
}
footer.bg-dark-custom {
    color: white;
}

.form-container {
    background: white;
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: 0 10px 40px rgba(32, 59, 107, 0.15);
    max-width: 550px;
    width: 100%;
    margin: 0 auto;
    animation: fadeInUp 0.8s ease-out forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-title {
    font-size: 1.6rem;
    color: var(--primary-color);
    font-weight: 700;
    text-align: center;
    margin-bottom: 0.5rem;
}

.welcome-message {
    text-align: center;
    color: #6c757d;
    font-size: 0.95rem;
    margin-bottom: 1rem;
}

.step-box {
    background-color: #f8f9fa;
    border-left: 4px solid var(--accent-blue);
    padding: 0.75rem 1rem;
    border-radius: 0 12px 12px 0;
    margin-bottom: 1rem;
}

.step-box h5 {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 0.25rem;
    font-size: 1rem;
}

.step-box p {
    color: #6c757d;
    font-size: 0.85rem;
    line-height: 1.4;
}

.interest-option {
    background: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 0.75rem;
}

.interest-option:hover {
    border-color: var(--accent-blue);
    background: #edf2ff;
}

.interest-option.selected {
    background: #eef4ff;
    border-color: var(--accent-blue);
    box-shadow: 0 0 0 3px rgba(79, 110, 247, 0.15);
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #ced4da;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.interest-option.selected .checkmark {
    background: var(--accent-blue);
    border-color: var(--accent-blue);
}

.interest-option.selected .checkmark::after {
    content: '✓';
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.interest-label {
    color: var(--primary-color);
    font-weight: 500;
    font-size: 0.95rem;
}

.interest-option.selected .interest-label {
    color: var(--accent-blue);
}

.btn-proceed {
    background-color: var(--primary-color) !important;
    color: white !important;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    width: 100%;
    margin-top: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(32, 59, 107, 0.2);
}

.btn-proceed:hover {
    background-color: #1a315a;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(32, 59, 107, 0.3);
}

.btn-proceed:disabled {
    opacity: 0.7;
    transform: none;
    cursor: not-allowed;
}

.alert-danger-custom {
    color: #e74c3c;
    background-color: #fdf2f2;
    border: 1px solid #fbd5d5;
    border-radius: 8px;
    padding: 0.5rem;
    margin-top: 0.75rem;
    display: none;
    font-size: 0.85rem;
}

.alert-danger-custom.show {
    display: block;
}

.reminders-box {
    background-color: #f0f9ff;
    border: 1px solid #cce9ff;
    border-radius: 12px;
    padding: 1rem;
    margin-top: 1rem;
}

.reminders-box h5 {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.reminders-box ul {
    padding-left: 1.25rem;
    color: #6c757d;
    font-size: 0.85rem;
    line-height: 1.5;
}

.reminders-box li {
    margin-bottom: 0.5rem;
}

.lottie-bubble-container {
    position: relative;
    display: inline-block;
}

.lottie-bubble {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(79, 110, 247, 0.2), transparent);
    pointer-events: none;
    z-index: -1;
    animation: floatBubble 8s infinite ease-in-out;
}

.lottie-bubble:nth-child(1) {
    width: 100px;
    height: 100px;
    top: -30px;
    left: -20px;
    animation-delay: 0s;
}
.lottie-bubble:nth-child(2) {
    width: 80px;
    height: 80px;
    bottom: -20px;
    right: -15px;
    animation-delay: 2s;
}
.lottie-bubble:nth-child(3) {
    width: 120px;
    height: 120px;
    top: 25%;
    right: -40px;
    animation-delay: 4s;
}

@keyframes floatBubble {
    0%, 100% {
        transform: translate(0, 0) scale(1);
        opacity: 0.5;
    }
    50% {
        transform: translate(10px, -15px) scale(1.1);
        opacity: 0.7;
    }
}

.speech-bubble {
    position: absolute;
    top: 8%;
    left: 25%;
    transform: translateX(-50%) rotateX(10deg) rotateY(-5deg);
    background: white;
    color: var(--primary-color);
    padding: 0.8rem 1rem;
    border-radius: 16px;
    font-weight: 600;
    font-size: 0.95rem;
    text-align: center;
    max-width: 280px;
    box-shadow:
        0 8px 20px rgba(0, 0, 0, 0.1),
        0 4px 8px rgba(32, 59, 107, 0.1);
    z-index: 2;
    opacity: 0;
    animation: fadeInBubble 1s ease-out 0.6s forwards;
}

.speech-bubble::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-top: 12px solid white;
    filter: drop-shadow(0 -2px 4px rgba(0,0,0,0.1));
}

@keyframes fadeInBubble {
    to {
        opacity: 1;
        transform: translateX(-50%) rotateX(10deg) rotateY(-5deg) translateY(0);
    }
}

.speech-bubble:hover {
    transform: translateX(-50%) rotateX(8deg) rotateY(-4deg) translateY(-2px);
    box-shadow:
        0 12px 25px rgba(0, 0, 0, 0.15),
        0 6px 10px rgba(32, 59, 107, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

@media (max-width: 992px) {
    .lottie-wrapper {
        display: none;
    }
    .form-container {
        padding: 1.25rem;
        max-width: 600px;
    }
    .speech-bubble {
        top: 10%;
        left: 25%;
        font-size: 0.85rem;
        padding: 0.6rem 0.8rem;
    }
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/bcp.png') }}" alt="Bestlink SHS Logo" style="width: 60px; height: 70px;">
            <div>
                <span class="d-block" style="font-size:1rem;">Bestlink SHS</span>
                <span class="d-block" style="font-size:.75rem;">of the Philippines</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tracks & Strands</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Career Paths</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content" style="flex: 1; padding: 1.5rem 0;">
    <div class="container-fluid px-4">
        <div class="row align-items-center justify-content-center g-0">
            <div class="col-md-5 d-flex justify-content-center lottie-wrapper">
                <div class="lottie-bubble-container">
                    <div class="lottie-bubble"></div>
                    <div class="lottie-bubble"></div>
                    <div class="lottie-bubble"></div>
                    <dotlottie-wc
                        src="https://lottie.host/0675dd5a-c142-4843-aa2d-96b5c78180fb/58jQMaPdVu.lottie"
                        style="width: 650px; height: 650px; max-width: 120%;"
                        autoplay
                        loop
                    ></dotlottie-wc>
                    <div class="speech-bubble">
                        MAGANDANG BUHAY!! Welcome, <strong>{{ $data['name'] ?? 'Student' }}</strong>!
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-container">
                    <h3 class="form-title">Welcome to Our SHS Assessment!</h3>
                    
                    <div class="welcome-message">
                        👋 Welcome, <strong>{{ $data['name'] ?? 'Student' }}</strong>!
                    </div>

                    <div class="step-box">
                        <h5>Step 1: Select Your Interests</h5>
                        <p><strong>Choose at least 2 categories</strong> that best represent your interests. The quiz questions will be tailored based on your selection.</p>
                    </div>

                    <form id="interestForm">
                        @csrf
                        <div class="row g-2 mb-3">
                            @php
    $normalizedCategories = [
        'flexible_exploratory_learning' => 'Flexible & Exploratory Learning',
        'business_leadership' => 'Business & Leadership',
        'society_people_communication' => 'Society, People & Communication',
        'science_math_innovation' => 'Science, Math & Innovation',
        'creativity_design' => 'Creativity & Design',
        'hospitality_food_tourism' => 'Hospitality, Food & Tourism'
    ];
@endphp

                            @foreach($normalizedCategories as $key => $label)
                                <div class="col-md-6">
                                    <label class="interest-option" for="interest_{{ $loop->index }}">
                                        <input type="checkbox" class="interest-checkbox" name="interests[]" value="{{ $key }}" id="interest_{{ $loop->index }}" style="display: none;">
                                        <span class="checkmark"></span>
                                        <span class="interest-label">{{ $label }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div id="error-message" class="alert-danger-custom">
    Please select exactly 2 interest categories.
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
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark-custom py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-0">&copy; 2025 Bestlink College of the Philippines. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.interest-checkbox');
    const proceedBtn = document.getElementById('proceedBtn');
    const errorMessage = document.getElementById('error-message');

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
    if (checked.length === 2) { // ✅ exactly 2
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
        fetch("{{ route('shs.interests.submit') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('quiz.show') }}";
            }
        })
        .catch(error => {
            alert('Something went wrong. Please try again.');
        });
    });
});
</script>

</body>
</html>