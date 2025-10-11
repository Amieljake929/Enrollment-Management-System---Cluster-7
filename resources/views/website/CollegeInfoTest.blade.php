<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Personal Information - Bestlink College</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lottie Web Component -->
<script
  src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js"
  type="module"
></script>
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

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .form-container {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 40px rgba(32, 59, 107, 0.15);
    max-width: 500px; /* Fixed width */
    width: 100%;
    height: 8%;
    margin: 20 auto; /* Center horizontally */
}

        .form-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-header h1 {
            font-size: 1.8rem;
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #6c757d;
            font-size: 1rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            border-radius: 12px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(79, 110, 247, 0.2);
        }

        .btn-primary-custom {
            background-color: var(--primary-color) !important;
            color: white !important;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 0.85rem 1.25rem;
            font-size: 1rem;
            width: 100%;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(32, 59, 107, 0.2);
        }

        .btn-primary-custom:hover {
            background-color: #1a315a;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(32, 59, 107, 0.3);
        }

        .btn-primary-custom:disabled {
            opacity: 0.7;
            transform: none;
            cursor: not-allowed;
        }

        /* CAPTCHA Styles */
        #captcha-question {
            background-color: #f1f3f5;
            padding: 0.75rem;
            border-radius: 12px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 0.75rem;
            border: 1px dashed #ced4da;
        }

        #captcha-options {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            margin-bottom: 0.5rem;
        }

        #captcha-options button {
            flex: 1;
            min-width: 70px;
            padding: 0.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s;
        }

        #captcha-error {
            color: #e74c3c;
            font-size: 0.85rem;
            text-align: center;
            margin-top: 0.25rem;
            display: none;
        }

        /* Success Modal */
        .modal-content {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .modal-header {
            background-color: #e8f5e9;
            color: #27ae60;
            border-bottom: 1px solid #d1f0d5;
        }

        /* Navbar & Footer Styles (from AssessmentTest) */
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

        @media (max-width: 576px) {
            .form-container {
                padding: 1.5rem;
            }
            .form-header h1 {
                font-size: 1.5rem;
            }
        }
        /* ==== ANIMATIONS FOR FORM CONTENT ==== */
.form-container {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease-out forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ==== 3D BUBBLE EFFECTS AROUND LOTTIE ==== */
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
    width: 120px;
    height: 120px;
    top: -40px;
    left: -30px;
    animation-delay: 0s;
}
.lottie-bubble:nth-child(2) {
    width: 90px;
    height: 90px;
    bottom: -30px;
    right: -20px;
    animation-delay: 2s;
}
.lottie-bubble:nth-child(3) {
    width: 150px;
    height: 150px;
    top: 30%;
    right: -60px;
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
/* ==== 3D SPEECH BUBBLE ==== */
.speech-bubble {
    position: absolute;
    top: -5%;
    left: 40%;
    transform: translateX(-50%) rotateX(10deg) rotateY(-5deg);
    background: white;
    color: var(--primary-color);
    padding: 1.2rem 1.5rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 1.1rem;
    text-align: center;
    max-width: 320px;
    box-shadow:
        0 10px 25px rgba(0, 0, 0, 0.15),
        0 6px 10px rgba(32, 59, 107, 0.1);
    z-index: 2;
    opacity: 0;
    animation: fadeInBubble 1s ease-out 0.6s forwards;
}

/* Speech bubble tail (triangle) */
.speech-bubble::after {
    content: '';
    position: absolute;
    bottom: -12px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 12px solid transparent;
    border-right: 12px solid transparent;
    border-top: 14px solid white;
    filter: drop-shadow(0 -2px 4px rgba(0,0,0,0.1));
}

@keyframes fadeInBubble {
    to {
        opacity: 1;
        transform: translateX(-50%) rotateX(10deg) rotateY(-5deg) translateY(0);
    }
}

/* Optional: Slight hover lift for interactivity */
.speech-bubble:hover {
    transform: translateX(-50%) rotateX(8deg) rotateY(-4deg) translateY(-3px);
    box-shadow:
        0 14px 30px rgba(0, 0, 0, 0.2),
        0 8px 12px rgba(32, 59, 107, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Terms and Conditions Link */
.terms-link {
    display: block;
    text-align: center;
    margin-top: 1rem;
    font-size: 0.875rem;
    color: #6c757d;
}

.terms-link a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.terms-link a:hover {
    text-decoration: underline;
}

/* Terms Modal Styling */
.modal-lg {
    max-width: 800px;
}

.terms-content {
    max-height: 60vh;
    overflow-y: auto;
    padding: 1.5rem;
    font-size: 0.95rem;
    line-height: 1.6;
}

.terms-content h2 {
    color: var(--primary-color);
    margin-top: 0;
    border-bottom: 2px solid var(--accent-blue);
    padding-bottom: 0.5rem;
}

.terms-content ol {
    padding-left: 1.5rem;
}

.terms-content li {
    margin-bottom: 1rem;
}

.terms-content strong {
    color: var(--primary-color);
}
    </style>
</head>
<body>

<!-- Navbar (copied from AssessmentTest.blade.php) -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/bcp.png') }}" alt="Bestlink College Logo" style="width: 60px; height: 70px;">
            <div>
                    <span class="d-block" style="font-size:1rem;">Bestlink College</span>
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
                    <a class="nav-link" href="#">Career</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Roadmaps</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="container-fluid px-4">
        <div class="row align-items-center justify-content-center">
            <!-- Lottie Animation (Left Side) -->
            <div class="col-md-6 d-flex justify-content-center">
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
    MAGANDANG BUHAY, please fill our form to proceed the Assessment. Thank you!
</div>
    </div>
</div>

            <!-- Form (Right Side) -->
            <div class="col-md-5">
                <div class="form-container">
                    <div class="form-header">
                        <h1>Personal Information</h1>
                        <p>Fill out this form to begin your assessment journey.</p>
                    </div>

                    <!-- Inside your form, just above the submit button -->
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
        <div id="captcha-question" class="form-control" style="cursor: default;">
            Loading...
        </div>
        <div id="captcha-options" class="d-flex flex-wrap gap-2 justify-content-center"></div>
        <input type="hidden" id="captcha-answer" name="captcha_answer">
        <div id="captcha-error" class="text-danger mt-2" style="display:none;">
            ❌ Incorrect! Try again.
        </div>
    </div>

    <!-- Terms Agreement Checkbox -->
    <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
        <label class="form-check-label" for="agreeTerms">
            I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>
        </label>
    </div>

    <button type="submit" class="btn btn-primary-custom" id="submitBtn" disabled>
        Submit Information
    </button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">✅ Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your information has been successfully submitted. Redirecting you to the next step...</p>
            </div>
        </div>
    </div>
</div>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">TERMS AND CONDITIONS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body terms-content">
                <h2>For Enrollees Taking the Assessment for Program Suitability</h2>
                <p><strong>Effective Date: August 2025</strong></p>
                
                <ol>
                    <li>
                        <strong>Purpose of Information Collection</strong><br>
                        We collect basic information from enrollees for the purpose of conducting an assessment designed to help identify the most suitable program or course for each individual. The collected information will be used solely to evaluate personal interests, skills, and academic strengths to provide appropriate guidance and recommendations.
                    </li>
                    <li>
                        <strong>Information We Collect</strong><br>
                        We may collect the following personal information:
                        <ul>
                            <li>Full name</li>
                            <li>Age</li>
                            <li>Contact details (email address, phone)</li>
                            <li>Assessment results and related responses</li>
                        </ul>
                        Only information necessary for assessment and guidance purposes will be requested.
                    </li>
                    <li>
                        <strong>Use of Information</strong><br>
                        The collected data will be used exclusively to:
                        <ul>
                            <li>Administer and evaluate the enrollee's assessment results</li>
                            <li>Provide program or course recommendations suited to the enrollee's profile</li>
                            <li>Improve our guidance and placement process</li>
                        </ul>
                        We will not use your data for marketing, commercial, or unrelated purposes.
                    </li>
                    <li>
                        <strong>In Compliance with the Data Privacy Act of 2012</strong><br>
                        This collection and processing of enrollee data are conducted in compliance with Republic Act No. 10173, also known as the Data Privacy Act of 2012, and its Implementing Rules and Regulations.<br>
                        We are committed to ensuring that your personal data is:
                        <ul>
                            <li>Collected and processed lawfully, fairly, and transparently</li>
                            <li>Used only for legitimate and declared purposes</li>
                            <li>Stored securely and accessed only by authorized personnel</li>
                            <li>Retained only for as long as necessary for assessment and record-keeping purposes</li>
                            <li>Shared with third parties only when required by law or with your explicit consent</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Consent</strong><br>
                        By submitting your information and participating in the assessment, you voluntarily give your consent to the collection, use, and processing of your data for the purposes stated above.<br>
                        You may withdraw your consent at any time by sending a written notice to bestlink092@gmail.com
                    </li>
                    <li>
                        <strong>Data Retention</strong><br>
                        Your information will be retained only for the duration necessary to complete the assessment and provide guidance results. After this period, your data will be securely deleted or anonymized.
                    </li>
                    <li>
                        <strong>Rights of the Enrollee</strong><br>
                        In accordance with the Data Privacy Act of 2012, you have the right to:
                        <ul>
                            <li>Access and correct your personal data</li>
                            <li>Object to the processing of your data</li>
                            <li>Withdraw consent at any time</li>
                            <li>File a complaint with the National Privacy Commission (NPC) if you believe your data privacy rights have been violated</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Contact Information</strong><br>
                        For any questions, concerns, or data privacy-related requests, please contact:<br>
                        
                        Email: bestlink092@gmail.com<br>
                        Address: #1071 Brgy. Kaligayahan, Quirino Highway Novaliches Quezon City, Philippines 1123
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer (copied from AssessmentTest.blade.php) -->
<footer class="bg-dark-custom py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-0">&copy; 2025 Bestlink College of the Philippines. All rights reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Your original JavaScript (unchanged) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.getElementById('submitBtn');
    const agreeTerms = document.getElementById('agreeTerms');
    const captchaAnswer = document.getElementById('captcha-answer');

    // Function to enable/disable submit button
    function updateSubmitButton() {
        const isCaptchaCorrect = captchaAnswer.value !== '';
        const isTermsChecked = agreeTerms.checked;
        submitBtn.disabled = !(isCaptchaCorrect && isTermsChecked);
    }

    // Listen for checkbox changes
    agreeTerms.addEventListener('change', updateSubmitButton);

    // Form submission
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

    // === CAPTCHA LOGIC ===
    let correctAnswer = null;

    function generateCaptcha() {
        const a = Math.floor(Math.random() * 12) + 1;
        const b = Math.floor(Math.random() * 12) + 1;
        correctAnswer = a * b;

        let fake1, fake2;
        do { fake1 = correctAnswer + (Math.random() > 0.5 ? 1 : -1) * (Math.floor(Math.random() * 10) + 1); }
        while (fake1 === correctAnswer || fake1 < 0);
        do { fake2 = correctAnswer + (Math.random() > 0.5 ? 1 : -1) * (Math.floor(Math.random() * 10) + 1); }
        while (fake2 === correctAnswer || fake2 === fake1 || fake2 < 0);

        const options = [correctAnswer, fake1, fake2];
        for (let i = options.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [options[i], options[j]] = [options[j], options[i]];
        }

        document.getElementById('captcha-question').textContent = `${a} × ${b} = ?`;
        const container = document.getElementById('captcha-options');
        container.innerHTML = '';
        options.forEach(option => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-outline-secondary btn-sm';
            btn.textContent = option;
            btn.onclick = () => selectCaptchaOption(option, btn);
            container.appendChild(btn);
        });

        captchaAnswer.value = '';
        document.getElementById('captcha-error').style.display = 'none';
        updateSubmitButton(); // Update button state
    }

    function selectCaptchaOption(selected, button) {
        document.querySelectorAll('#captcha-options button').forEach(btn => {
            btn.classList.remove('btn-success', 'btn-danger');
        });

        if (selected === correctAnswer) {
            button.classList.add('btn-success');
            captchaAnswer.value = selected;
            document.getElementById('captcha-error').style.display = 'none';
        } else {
            button.classList.add('btn-danger');
            captchaAnswer.value = '';
            document.getElementById('captcha-error').style.display = 'block';
            setTimeout(generateCaptcha, 1200);
            return;
        }
        updateSubmitButton(); // Update after selection
    }

    generateCaptcha();
});
</script>

</body>
</html>