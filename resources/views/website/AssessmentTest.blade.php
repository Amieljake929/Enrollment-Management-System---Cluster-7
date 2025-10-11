<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Assessment Test - Bestlink College</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lottie Web Component -->
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #ffffff;
            --dark-bg: #121a2a;
            --light-bg: #f8f9fa;
            --accent-blue: #5044e4;
            --accent-purple: #a051e0;
            --accent-green: #4cd964;
        }
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: var(--light-bg);
            overflow-x: hidden;
        }
        h1, h2, h3, h4, h5 {
            color: var(--primary-color);
            font-weight: 700;
        }
        .section {
            padding: 15rem 0;
        }
        .section2{
            padding: 5rem 0;
            background-color: #f4f7f6;
        }
        .section3{
            padding: 8rem 0;
        }
        .section4{
            padding: 9rem 0;
        }
        .bg-dark-custom {
            background-color: var(--dark-bg) !important;
            color: white;
        }
        .text-primary-custom {
            color: var(--primary-color) !important;
        }
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
        .btn-accent-blue {
            background-color: var(--accent-blue);
            color: white;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-accent-blue:hover {
            background-color: #3d5ae0;
            transform: translateY(-2px);
            color: white;
        }
        .btn-outline-white {
            color: #3B71CA;
            border: 2px solid rgb(219, 219, 219);
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-outline-white:hover {
            background-color: white;
            color: var(--dark-bg);
            transform: translateY(-2px);
        }
        .stat-card {
            text-align: center;
            padding: 2rem;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .process-step {
            text-align: center;
            padding: 2rem;
        }
        .step-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: white;
            font-weight: bold;
        }
        .step-1 { background-color: var(--primary-color); }
        .step-2 { background-color: var(--accent-blue); }
        .step-3 { background-color: var(--accent-purple); }
        .step-4 { background-color: var(--accent-green); }
        .career-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .career-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .career-icon {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: white;
        }
        .career-web { background-color: var(--accent-blue); }
        .career-data { background-color: var(--accent-purple); }
        .career-mobile { background-color: var(--accent-green); }
        .badge-custom {
            background-color: #e9ecef;
            color: #495057;
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            position: relative;
            z-index: 2;
        }
        .gradient-bg {
            background: linear-gradient(135deg, var(--dark-bg), #1e2b45);
            color: white;
            position: relative;
            overflow: hidden;
        }
        .hero-text {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards 0.3s;
        }
        .hero-subtitle {
            font-size: 1.25rem;
            color: #adb5bd;
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards 0.5s;
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
        .navbar-brand img {
            height: 40px;
            width: auto;
        }

        /* Animations */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scroll animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Parallax effect */
        .hero-parallax {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 10% 20%, rgba(30, 58, 138, 0.03) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(80, 68, 228, 0.03) 0%, transparent 20%);
            z-index: 1;
        }

        /* Assessment Modal */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            max-height: 90vh;
        }
        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }
        .modal-body {
            padding: 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .assessment-lottie {
            width: 200px !important;
            height: 200px !important;
            margin: 0 auto 1.5rem;
        }
        .modal-btn {
            width: 80%;
            max-width: 300px;
            padding: 14px;
            font-size: 1.1rem;
            margin: 0.6rem auto;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Section2 content */
        .section2-content {
            max-width: 800px;
            margin: 3rem auto 0;
            text-align: center;
        }
        .section2-content h3 {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
        .section2-content p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.2rem; }
            .stat-number { font-size: 2rem; }
            .process-step { padding: 1.5rem; }
            .step-icon { width: 60px; height: 60px; font-size: 1.5rem; }
            .assessment-lottie {
                width: 160px !important;
                height: 160px !important;
            }
        }
        .display-5 { color: var(--accent-blue); }

        /* Hero Side Lotties */
.hero-lottie-left,
.hero-lottie-right {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
}

.hero-lottie-left {
    left: -90px;
}

.hero-lottie-right {
    right: -60px;
}

/* Optional: Scale down on smaller desktops */
@media (max-width: 992px) {
    .hero-lottie-left,
    .hero-lottie-right {
        width: 150px !important;
        height: 150px !important;
    }
    .hero-lottie-left { left: 10px; }
    .hero-lottie-right { right: 10px; }
}
/* Typing animation */
.typing-cursor {
    display: inline-block;
    width: 4px;
    height: 1.2em;
    background-color: var(--accent-blue);
    margin-left: 4px;
    animation: blink 1s infinite;
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0; }
}
/* Hide on mobile (already done via d-none d-md-block) */
    </style>
</head>
<body>
    

<!-- Navbar -->
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
                    <a class="nav-link active" href="{{ route('one') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#process">Process</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#programs">Explore Our Courses</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="section bg-white position-relative">
    <div class="container position-relative">
        {{-- Left Lottie --}}
        <div class="hero-lottie-left d-none d-md-block">

            <dotlottie-wc
                src="https://lottie.host/9c802ec9-6462-496a-b58e-cb7a678e6325/98WBZKWCGA.lottie"
                style="width: 350px; height: 350px;"
                autoplay
                loop
            ></dotlottie-wc>
        </div>

        {{-- Right Lottie --}}
        <div class="hero-lottie-right d-none d-md-block">
            <dotlottie-wc
                src="https://lottie.host/33e405fc-98b6-4fbc-a8f8-589f475fa0af/ls4W20s8aC.lottie"
                style="width: 250px; height: 250px;"
                autoplay
                loop
            ></dotlottie-wc>
        </div>

        <!-- ✅ CENTERED LOTTIE - NAKA-CENTER SA GITNA NG HERO SECTION -->
        <div class="d-flex justify-content-center mb-3 animate-on-scroll">
            <dotlottie-wc
                src="https://lottie.host/0675dd5a-c142-4843-aa2d-96b5c78180fb/58jQMaPdVu.lottie"
                style="width: 350px; height: 350px; margin-top: -15%;"
                autoplay
                loop
            ></dotlottie-wc>
        </div>
        <div class="text-center mb-4 animate-on-scroll">
            <span class="badge-custom">Complete Tech Learning Platform</span>
        </div>
        <div class="hero-text">
            <h1 class="hero-title">
    <span id="typing-text"></span>
</h1>
            <p id="hero-subtitle" class="hero-subtitle" style="opacity: 0; transform: translateY(20px);">
    Take our AI-powered assessment and discover the program that matches your strengths, passions, and future goals.
</p>

<div id="hero-button" class="d-flex justify-content-center gap-3 mt-4 animate-on-scroll" style="opacity: 0; transform: translateY(20px);">
    <button type="button" class="btn btn-accent-blue" data-bs-toggle="modal" data-bs-target="#assessmentModal">
        <i class="fas fa-book-open me-2"></i> Take Assessment
    </button>
</div>
        </div>
    </div>
</section>

<!-- Assessment Modal -->
<div class="modal fade" id="assessmentModal" tabindex="-1" aria-labelledby="assessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assessmentModalLabel">Choose Your Assessment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <dotlottie-wc
                   src="https://lottie.host/0675dd5a-c142-4843-aa2d-96b5c78180fb/58jQMaPdVu.lottie"
                style="width: 350px; height: 180px; "
                autoplay
                loop
                ></dotlottie-wc>
                <p class="mb-4">Select the appropriate assessment for your level:</p>
                <div class="w-100">
                    <a href="{{ route('college.info.test') }}" class="btn btn-primary-custom modal-btn w-100">
                        College Assessment
                    </a>
                    <a href="{{ route('shs.info.test') }}" class="btn btn-outline-secondary modal-btn w-100" disabled>
                        SHS Assessment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<section class="section2">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 animate-on-scroll">
                <div class="stat-card">
                    <div class="stat-number">2,813+</div>
                    <div class="stat-label">Community Members</div>
                </div>
            </div>
            <div class="col-md-4 animate-on-scroll">
                <div class="stat-card">
                    <div class="stat-number">14+</div>
                    <div class="stat-label">Learning Roadmaps</div>
                </div>
            </div>
            <div class="col-md-4 animate-on-scroll">
                <div class="stat-card">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Educational Resources</div>
                </div>
            </div>
        </div>
        <div class="section2-content animate-on-scroll">
            <h3>Why use our Assessment?</h3>
            <p>Our comprehensive tech education platform combines industry-relevant curriculum with practical learning experiences. We bridge the gap between academic knowledge and real-world tech skills through our innovative assessment-driven approach.</p>
        </div>
    </div>
</section>

<!-- Dark CTA Section -->
<section class="section3 gradient-bg text-white">
    <div class="container">
        <div class="hero-text">
            <h2 class="display-5 fw-bold mb-3 animate-on-scroll">Already decided on your course?</h2>
            <p class="lead mb-4 animate-on-scroll">
                Take the first step and enroll with confidence.
Secure your future today by completing your enrollment and becoming part of a community that inspires growth, learning, and success.
            </p>
            <div class="d-flex justify-content-center gap-3 mt-4 animate-on-scroll">
                <a href="{{ route('two') }}" class="btn btn-outline-white">
                    <i class="fas fa-map-marker-alt me-2"></i> Enroll Now
                </a>
            </div>
            <div class="mt-4 d-flex justify-content-center gap-4 small animate-on-scroll">
                <div><i class="fas fa-users me-1"></i> 2,813+ Community Members</div>
                <div><i class="fas fa-road me-1"></i> 14+ Career Paths</div>
                <div><i class="fas fa-shield-alt me-1"></i> Success Guaranteed</div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="process" class="section4 bg-white">
    <div class="container">
        <div class="text-center mb-4 animate-on-scroll">
            <span class="badge-custom">🚀 The Process</span>
        </div>
        <h2 class="text-center mb-3 animate-on-scroll">The Future of Learning Assessment</h2>
        <p class="text-center text-muted mb-5 animate-on-scroll">AI-Powered and Done in Minutes</p>

        <div class="row g-4">
            <div class="col-md-3 process-step animate-on-scroll">
                <div class="step-icon step-1">1</div>
                <h4>10–20 Mins</h4>
                <p class="text-muted mt-2">
                    Get essential feedback and results quickly, designed for efficiency and minimal time commitment.
                </p>
            </div>
            <div class="col-md-3 process-step animate-on-scroll">
                <div class="step-icon step-2">2</div>
                <h4>AI-Powered</h4>
                <p class="text-muted mt-2">
                    Utilizes advanced Artificial Intelligence to ensure accurate scoring, personalized insights, and fair evaluation.
                </p>
            </div>
            <div class="col-md-3 process-step animate-on-scroll">
                <div class="step-icon step-3">3</div>
                <h4>Simple & Easy</h4>
                <p class="text-muted mt-2">
                    Features an intuitive interface and clear instructions for a hassle-free and stress-free assessment experience.
                </p>
            </div>
            <div class="col-md-3 process-step animate-on-scroll">
                <div class="step-icon step-4">4</div>
                <h4>Informative</h4>
                <p class="text-muted mt-2">
                    Delivers comprehensive reports that offer deep insights into your strengths and areas for improvement.
                </p>
            </div>
        </div>

        <div class="text-center mt-4 animate-on-scroll">
            <a href="#" class="btn btn-primary-custom">
                <i class="fas fa-comment me-2"></i> Contact Us For Help
            </a>
        </div>
    </div>
</section>

<!-- Explore our courses Section -->
<section id="programs" class="section bg-light">
    <div class="container">
        <div class="text-center mb-5 animate-on-scroll">
            <span class="badge-custom">🎓 Explore Our Programs</span>
        </div>
        <h2 class="text-center mb-2 animate-on-scroll">Explore Our Courses</h2>
        <p class="text-center text-muted mb-5 animate-on-scroll">
            Choose a path that aligns with your passion and career goals.
        </p>

        <!-- College Programs -->
        <div class="mb-5">
            <h3 class="text-center mb-4 text-primary-custom fw-bold">College Programs</h3>
            <div class="row g-4">
                @php
                    $collegeCourses = [
                        ['code' => 'BPED', 'name' => 'Bachelor in Physical Education', 'desc' => 'Train future educators in sports, health, and physical development.', 'icon' => 'fas fa-running', 'color' => '#4cd964'],
                        ['code' => 'BEED', 'name' => 'Bachelor of Elementary Education', 'desc' => 'Prepare teachers for foundational learning in elementary schools.', 'icon' => 'fas fa-chalkboard-teacher', 'color' => '#5044e4'],
                        ['code' => 'BSAIS', 'name' => 'BS in Accounting Information System', 'desc' => 'Merge accounting principles with modern information systems.', 'icon' => 'fas fa-calculator', 'color' => '#a051e0'],
                        ['code' => 'BSBA FM', 'name' => 'BSBA major in Financial Management', 'desc' => 'Master financial analysis, investment, and corporate finance.', 'icon' => 'fas fa-chart-pie', 'color' => '#1e3a8a'],
                        ['code' => 'BSBA HRM', 'name' => 'BSBA major in Human Resource Management', 'desc' => 'Develop skills in talent management and organizational behavior.', 'icon' => 'fas fa-users', 'color' => '#e74c3c'],
                        ['code' => 'BSBA MM', 'name' => 'BSBA major in Marketing Management', 'desc' => 'Learn branding, consumer behavior, and digital marketing strategies.', 'icon' => 'fas fa-bullhorn', 'color' => '#f39c12'],
                        ['code' => 'BSCPE', 'name' => 'BS in Computer Engineering', 'desc' => 'Design hardware and software systems for computing devices.', 'icon' => 'fas fa-microchip', 'color' => '#2ecc71'],
                        ['code' => 'BSCRIM', 'name' => 'BS in Criminology', 'desc' => 'Study crime prevention, law enforcement, and justice systems.', 'icon' => 'fas fa-gavel', 'color' => '#34495e'],
                        ['code' => 'BSENTREP', 'name' => 'BS in Entrepreneurship', 'desc' => 'Build skills to launch and manage your own business ventures.', 'icon' => 'fas fa-lightbulb', 'color' => '#9b59b6'],
                        ['code' => 'BSHM', 'name' => 'BS in Hospitality Management', 'desc' => 'Excel in hotel, restaurant, and tourism operations.', 'icon' => 'fas fa-hotel', 'color' => '#1abc9c'],
                        ['code' => 'BSIT', 'name' => 'BS in Information Technology', 'desc' => 'Develop, manage, and secure IT infrastructure and applications.', 'icon' => 'fas fa-laptop-code', 'color' => '#2980b9'],
                        ['code' => 'BSOA', 'name' => 'BS in Office Administration', 'desc' => 'Master administrative support, communication, and office tech.', 'icon' => 'fas fa-building', 'color' => '#d35400'],
                        ['code' => 'BSP', 'name' => 'BS in Psychology', 'desc' => 'Understand human behavior and mental processes for diverse careers.', 'icon' => 'fas fa-brain', 'color' => '#8e44ad'],
                        ['code' => 'BSTM', 'name' => 'BS in Tourism Management', 'desc' => 'Lead in travel, tour operations, and destination marketing.', 'icon' => 'fas fa-plane', 'color' => '#16a085'],
                        ['code' => 'BSED English', 'name' => 'BSEd major in English', 'desc' => 'Teach language, literature, and communication effectively.', 'icon' => 'fas fa-book', 'color' => '#27ae60'],
                        ['code' => 'BSED Filipino', 'name' => 'BSEd major in Filipino', 'desc' => 'Promote Filipino language, culture, and national identity.', 'icon' => 'fas fa-flag', 'color' => '#c0392b'],
                        ['code' => 'BSED Math', 'name' => 'BSEd major in Mathematics', 'desc' => 'Inspire future generations in logical and quantitative thinking.', 'icon' => 'fas fa-square-root-alt', 'color' => '#f1c40f'],
                        ['code' => 'BSED Science', 'name' => 'BSEd major in Science', 'desc' => 'Foster scientific inquiry and environmental awareness.', 'icon' => 'fas fa-flask', 'color' => '#2c3e50'],
                        ['code' => 'BSED Social Studies', 'name' => 'BSEd major in Social Studies', 'desc' => 'Teach history, geography, and civic responsibility.', 'icon' => 'fas fa-globe-asia', 'color' => '#e67e22'],
                        ['code' => 'BSED Values', 'name' => 'BSEd major in Values', 'desc' => 'Instill moral, ethical, and spiritual development in learners.', 'icon' => 'fas fa-heart', 'color' => '#9b59b6'],
                        ['code' => 'BTLED', 'name' => 'Bachelor of Technology and Livelihood Education', 'desc' => 'Train educators in practical and technical-vocational fields.', 'icon' => 'fas fa-tools', 'color' => '#3498db'],
                        ['code' => 'CPE', 'name' => 'Certificate of Professional Education', 'desc' => 'Qualify non-education graduates to teach in basic education.', 'icon' => 'fas fa-graduation-cap', 'color' => '#1e3a8a'],
                    ];
                @endphp

                @foreach($collegeCourses as $course)
                <div class="col-md-6 col-lg-4 animate-on-scroll">
                    <div class="career-card">
                        <div class="career-icon" style="background-color: {{ $course['color'] }};">
                            <i class="{{ $course['icon'] }}"></i>
                        </div>
                        <h5 class="fw-bold">{{ $course['code'] }}</h5>
                        <h6 class="text-primary-custom">{{ $course['name'] }}</h6>
                        <p class="text-muted small">{{ $course['desc'] }}</p>
                        <a href="#" class="text-decoration-none small">
                            Learn more <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- SHS Programs -->
        <div>
            <h3 class="text-center mb-4 text-primary-custom fw-bold">Senior High School (SHS) Tracks</h3>
            <div class="row g-4">
                @php
                    $shsCourses = [
                        ['code' => 'ABM', 'name' => 'Accountancy, Business and Management', 'desc' => 'Focus on business, finance, and entrepreneurship fundamentals.', 'icon' => 'fas fa-money-check-alt', 'color' => '#2980b9'],
                        ['code' => 'GAS', 'name' => 'General Academic Strand', 'desc' => 'Flexible track for diverse college pathways.', 'icon' => 'fas fa-book-open', 'color' => '#8e44ad'],
                        ['code' => 'HECT', 'name' => 'Home Economics - Culinary Arts and Food Services', 'desc' => 'Train in cooking, baking, and food service operations.', 'icon' => 'fas fa-utensils', 'color' => '#e67e22'],
                        ['code' => 'HEHRS', 'name' => 'Home Economics Hotel and Restaurant Services', 'desc' => 'Prepare for careers in hospitality and food service.', 'icon' => 'fas fa-concierge-bell', 'color' => '#16a085'],
                        ['code' => 'HEHO', 'name' => 'Home Economics Hotel Operation', 'desc' => 'Specialize in hotel front office and housekeeping management.', 'icon' => 'fas fa-bed', 'color' => '#27ae60'],
                        ['code' => 'HETEM', 'name' => 'Home Economics Tourism and Event Management', 'desc' => 'Plan tours, events, and travel experiences.', 'icon' => 'fas fa-map-marked-alt', 'color' => '#f39c12'],
                        ['code' => 'HUMSS', 'name' => 'Humanities and Social Sciences', 'desc' => 'Explore society, culture, politics, and human behavior.', 'icon' => 'fas fa-landmark', 'color' => '#c0392b'],
                        ['code' => 'ICT-HW', 'name' => 'ICT Hardware', 'desc' => 'Assemble, maintain, and troubleshoot computer systems.', 'icon' => 'fas fa-hdd', 'color' => '#2c3e50'],
                        ['code' => 'JCT-CP', 'name' => 'ICT-Programming', 'desc' => 'Develop software applications and coding skills.', 'icon' => 'fas fa-code', 'color' => '#2ecc71'],
                        ['code' => 'ICT Animation', 'name' => 'ICT Animation', 'desc' => 'Create 2D/3D animations and visual effects.', 'icon' => 'fas fa-film', 'color' => '#9b59b6'],
                        ['code' => 'ICT CCS', 'name' => 'ICT-Contact Center Services', 'desc' => 'Train in customer service and call center operations.', 'icon' => 'fas fa-headset', 'color' => '#1abc9c'],
                        ['code' => 'ICT Visual Graphics', 'name' => 'ICT Visual Graphics', 'desc' => 'Design digital graphics, layouts, and multimedia content.', 'icon' => 'fas fa-palette', 'color' => '#f1c40f'],
                        ['code' => 'STEM', 'name' => 'Science, Technology, Engineering and Mathematics', 'desc' => 'Build strong foundation in science and math for tech careers.', 'icon' => 'fas fa-atom', 'color' => '#e74c3c'],
                        ['code' => 'STEM PBM', 'name' => 'STEM-Pre-Baccalaureate Maritime', 'desc' => 'Pathway to maritime and naval engineering programs.', 'icon' => 'fas fa-ship', 'color' => '#3498db'],
                    ];
                @endphp

                @foreach($shsCourses as $course)
                <div class="col-md-6 col-lg-4 animate-on-scroll">
                    <div class="career-card">
                        <div class="career-icon" style="background-color: {{ $course['color'] }};">
                            <i class="{{ $course['icon'] }}"></i>
                        </div>
                        <h5 class="fw-bold">{{ $course['code'] }}</h5>
                        <h6 class="text-primary-custom">{{ $course['name'] }}</h6>
                        <p class="text-muted small">{{ $course['desc'] }}</p>
                        <a href="#" class="text-decoration-none small">
                            Learn more <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-center mt-5 animate-on-scroll">
            <a href="{{ route('two') }}" class="btn btn-outline-primary">
                View All Programs <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark-custom py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0">&copy; 2025 Bestlink College of the Philippines. All rights reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Scroll animation with Intersection Observer
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleText = "Discover the course made for you";
    const subtitleText = "Take our AI-powered assessment and discover the program that matches your strengths, passions, and future goals.";
    const typingElement = document.getElementById('typing-text');
    const subtitleElement = document.getElementById('hero-subtitle');
    const buttonElement = document.getElementById('hero-button');

    let i = 0;
    const speed = 50; // typing speed

    // Helper: fade in an element with smooth animation
    function fadeInElement(element, delay = 0) {
        setTimeout(() => {
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, delay);
    }

    // Typing function
    function typeTitle() {
        if (i < titleText.length) {
            let line = '';
            for (let j = 0; j <= i; j++) {
                if (titleText[j] === '\n') {
                    line += '<br><span style="color: var(--accent-blue);">';
                } else {
                    line += titleText[j];
                }
            }
            typingElement.innerHTML = line + '<span class="typing-cursor"></span>';
            i++;
            setTimeout(typeTitle, speed);
        } else {
            // Title done → remove cursor & fade in subtitle after 300ms
            typingElement.innerHTML = typingElement.innerHTML.replace('<span class="typing-cursor"></span>', '');
            
            // Fade in subtitle after a short pause
            fadeInElement(subtitleElement, 300);
            
            // Fade in button after subtitle appears
            fadeInElement(buttonElement, 800);
        }
    }

    // Start the sequence
    typeTitle();
});
</script>

</body>
</html>