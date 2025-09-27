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
    <style>
        :root {
            --primary-color: #203B6B;
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
            color: rgb(187, 187, 187);
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
        }
        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .hero-subtitle {
            font-size: 1.25rem;
            color: #adb5bd;
            margin-bottom: 2rem;
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
            color: var(--accent-blue);
            font-weight: 700;
            font-size: 1.5rem;
        }
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            .stat-number {
                font-size: 2rem;
            }
            .process-step {
                padding: 1.5rem;
            }
            .step-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">Bestlink College</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
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

<!-- Hero Section -->
<section class="section bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <span class="badge-custom">Complete Tech Learning Platform</span>
        </div>
        <div class="hero-text">
            <h1 class="hero-title">
                Accelerate your tech career<br>
                <span style="color: var(--accent-blue);">with expert roadmaps</span>
            </h1>
            <p class="hero-subtitle">
                Explore our interactive learning roadmaps, premium code marketplace, and in-depth tech blogs to master the skills that matter in today's tech industry.
            </p>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <!-- Updated Button to trigger modal -->
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
            <div class="modal-body text-center">
                <p>Select the appropriate assessment for your level:</p>
                <div class="d-grid gap-2">
                    <!-- College Assessment Button -->
                    <a href="{{ route('college.info.test') }}" class="btn btn-primary-custom">
                        College Assessment
                    </a>
                    <!-- SHS Assessment Button (placeholder) -->
                    <a href="#" class="btn btn-outline-secondary" disabled>
                        SHS Assessment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<section class="section2 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-number">2,813+</div>
                    <div class="stat-label">Community Members</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-number">14+</div>
                    <div class="stat-label">Learning Roadmaps</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Educational Resources</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dark CTA Section -->
<section class="section3 gradient-bg text-white">
    <div class="container">
        <div class="text-center mb-4">
            <a href="#" class="btn btn-outline-white btn-sm">🚀 Get Started</a>
        </div>
        <div class="hero-text">
            <h2 class="display-5 fw-bold mb-3">Ready to Launch Your Tech Career?</h2>
            <p class="lead mb-4">
                Take the first step today. Find your ideal tech path, build in-demand skills, and join thousands of successful tech professionals.
            </p>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="#" class="btn btn-outline-white">
                    <i class="fas fa-map-marker-alt me-2"></i> Find Your Path
                </a>
            
            </div>
            <div class="mt-4 d-flex justify-content-center gap-4 small">
                <div><i class="fas fa-users me-1"></i> 2,813+ Community Members</div>
                <div><i class="fas fa-road me-1"></i> 14+ Career Paths</div>
                <div><i class="fas fa-shield-alt me-1"></i> Success Guaranteed</div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section4 bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <span class="badge-custom">🚀 The Process</span>
        </div>
        <h2 class="text-center mb-3">How Bestlink College Works</h2>
        <p class="text-center text-muted mb-5">Your journey to a tech career in four simple steps</p>

        <div class="row g-4">
            <div class="col-md-3 process-step">
                <div class="step-icon step-1">1</div>
                <h4>Take the Quiz</h4>
                <p class="text-muted mt-2">
                    Complete our interactive assessment to discover your ideal tech career based on your interests and strengths.
                </p>
            </div>
            <div class="col-md-3 process-step">
                <div class="step-icon step-2">2</div>
                <h4>Get Your Roadmap</h4>
                <p class="text-muted mt-2">
                    Receive a personalized learning path tailored to your career goals, skills, and experience level.
                </p>
            </div>
            <div class="col-md-3 process-step">
                <div class="step-icon step-3">3</div>
                <h4>Learn Skills</h4>
                <p class="text-muted mt-2">
                    Access structured modules with hands-on projects and track your progress as you build in-demand tech skills.
                </p>
            </div>
            <div class="col-md-3 process-step">
                <div class="step-icon step-4">4</div>
                <h4>Launch Career</h4>
                <p class="text-muted mt-2">
                    Create your portfolio, build your professional network, and confidently apply for jobs in your chosen field.
                </p>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="#" class="btn btn-primary-custom">
                <i class="fas fa-comment me-2"></i> Contact Us For Help
            </a>
        </div>
    </div>
</section>

<!-- Career Paths Section -->
<section class="section bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <span class="badge-custom">💼 Career Options</span>
        </div>
        <h2 class="text-center mb-3">Explore Top Tech Career Paths</h2>
        <p class="text-center text-muted mb-5">Discover high-demand, well-paying tech careers suited to different skills and interests</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="career-card">
                    <div class="career-icon career-web">
                        <i class="fas fa-code"></i>
                    </div>
                    <h4>Web Development</h4>
                    <p class="text-muted">Create websites and web applications</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Frontend and backend development</li>
                        <li><i class="fas fa-check text-success me-2"></i>HTML, CSS, JavaScript, frameworks</li>
                        <li><i class="fas fa-check text-success me-2"></i>Build interactive web experiences</li>
                    </ul>
                    <a href="#" class="text-decoration-none">
                        Explore Web Development Roadmap <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="career-card">
                    <div class="career-icon career-data">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Data Science</h4>
                    <p class="text-muted">Analyze and interpret complex data</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Statistical analysis and visualization</li>
                        <li><i class="fas fa-check text-success me-2"></i>Python, R, SQL, machine learning</li>
                        <li><i class="fas fa-check text-success me-2"></i>Extract insights from large datasets</li>
                    </ul>
                    <a href="#" class="text-decoration-none">
                        Explore Data Science Roadmap <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="career-card">
                    <div class="career-icon career-mobile">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>Mobile App Development</h4>
                    <p class="text-muted">Build iOS and Android applications</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Native and cross-platform development</li>
                        <li><i class="fas fa-check text-success me-2"></i>React Native, Flutter, Swift, Kotlin</li>
                        <li><i class="fas fa-check text-success me-2"></i>Create responsive mobile interfaces</li>
                    </ul>
                    <a href="#" class="text-decoration-none">
                        Explore Mobile App Development Roadmap <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-primary">
                Explore All Technology Career Paths <i class="fas fa-arrow-right ms-1"></i>
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

</body>
</html>