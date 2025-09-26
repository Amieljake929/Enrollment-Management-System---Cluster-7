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
        backdrop-filter: blur(5px);
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

    /* ===== HERO SECTION ===== */
    .hero-section {
        padding: 160px 20px 120px;
        text-align: center;
        position: relative;
        z-index: 1;
        margin-top: 1x;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

     /* ===== TYPEWRITER ANIMATION ===== */
.hero-title {
    font-size: 4.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.2;
    color: var(--text-light);
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    position: relative;
    z-index: 5;
    letter-spacing: -1px;
    white-space: nowrap;
    overflow: hidden;
    border-right: 3px solid var(--accent); /* cursor */
    width: fit-content;
    min-width: 0;
    animation: 
        typing 1.5s steps(25, end) forwards,
        blink 1s step-end infinite;
}

@keyframes typing {
    from { width: 0; }
    to { width: 60%; }
}

@keyframes blink {
    0%, 100% { border-color: transparent; }
    50% { border-color: var(--accent); }
}

/* Hide original text if using JS typewriter */
#typewriter {
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
    border-right: 3px solid var(--accent);
    animation: blink 1s step-end infinite;
}

    .hero-subtitle {
        font-size: 1.3rem;
        color: var(--text-muted);
        margin-bottom: 40px;
        animation: fadeInUp 1s ease-out 0.3s both;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        z-index: 5;
    }

    /* ===== FLOATING ELEMENTS ===== */
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
    }

    .floating-element:hover {
        opacity: 1;
        transform: scale(1.1) rotate(10deg) !important;
        filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.7));
    }

    .floating-element:nth-child(1) {
        top: 15%;
        left: 8%;
        animation-delay: 0s;
        font-size: 3.5rem;
        transform: rotate(-10deg);
    }

    .floating-element:nth-child(2) {
        top: 30%;
        right: 12%;
        animation-delay: -5s;
        font-size: 3rem;
        transform: rotate(15deg);
    }

    .floating-element:nth-child(3) {
        bottom: 20%;
        left: 25%;
        animation-delay: -9s;
        font-size: 2.5rem;
        transform: rotate(-5deg);
    }

    .floating-element:nth-child(4) {
        top: 50%;
        left: 35%;
        animation-delay: -7s;
        font-size: 2.2rem;
        transform: rotate(10deg);
    }

    .floating-element:nth-child(5) {
        bottom: 12%;
        right: 25%;
        animation-delay: -3s;
        font-size: 2.8rem;
        transform: rotate(-15deg);
    }

    @keyframes float {
        0% { transform: translate(0px, 0px) rotate(0deg); }
        50% { transform: translate(20px, -20px) rotate(5deg); }
        100% { transform: translate(0px, 0px) rotate(0deg); }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== SCROLL DOWN INDICATOR ===== */
    .scroll-down {
        position: absolute;
        bottom: 80px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        animation: bounce 2s infinite;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .scroll-down:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(-50%) scale(1.1);
    }

    .scroll-down svg {
        width: 30px;
        height: 30px;
        fill: var(--text-light);
        filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.6));
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0) translateX(-50%);
        }
        40% {
            transform: translateY(-25px) translateX(-50%);
        }
        60% {
            transform: translateY(-15px) translateX(-50%);
        }
    }

    /* ===== FORM CONTAINER (SCROLL-TRIGGERED) ===== */
    .form-container {
        max-width: 500px;
        margin: 0 auto;
        background: rgba(30, 29, 50, 0.6);
        backdrop-filter: blur(16px);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.15);
        position: relative;
        overflow: hidden;
        opacity: 0;
        transform: translateY(80px);
        transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        z-index: 5;
        animation: pulseGlow 3s ease-in-out infinite alternate;
    }

    .form-container.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, transparent, transparent 50%);
        opacity: 0.4;
        animation: rotateGlow 12s linear infinite;
        z-index: -1;
    }

    .form-container-header {
        text-align: center;
        margin-bottom: 30px;
        color: var(--text-light);
        font-size: 1.2rem;
        line-height: 1.6;
        opacity: 0.9;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-light);
        margin-bottom: 8px;
        display: block;
        text-align: left;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 16px;
        padding: 16px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        width: 100%;
    }

    .form-control:focus {
        outline: none;
        box-shadow: 0 0 0 3px var(--border-glow);
        border-color: var(--accent);
        background: rgba(255, 255, 255, 0.12);
    }

    .btn-primary {
        background: var(--primary);
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

    .btn-primary:hover {
        background: #2ecc71;
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 25px rgba(46, 204, 113, 0.5);
    }

    @keyframes rotateGlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes pulseGlow {
        from { box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6); }
        to { box-shadow: 0 20px 60px rgba(155, 89, 182, 0.3); }
    }

    /* ===== SCROLLABLE CONTENT BELOW ===== */
    .section {
        padding: 120px 20px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .section-title {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 20px;
        animation: fadeInUp 1s ease-out;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    }

    .section-subtitle {
        font-size: 1.3rem;
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto 40px;
        animation: fadeInUp 1s ease-out 0.3s both;
    }

    .feature-card {
        background: rgba(30, 29, 50, 0.6);
        border-radius: 20px;
        padding: 30px;
        margin: 20px;
        width: 300px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
    }

    .feature-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .feature-card:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
    }

    .feature-icon {
        font-size: 3rem;
        margin-bottom: 20px;
        color: var(--accent);
    }

    /* ===== SUCCESS MODAL ===== */
    .modal-content {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        color: white;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.6);
        animation: modalPopIn 0.5s ease-out;
    }

    .modal-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(46, 204, 113, 0.2);
        padding: 20px 25px;
    }

    .modal-body p {
        color: var(--text-muted);
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .btn-close {
        filter: invert(1);
        opacity: 0.8;
        transition: opacity 0.2s ease;
    }

    .btn-close:hover {
        opacity: 1;
    }

    @keyframes modalPopIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(30px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        .hero-subtitle {
            font-size: 1.1rem;
        }
        .form-container {
            padding: 30px 20px;
            margin: 0 10px;
        }
        .navbar-custom {
            padding: 0.8rem 1rem;
        }
        .nav-link {
            padding: 0.5rem 0.8rem;
            font-size: 0.9rem;
        }
    }
</style>

<!-- ===== VIDEO BACKGROUND ===== -->
<video class="video-bg" autoplay muted loop playsinline>
    <source src="{{ asset('images/educational.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
</video>
<div class="overlay"></div>

<!-- ===== NAVBAR (INTEGRATED WITH HERO BACKGROUND) ===== -->
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

<!-- ===== HERO SECTION ===== -->
<div class="hero-section">
    <!-- Floating 3D Icons -->
    <div class="floating-elements">
        <div class="floating-element">📚</div>
        <div class="floating-element">🧠</div>
        <div class="floating-element">💻</div>
        <div class="floating-element">🌐</div>
        <div class="floating-element">💡</div>
        <div class="floating-element">🎨</div>
        <div class="floating-element">👮</div>
        <div class="floating-element">💡</div>
    </div>

    
    <h1 class="hero-title">Your Course, Your Way</h1>
    <p class="hero-subtitle">Discover the ideal courses for you based on your personal strengths and learning style</p>

    <!-- Scroll Down Indicator -->
    <div class="scroll-down" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </div>
</div>

<!-- ===== FORM CONTAINER (SCROLL-TRIGGERED) ===== -->
<div class="form-container" id="formContainer">
    <div class="form-container-header">
        <strong>Let's get started!</strong><br>
        Fill out this quick form so we can personalize your learning journey.
    </div>
    <form id="infoForm">
        @csrf
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required placeholder="Enter your full name">
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" min="15" max="99" required placeholder="Enter your age">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
        </div>

        <!-- === MATH CAPTCHA SECTION === -->
        <div class="mb-3">
            <label class="form-label">Solve this to prove you're human:</label>
            <div id="captcha-question" class="form-control text-center mb-2" style="background: rgba(0,0,0,0.2); cursor: default;">
                Loading...
            </div>
            <div id="captcha-options" class="d-flex flex-wrap gap-2 justify-content-center"></div>
            <input type="hidden" id="captcha-answer" name="captcha_answer">
            <div id="captcha-error" class="text-danger mt-2" style="display:none; font-size:0.85rem;">
                ❌ Incorrect! Try again.
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100" id="submitBtn" disabled>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                <path d="M15.964.686a.5.5 0 0 0-.756-.06L11.304 4.08l-4.71-4.71a.5.5 0 0 0-.708.708L10.54 8.034 5.83 12.744a.5.5 0 0 0 .708.708l4.71-4.71 3.894 3.894a.5.5 0 0 0 .708-.708l-4.71-4.71 4.71-4.71a.5.5 0 0 0 .06-.756z"/>
            </svg>
            Submit Information
        </button>
    </form>
</div>

<!-- ===== SCROLLABLE SECTIONS BELOW ===== -->
<section class="section" id="features">
    <div class="parallax-bg"></div>
    <h2 class="section-title">Why Choose Our AI Platform?</h2>
    <p class="section-subtitle">We provide cutting-edge tools and personalized learning paths to help you succeed in the future of tech.</p>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">🚀</div>
                <h4>Fast Track Learning</h4>
                <p>Accelerate your journey with AI-curated courses and real-time feedback.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">🧠</div>
                <h4>Smart Assessment</h4>
                <p>Our AI evaluates your skills and recommends the perfect course path.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">🌐</div>
                <h4>Global Community</h4>
                <p>Connect with learners and mentors worldwide through our collaborative platform.</p>
            </div>
        </div>
    </div>
</section>

<section class="section" id="testimonials">
    <div class="parallax-bg"></div>
    <h2 class="section-title">What Students Say</h2>
    <p class="section-subtitle">Real stories from students who transformed their careers with our AI-powered platform.</p>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="feature-card">
                <div class="feature-icon">💬</div>
                <h4>"Game Changer!"</h4>
                <p>“I went from zero to hired in 3 months. The AI assessment knew exactly what I needed.”</p>
                <small>— Maria, Software Engineer</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="feature-card">
                <div class="feature-icon">⭐</div>
                <h4>"Highly Recommended"</h4>
                <p>“The personalized learning path kept me motivated. Best decision ever!”</p>
                <small>— John, Data Analyst</small>
            </div>
        </div>
    </div>
</section>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">✅ Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your information has been successfully submitted. Redirecting you to the next step...</p>
            </div>
        </div>
    </div>
</div>

<script>
// === Scroll Trigger for Form Container ===
document.addEventListener('DOMContentLoaded', function() {
    const formContainer = document.getElementById('formContainer');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1
    });

    observer.observe(formContainer);

    // === Parallax & Scroll Animations for Features ===
    const featureCards = document.querySelectorAll('.feature-card');

    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1
    });

    featureCards.forEach(card => {
        cardObserver.observe(card);
    });

    // === Form Submission ===
    document.getElementById('infoForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("{{ route('college.info.submit') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();

                setTimeout(() => {
                    window.location.href = "{{ route('college.welcome') }}";
                }, 2000);
            }
        })
        .catch(error => {
            alert('Something went wrong. Please try again.');
        });
    });
});
// === MATH CAPTCHA LOGIC ===
let correctAnswer = null;

