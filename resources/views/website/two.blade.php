<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Enroll & Assess - Bestlink College</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


    <style>
        :root {
            --primary-color: #203B6B;
            --secondary-color: #ffffff;
            --section-padding: 6rem 0;
        }
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        h1, h2, h3, h4, h5 {
            color: var(--primary-color);
            font-weight: 700;
        }
        .section {
            padding: var(--section-padding);
        }
        .bg-primary-custom {
            background-color: var(--primary-color) !important;
            color: var(--secondary-color);
        }
        .text-primary-custom {
            color: var(--primary-color) !important;
        }

        /* Alternating Backgrounds */
        .bg-light {
            background-color: #f8f9fa !important;
        }
        .bg-soft-blue {
    background: linear-gradient(135deg, #f5f9ff 0%, #e8f0fc 100%);
    position: relative;
    overflow: hidden;
}
/* Button Styling */
.btn-primary-custom {
    background-color: var(--primary-color) !important;
    color: white !important;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(32, 59, 107, 0.2);
}
.btn-primary-custom:hover {
    background-color: #1a315a;
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(32, 59, 107, 0.3);
}

/* Image Styling */
.img-fluid.rounded-4 {
    border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    transition: transform 0.5s ease;
}
.img-fluid.rounded-4:hover {
    transform: scale(1.02);
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .bg-soft-blue {
        padding: 4rem 0;
    }
    .row.align-items-center {
        flex-direction: column;
        text-align: center;
    }
    .col-lg-6 {
        margin-bottom: 2rem;
    }
    .img-fluid.rounded-4 {
        max-height: 400px;
    }
}

@media (max-width: 768px) {
    h2.display-5 {
        font-size: 2rem;
        line-height: 1.4;
    }
    .btn-primary-custom {
        width: 70%;
        padding: 12px;
        font-size: 0.95rem;
    }
}

        /* Fade-in Animation on Scroll */
        .fade-in-section {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .fade-in-section.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* =================================== */
        /* 1️⃣ WELCOME MODAL (Auto-Open on Load) – Mobile-Friendly */
        /* =================================== */
        .welcome-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1050;
            display: none;
            justify-content: center;
            align-items: center; /* Bottom alignment for mobile feel */
        }
        .welcome-modal-backdrop.show {
            display: flex;
            animation: fadeIn 0.4s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .welcome-modal {
            background: white;
            border-radius: 16px 16px 16px 16px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            width: 95%;
            max-width: 500px; /* Perfect size for both mobile and desktop */
            max-height: 90vh;
            overflow-y: auto;
            /* Start from bottom (mobile swipe-up effect) */
            transform: translateY(100%);
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .welcome-modal.show {
            transform: translateY(0);
            opacity: 1;
        }
        .welcome-modal-header {
            background: linear-gradient(135deg, var(--primary-color), #305793);
            color: white;
            padding: 1.2rem 1.5rem;
            border-radius: 16px 16px 0 0;
            position: relative;
            text-align: center;
        }
        .welcome-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .welcome-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .welcome-modal-body {
            padding: 1.8rem 1.5rem;
        }
        .welcome-modal-img {
            max-height: 150px;
            width: auto;
            object-fit: contain;
            border-radius: 12px;
            margin: 0 auto 1.2rem;
            display: block;
        }
        .welcome-modal-btn {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border: none;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .welcome-modal-btn:hover {
            background-color: #1a315a;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(32, 59, 107, 0.3);
        }

        /* =================================== */
        /* 2️⃣ HERO SECTION – Taller & Immersive */
        /* =================================== */
        .hero {
            min-height: 80vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #f5f9ff 0%, #e8f0fc 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
        .hero img {
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(0);
            transition: transform 0.5s ease;
        }
        .hero img:hover {
            transform: translateY(-5px);
        }

        /* Enroll Now Button – Improved Visibility */
        .btn-hero {
            background-color: var(--primary-color);
            color: white;
            border: 2px solid rgba(32, 59, 107, 0.2);
            padding: 12px 35px;
            font-weight: 600;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(32, 59, 107, 0.2);
            transition: all 0.3s ease;
        }
        .btn-hero:hover {
            background-color: #1a315a;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(32, 59, 107, 0.35);
        }

        /* =================================== */
        /* 2️⃣ ASSESSMENT SECTION – Enhanced */
        /* =================================== */
        .assessment-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(32, 59, 107, 0.1);
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e9ecef;
        }
        .assessment-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(32, 59, 107, 0.2);
            border-color: var(--primary-color);
        }
        .feature-icon-large {
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin: 0 auto 1rem;
        }

        /* "Take Assessment" Button – More Stylish */
        .btn-assessment {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 14px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(32, 59, 107, 0.25);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .btn-assessment:hover {
            background-color: #1a315a;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(32, 59, 107, 0.4);
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .welcome-modal {
                width: 95%;
                border-radius: 16px 16px 16px 16px;
            }
            .welcome-modal-img {
                max-height: 130px;
            }
            .welcome-modal-body {
                padding: 1.2rem;
            }
            .welcome-modal-btn {
                padding: 10px 20px;
                font-size: 0.95rem;
            }
            .hero {
                min-height: 60vh;
            }
            .btn-assessment {
                font-size: 0.95rem;
            }
            .requirement-category {
                padding: 1rem;
            }
        }

        /* =================================== */
        /* 4️⃣ ENROLLMENT REQUIREMENTS – Row on Desktop, Column on Mobile */
        /* =================================== */
        .requirements-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
        }
        .requirement-category {
            flex: 1 1 300px;
            min-width: 280px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            border-left: 5px solid var(--primary-color);
            transition: all 0.3s ease;
        }
        .requirement-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .requirement-category h4 {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .requirement-icon {
            font-size: 1.4rem;
            color: var(--primary-color);
        }

        /* =================================== */
        /* 5️⃣ ENROLLMENT PROCESS – Step Modals */
        /* =================================== */
        .step-icon {
            width: 55px;
            height: 55px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin: 0 auto 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .step-icon:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(32, 59, 107, 0.2);
        }
        .step-label {
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* =================================== */
        /* 6️⃣ CTA SECTION – Text Color Fix */
        /* =================================== */
        #enroll-now-section h2,
        #enroll-now-section p {
            color: var(--secondary-color) !important;
        }

        /* Alert */
        .alert-sky {
            background-color: #e3f2fd;
            border-left: 4px solid var(--primary-color);
        }

        /* Hover Lift */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 3rem 0;
        }
        .social-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        .social-icon:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(32, 59, 107, 0.25);
        }
        .hero{
            background: linear-gradient(135deg, #203B6B, #305793);
    color: white;
    position: relative;
    overflow: hidden;
        }
        
    </style>
</head>
<body>

<!-- =================================== -->
<!-- 1️⃣ WELCOME MODAL (Auto-Open on Load) -->
<!-- =================================== -->
<div class="welcome-modal-backdrop" id="welcomeModalBackdrop">
    <div class="welcome-modal" id="welcomeModal">
        <div class="welcome-modal-header">
            <h5 class="mb-0" style="color: white;">Welcome to Bestlink College</h5>
            <button type="button" class="welcome-modal-close" id="welcomeModalClose">&times;</button>
        </div>
        <div class="welcome-modal-body text-center">
            <img src="{{ asset('images/take2.jpg') }}" alt="Welcome to Bestlink" class="welcome-modal-img" />
            <h4 class="text-primary-custom">Not Sure What to Study?</h4>
            <p class="text-muted">
                Take our quick and fun assessment to find the Senior High School strand or College program that best matches your interests, strengths, and future goals.
                It’s free, takes less than 7 minutes, and gives you personalized recommendations!
            </p>
            <button id="takeAssessmentBtn" class="welcome-modal-btn btn-lg">
                <i class="fas fa-vial me-2"></i> Take Assessment Now
            </button>
        </div>
    </div>
</div>

<!-- =================================== -->
<!-- 2️⃣ HERO SECTION – Centered Text with Gradient Background -->
<!-- =================================== -->
<section class="section hero bg-gradient-custom text-center fade-in-section" id="hero-section">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <h1 class="display-4 fw-bold text-white mb-4">
                    Start Your Journey at Bestlink College
                </h1>
                <p class="lead text-white mb-5">
                    We provide quality education to make students globally competitive and productive citizens.
                </p>
                <a href="#enroll-now-section" class="btn btn-hero btn-lg mt-3">
                    Enroll Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =================================== -->
<!-- 3️⃣ ASSESSMENT QUIZ SECTION – Enhanced Hero Style -->
<!-- =================================== -->
<section class="section bg-soft-blue" id="assessment-section">
    <div class="container">
        <div class="row align-items-center g-5">
                    <h1 class="text-center mb-5 fade-in-section">Course Assessment Test</h1>

            <!-- Left Side: Text Content -->
            <div class="col-lg-6 fade-in-section">
                <h2 class="text-primary-custom display-5 fw-bold mb-3">
                    Find the program<br><span class="text-white">That fits you the BEST.</span>
                </h2>
                <p class="lead text-muted mb-4">
                    Take our AI-powered assessment and discover the program that aligns with your strengths and interests.
                </p>
                <button type="button" class="btn btn-primary-custom btn-lg px-5 py-3 shadow-lg hover-lift" data-bs-toggle="modal" data-bs-target="#assessmentModal">
                    <i class="fas fa-vial me-2"></i> Take the Assessment Now
                </button>
            </div>

            <!-- Right Side: Image -->
            <div class="col-lg-6 text-center fade-in-section">
                <img src="{{ asset('images/assessment.png') }}" alt="Bestlink Students" class="img-fluid rounded-4 shadow-lg" style="max-height: 500px; object-fit: cover;" />
            </div>
        </div>
    </div>
</section>

<!-- =================================== -->
<!-- ASSESSMENT MODAL -->
<!-- =================================== -->
<div class="modal fade" id="assessmentModal" tabindex="-1" aria-labelledby="assessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary-custom text-white border-0">
                <div>
                    <h5 class="modal-title" id="assessmentModalLabel" style="color: white;">Choose Your Assessment</h5>
                    <p class="mb-0 small">Select the path that matches your current academic level</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="row g-3">
                    <div class="col-12">
                        <a href="{{ route('college.info.form') }}" class="text-decoration-none">
                            <div class="btn btn-primary w-100 py-3 text-center hover-lift">
                                <i class="fas fa-university fa-lg me-2"></i> <strong>College Assessment</strong>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('shs.quiz') }}" class="text-decoration-none">
                            <div class="btn btn-secondary w-100 py-3 text-center hover-lift">
                                <i class="fas fa-user-graduate fa-lg me-2"></i> <strong>SHS Assessment</strong>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =================================== -->
<!-- 3️⃣ ENROLLMENT INFORMATION (No Changes) -->
<!-- =================================== -->
<section class="section">
    <div class="container">
        <div class="text-center mb-5 fade-in-section">
            <h2>Enrollment for Academic Year 2025–2026</h2>
            <p>Secure your spot now! Online enrollment is open and available for all programs.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 text-center fade-in-section">
                <div class="card h-100 shadow-sm border-0 hover-lift">
                    <div class="card-body">
                        <i class="fas fa-calendar-alt fa-2x text-primary-custom mb-3"></i>
                        <h5>Enrollment Period</h5>
                        <p>March 1 – June 30, 2025</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center fade-in-section">
                <div class="card h-100 shadow-sm border-0 hover-lift">
                    <div class="card-body">
                        <i class="fas fa-laptop fa-2x text-primary-custom mb-3"></i>
                        <h5>Online Enrollment</h5>
                        <p>Available 24/7 via our portal</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center fade-in-section">
                <div class="card h-100 shadow-sm border-0 hover-lift">
                    <div class="card-body">
                        <i class="fas fa-headset fa-2x text-primary-custom mb-3"></i>
                        <h5>Support</h5>
                        <p>Need help? Call us at (02) 1234-5678</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =================================== -->
<!-- 4️⃣ ENROLLMENT REQUIREMENTS – Row on Desktop, Column on Mobile -->
<!-- =================================== -->
<section class="section bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fade-in-section">Enrollment Requirements</h2>

        <div class="requirements-container">
            <!-- Senior High School -->
            <div class="requirement-category fade-in-section">
                <h4><i class="fas fa-user-graduate requirement-icon"></i> Senior High School</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> PSA Birth Certificate</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> Form 138 (Report Card)</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> 1x1 ID Pictures (4 copies)</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> Barangay Clearance</li>
                </ul>
            </div>

            <!-- College Student -->
            <div class="requirement-category fade-in-section">
                <h4><i class="fas fa-university requirement-icon"></i> College Student</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> PSA Birth Certificate</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> High School Diploma</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> Form 138 or Transcript of Records</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> 1x1 ID Pictures (4 copies)</li>
                </ul>
            </div>

            <!-- Transferee -->
            <div class="requirement-category fade-in-section">
                <h4><i class="fas fa-exchange-alt requirement-icon"></i> Transferee</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> PSA Birth Certificate</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> Transcript of Records</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> Good Moral Certificate</li>
                    <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> 1x1 ID Pictures (4 copies)</li>
                </ul>
            </div>
        </div>

        <!-- Alert -->
        <div class="alert alert-sky mt-4 fade-in-section" role="alert">
            <i class="fas fa-info-circle text-primary-custom me-2"></i>
            Additional requirements may be needed depending on your course/program. Please contact the registrar's office for specific requirements.
        </div>
    </div>
</section>

<!-- =================================== -->
<!-- 5️⃣ ENROLLMENT PROCESS – 6 Steps with Modals -->
<!-- =================================== -->
<section class="section">
    <div class="container">
        <h2 class="text-center mb-5 fade-in-section">Enrollment Process</h2>
        <div class="row text-center">
            <!-- Step 1 -->
            <div class="col-lg-2 col-6 mb-4 fade-in-section">
                <div class="step-icon" data-bs-toggle="modal" data-bs-target="#step1Modal">
                    1
                </div>
                <h6 class="step-label">Apply Online</h6>
            </div>
            <!-- Step 2 -->
            <div class="col-lg-2 col-6 mb-4 fade-in-section">
                <div class="step-icon" data-bs-toggle="modal" data-bs-target="#step2Modal">
                    2
                </div>
                <h6 class="step-label">Submit Requirements</h6>
            </div>
            <!-- Step 3 -->
            <div class="col-lg-2 col-6 mb-4 fade-in-section">
                <div class="step-icon" data-bs-toggle="modal" data-bs-target="#step3Modal">
                    3
                </div>
                <h6 class="step-label">Pay Reservation Fee</h6>
            </div>
            <!-- Step 4 -->
            <div class="col-lg-2 col-6 mb-4 fade-in-section">
                <div class="step-icon" data-bs-toggle="modal" data-bs-target="#step4Modal">
                    4
                </div>
                <h6 class="step-label">Attend Orientation</h6>
            </div>
            <!-- Step 5 -->
            <div class="col-lg-2 col-6 mb-4 fade-in-section">
                <div class="step-icon" data-bs-toggle="modal" data-bs-target="#step5Modal">
                    5
                </div>
                <h6 class="step-label">Enroll & Start Classes</h6>
            </div>
            <!-- Step 6 -->
            <div class="col-lg-2 col-6 mb-4 fade-in-section">
                <div class="step-icon" data-bs-toggle="modal" data-bs-target="#step6Modal">
                    6
                </div>
                <h6 class="step-label">Receive ID & Schedule</h6>
            </div>
        </div>
    </div>
</section>

<!-- Modals for Each Step -->
<div class="modal fade" id="step1Modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Step 1: Apply Online</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Fill out the online application form with your personal and academic information. This is your first step toward becoming a Bestlink student.</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="step2Modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Step 2: Submit Requirements</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Upload scanned copies of your PSA Birth Certificate, Report Card, and other required documents through our secure portal.</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="step3Modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Step 3: Pay Reservation Fee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Pay a small reservation fee via HMA, AUB, or Main Cashier to secure your slot for enrollment.</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="step4Modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Step 4: Attend Orientation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Join our virtual or on-site orientation to learn about school policies, facilities, and academic expectations.</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="step5Modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Step 5: Enroll & Start Classes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Finalize your subject enrollment and class schedule. Classes begin shortly after!</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="step6Modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Step 6: Receive ID & Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>You will receive your official student ID, class schedule, and access to the student portal within 24 hours of enrollment.</p>
            </div>
        </div>
    </div>
</div>

<!-- =================================== -->
<!-- 6️⃣ PROCEED TO ENROLLMENT SECTION – Text Fixed to White -->
<!-- =================================== -->
<section class="section bg-primary-custom text-white text-center" id="enroll-now-section">
    <div class="container">
        <h2 class="fade-in-section">Ready to begin your academic journey?</h2>
        <p class="lead mb-4 fade-in-section">Join thousands of students who have started their future at Bestlink College.</p>
        <button type="button" class="btn btn-light btn-primary-custom btn-lg px-5 mb-2" data-bs-toggle="modal" data-bs-target="#enrollmentModal">
            Proceed to Online Enrollment
        </button>
        <p class="small fade-in-section">Application takes approximately 15–20 minutes to complete.</p>
    </div>
</section>

<!-- =================================== -->
<!-- ENROLLMENT MODAL -->
<!-- =================================== -->
<div class="modal fade" id="enrollmentModal" tabindex="-1" aria-labelledby="enrollmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary-custom text-white border-0">
                <h5 class="modal-title" id="enrollmentModalLabel" style="color: white;">Start Your Enrollment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <p class="lead mb-4">
                    Welcome! Let’s get you started on your academic journey at Bestlink College.
                </p>
                <p class="text-muted">
                    Choose your enrollment type to begin the process.
                </p>
                <div class="d-grid gap-3 mt-4">
                    <a href="{{ route('college.enrollment') }}" class="btn btn-primary btn-lg rounded-pill shadow-sm hover-lift">
                        <i class="fas fa-university me-2"></i> College Enrollment
                    </a>
                    <a href="{{ route('shs.enrollment') }}" class="btn btn-outline-light btn-lg rounded-pill shadow-sm hover-lift" style="color: black;">
                        <i class="fas fa-user-graduate me-2"></i> Senior High School
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =================================== -->
<!-- 8️⃣ FAQ ACCORDION -->
<!-- =================================== -->
<section class="section bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fade-in-section">Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item fade-in-section">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                        How do I apply for enrollment?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can apply online through our enrollment portal. Just click "Proceed to Online Enrollment" and fill out the form.
                    </div>
                </div>
            </div>
            <div class="accordion-item fade-in-section">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                        Is there an entrance exam?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        No, the College Entrance Exam is not required both for SHS & College students.
                    </div>
                </div>
            </div>
            <div class="accordion-item fade-in-section">
                <h2 class="accordion-header" id="faq3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                        Can I enroll as a transferee?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, transferees are accepted. Please submit your TOR and other requirements for evaluation.
                    </div>
                </div>
            </div>
            <div class="accordion-item fade-in-section">
                <h2 class="accordion-header" id="faq4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                        What are the payment options?
                    </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        We accept HMA, AUB, and over-the-counter payments.
                    </div>
                </div>
            </div>
            <div class="accordion-item fade-in-section">
                <h2 class="accordion-header" id="faq5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                        How do I contact the registrar?
                    </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can call (02) 1234-5678 or email registrar@bestlink.edu.ph during office hours.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =================================== -->
<!-- 9️⃣ FOOTER -->
<!-- =================================== -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <img src="{{ asset('images/bcp.png') }}" alt="Bestlink College Logo" height="50" class="mb-3" />
                <p>Bestlink College of the Philippines is committed to excellence in education and student development.</p>
            </div>
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p>
                    <i class="fas fa-map-marker-alt me-2"></i> Quezon City & Bulacan<br />
                    <i class="fas fa-phone me-2"></i> (02) 1234-5678<br />
                    <i class="fas fa-envelope me-2"></i> info@bestlink.edu.ph
                </p>
            </div>
            <div class="col-md-4">
                <h5>Stay Connected</h5>
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                <div class="mt-3">
                    <p class="mb-1">Subscribe to our newsletter:</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email" />
                        <button class="btn btn-secondary" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-4 mb-3" style="border-color: rgba(255,255,255,0.2);" />
        <p class="text-center mb-0">&copy; 2025 Bestlink College of the Philippines. All rights reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Welcome Modal & Fade-in Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const backdrop = document.getElementById('welcomeModalBackdrop');
        const modal = document.getElementById('welcomeModal');
        const closeBtn = document.getElementById('welcomeModalClose');
        const takeAssessmentBtn = document.getElementById('takeAssessmentBtn');

        // Show modal after 1 second
        setTimeout(() => {
            backdrop.classList.add('show');
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
        }, 1000);

        // Close modal
        closeBtn.addEventListener('click', () => {
            modal.classList.remove('show');
            setTimeout(() => {
                backdrop.classList.remove('show');
            }, 500);
        });

        // Click outside to close
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) {
                closeBtn.click();
            }
        });

        // Take Assessment button scrolls to section
        takeAssessmentBtn.addEventListener('click', () => {
            closeBtn.click(); // Close modal
            setTimeout(() => {
                document.querySelector('#assessment-section').scrollIntoView({ behavior: 'smooth' });
            }, 300);
        });

        // Fade-in on scroll
        const fadeElements = document.querySelectorAll('.fade-in-section');
        const fadeInObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });

        fadeElements.forEach(el => fadeInObserver.observe(el));
    });
</script>

</body>
</html>