function generateCaptcha() {
    // Generate two random numbers (1 to 12 for multiplication)
    const a = Math.floor(Math.random() * 12) + 1;
    const b = Math.floor(Math.random() * 12) + 1;
    correctAnswer = a * b;

    // Generate two fake answers (ensure they're not equal to correct or each other)
    let fake1, fake2;
    do {
        fake1 = correctAnswer + (Math.random() > 0.5 ? 1 : -1) * (Math.floor(Math.random() * 10) + 1);
    } while (fake1 === correctAnswer || fake1 < 0);

    do {
        fake2 = correctAnswer + (Math.random() > 0.5 ? 1 : -1) * (Math.floor(Math.random() * 10) + 1);
    } while (fake2 === correctAnswer || fake2 === fake1 || fake2 < 0);

    const options = [correctAnswer, fake1, fake2];
    // Shuffle array
    for (let i = options.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [options[i], options[j]] = [options[j], options[i]];
    }

    // Update UI
    document.getElementById('captcha-question').textContent = `${a} × ${b} = ?`;
    const optionsContainer = document.getElementById('captcha-options');
    optionsContainer.innerHTML = '';

    options.forEach(option => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-outline-light btn-sm';
        btn.style.width = '80px';
        btn.textContent = option;
        btn.onclick = () => selectCaptchaOption(option, btn);
        optionsContainer.appendChild(btn);
    });

    // Reset state
    document.getElementById('captcha-answer').value = '';
    document.getElementById('captcha-error').style.display = 'none';
    document.getElementById('submitBtn').disabled = true;
}

function selectCaptchaOption(selected, button) {
    const allButtons = document.querySelectorAll('#captcha-options button');
    allButtons.forEach(btn => btn.classList.remove('btn-success', 'btn-danger'));

    if (selected === correctAnswer) {
        button.classList.add('btn-success');
        document.getElementById('captcha-answer').value = selected;
        document.getElementById('submitBtn').disabled = false;
        document.getElementById('captcha-error').style.display = 'none';
    } else {
        button.classList.add('btn-danger');
        document.getElementById('captcha-answer').value = '';
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('captcha-error').style.display = 'block';
        // Regenerate CAPTCHA after a short delay
        setTimeout(generateCaptcha, 1200);
    }
}

// Initialize CAPTCHA on page load
document.addEventListener('DOMContentLoaded', function() {
    // ... your existing code ...

    generateCaptcha(); // Add this line
});
</script>
@endsection