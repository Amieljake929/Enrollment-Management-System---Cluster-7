<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bestlink College of the Philippines</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Add Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root{
            --primary-color:#1e3a8a;
            --secondary-color:#ffffff;
            --light-bg: #f8fafc;
             --sky-blue-1: #e6f4ff; /* Light Sky Blue 1 */
             --sky-blue-2: #d0ebff; /* Light Sky Blue 2 */
        }

        body{
            font-family:'Poppins',sans-serif;
            background-color:#fff;
            color:var(--primary-color);
            margin:0;
            padding:0;
            scroll-behavior:smooth;
        }

        /* ----- Navbar (transparent to solid on scroll) ----- */
        .navbar{
            position:fixed; width:100%;
            background-color:transparent !important;
            transition:background-color .4s ease, border-bottom .4s ease, box-shadow .4s ease;
            border-bottom:1px solid transparent;
            z-index:1030;
        }
        .navbar.scrolled{
            background-color:var(--primary-color) !important;
            border-bottom:none;
            box-shadow:0 8px 24px rgba(0,0,0,.2);
        }
        .navbar-brand,.nav-link{
            color:var(--secondary-color) !important;
            font-size:.95rem;
        }
        .nav-link:hover{ color:#bcd0ff !important; }
        .navbar-toggler:focus{ box-shadow:none; }

        @media (min-width: 992px){ .navbar-collapse-desktop{ display:flex !important; } }
        @media (max-width: 991.98px){ .navbar-collapse-desktop{ display:none; } }

        /* ----- Offcanvas (Mobile) ----- */
        .offcanvas-end{
            width:85%; max-width:360px;
            background-color:var(--primary-color);
            z-index:1040;
            box-shadow:-2px 0 15px rgba(0,0,0,.15);
        }
        .offcanvas-body{ padding:2rem 1.5rem; }
        .offcanvas-body .nav-link{
            color:var(--secondary-color) !important;
            font-size:1rem; padding:.75rem 0;
            border-bottom:1px solid rgba(255,255,255,.1);
        }
        .offcanvas-body .dropdown-menu{
            background-color:#f8f9fa; border:none; border-radius:8px;
            box-shadow:0 4px 12px rgba(0,0,0,.1); margin-top:5px;
        }
        .offcanvas-body .dropdown-item{ color:var(--primary-color) !important; }
        .offcanvas-body .dropdown-item:hover{ background-color:#e6f0ff; }
        .offcanvas-header .btn-close{ filter:invert(1); }
        .offcanvas-backdrop{ display:none !important; }

        /* ----- HERO: Fullscreen Video Background + Filter ----- */
        .hero{
            position:relative; height:100vh; min-height:600px; overflow:hidden;
            display:flex; align-items:center; justify-content:center; text-align:center;
            margin-top:0; color:#fff;
            isolation:isolate;
        }
        .hero video.hero-video{
            position:absolute; inset:0; width:100%; height:100%;
            object-fit:cover; z-index:-3;
            transform:translateZ(0);
        }
        .hero::before{
            content:""; position:absolute; inset:0; z-index:-2;
            background:
                linear-gradient(to bottom, rgba(0,0,0,.45) 0%, rgba(0,0,0,.25) 35%, rgba(0,0,0,.45) 100%),
                radial-gradient(1200px 600px at 80% 10%, rgba(30,58,138,.35), transparent 60%),
                radial-gradient(1000px 500px at 10% 90%, rgba(30,58,138,.35), transparent 60%);
            mix-blend-mode: multiply;
        }
        .video-filter{
            position:absolute; inset:0; z-index:-1;
            background: rgba(30,58,138,.25);
            backdrop-filter: saturate(120%) contrast(105%) brightness(95%);
        }

        .hero-content{ z-index:1; max-width:850px; padding:0 24px; }
        .hero h1{
            font-size:clamp(2.2rem, 4vw + 1rem, 3.75rem);
            font-weight:800; letter-spacing:.5px;
            text-shadow:0 2px 14px rgba(0,0,0,.55);
            margin-bottom:1rem;
        }
        .hero .lead{
            font-size:clamp(1rem, .6vw + .9rem, 1.3rem);
            text-shadow:0 1px 6px rgba(0,0,0,.45);
            margin-bottom:2rem;
        }
        .btn-cta{
            --bs-btn-color: var(--primary-color);
            --bs-btn-bg: #fff; --bs-btn-border-color:#fff;
            --bs-btn-hover-bg:#e6f0ff; --bs-btn-hover-border-color:#e6f0ff;
            --bs-btn-padding-x: 2rem; --bs-btn-padding-y: .9rem;
            --bs-btn-border-radius: 50rem;
            transition: transform 1.5s ease, box-shadow 1.5s ease;
            box-shadow:0 8px 24px rgba(0,0,0,.18);
        }
        .btn-cta:hover{ transform: translateY(-2px); box-shadow:0 12px 28px rgba(0,0,0,.2); }


        .container-fluid {
           padding-left: 0;
           padding-right: 0;
              }
            .section {
              padding: 70px 0;
               background-color: var(--light-bg);
              border-bottom: 1px solid rgba(30,58,138,0.05);
                 }
.section:nth-of-type(odd) {
    background-color: var(--sky-blue-1);
}
.section:nth-of-type(even) {
    background-color: var(--sky-blue-2);
}
        h2{
            color:var(--primary-color); position:relative; display:inline-block; margin-bottom:30px; /* Reduced from 40px */
            font-weight: 600;
        }
        h2::after{
            content:""; position:absolute; bottom:-8px; left:50%; transform:translateX(-50%);
            width:80px; height:3px; background:linear-gradient(to right, var(--primary-color), #a9c1e8);
            border-radius:2px;
        }

        /* ----- Parallax decorative shapes (brand subtle) ----- */
        .parallax-bubble{
            position:absolute; border-radius:50%;
            background: radial-gradient(circle at 30% 30%, rgba(169,193,232,.35), rgba(30,58,138,.18));
            filter: blur(2px);
            pointer-events:none;
            z-index:0;
        }
        .bubble-1{ width:220px; height:220px; top:-60px; left:-60px; }
        .bubble-2{ width:280px; height:280px; right:-80px; bottom:-80px; }
        .bubble-3{ width:160px; height:160px; left:5%; bottom:10%; }

        /* ----- Cards & images hover ----- */
        .card{
            transition: transform 0.5s ease, box-shadow 0.5s ease, border-color .35s ease;
            border:0;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 16px rgba(30,58,138,0.06);
        }
        .card:hover{ transform: translateY(-6px); box-shadow:0 16px 40px rgba(30,58,138,.12); }
        .card-img-top{ transition: transform 1.6s ease; }
        .card:hover .card-img-top{ transform: scale(1.04); }

        /* ----- Reveal animations (IntersectionObserver) ----- */
        .reveal{ opacity:0; transform: translateY(18px); transition: opacity 1.5s ease, transform .8s cubic-bezier(.2,.65,.2,1); }
        .reveal.show{ opacity:1; transform: translateY(0); }
        .reveal-up{ opacity:0; transform: translateY(30px); transition: opacity 1.5s ease, transform .9s cubic-bezier(.2,.65,.2,1); }
        .reveal-up.show{ opacity:1; transform: translateY(0); }

        /* ----- Video Animation ----- */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(30,58,138,0.15);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            animation: float 4s ease-in-out infinite;
        }
        .video-container:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(30,58,138,0.25);
            animation-play-state: paused;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 10px 30px rgba(30,58,138,0.15); }
            50% { box-shadow: 0 10px 40px rgba(30,58,138,0.25); }
        }

        .video-container.animated {
            animation: pulse 3s ease-in-out infinite;
        }

        /* ----- Footer ----- */
        footer{
            background-color:var(--primary-color);
            color:var(--secondary-color); 
            padding:60px 0 30px; 
            margin-top:0;
            position: relative;
        }
        footer .container {
            position: relative;
            z-index: 2;
        }
        footer::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.3), transparent);
            z-index: 1;
        }
        footer p {
            margin: 8px 0;
            font-size: 0.95rem;
            transition: color 1.3s ease;
        }
        footer p:hover {
            color: #bcd0ff;
        }
        footer .social-icons {
            margin-top: 20px;
        }
        footer .social-icons a {
            display: inline-block;
            margin: 0 8px;
            color: var(--secondary-color);
            font-size: 1.2rem;
            transition: transform 1.3s ease, color 1.3s ease;
        }
        footer .social-icons a:hover {
            color: #bcd0ff;
            transform: translateY(-3px);
        }
        .footer-bottom {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 0.9rem;
        }

        /* Content Spacing Tweaks */
        .section .row {
    margin-left: 0;
    margin-right: 0;
}
        .card-body { padding: 1.5rem; }
        .card-title { font-weight: 600; margin-bottom: 0.75rem; }
        .card-text { font-size: 0.95rem; line-height: 1.6; }

        /* Button Consistency */
        .btn-outline-light {
            transition: all 1.3s ease;
        }
        .btn-outline-light:hover {
            background: #1e3a8a !important;
            border-color: #1e3a8a !important;
            color: white !important;
        }
       /* ----- Floating Stats — Refined Icons & Spacing ----- */
.stat-item {
    padding: 2rem 1rem; /* 👈 Increased vertical padding */
    border-radius: 16px;
    transition: all 0.45s cubic-bezier(0.2, 0.65, 0.2, 1);
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 160px; /* 👈 Slightly taller for balance */
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}
.stat-item:hover {
    transform: translateY(-8px);
}
.stat-item::before {
    content: '';
    position: absolute;
    top: 0; left: 50%; transform: translateX(-50%);
    width: 0;
    height: 3px;
    background: linear-gradient(to right, var(--primary-color), #a9c1e8);
    border-radius: 2px;
    transition: width 0.4s ease;
}
.stat-item:hover::before {
    width: 60px;
}

/* ICONS — Unified Color & Style */
.stat-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(30, 58, 138, 0.03); /* Very subtle tint */
    border-radius: 50%;
    transition: all 0.35s ease;
    color: var(--primary-color); /* 👈 Unified color */
}
.stat-item:hover .stat-icon {
    background: rgba(30, 58, 138, 0.06);
    transform: scale(1.12);
}

/* Icon Color Class (optional override) */
.stat-icon-color {
    color: var(--primary-color) !important;
}

.stat-number {
    font-size: 1.85rem;
    font-weight: 700;
    color: var(--primary-color);
    line-height: 1.2;
    transition: color 0.3s ease;
    margin-top: 0.25rem;
}
.stat-label {
    margin: 0;
    line-height: 1.4;
    color: #555;
    transition: color 0.3s ease;
    font-weight: 500;
}

/* Highlight Item (NO TUITION) */
.highlight-item {
    padding: 2rem 1rem;
}
.highlight-item .stat-number {
    color: #dc2626;
    font-size: 2rem;
}
.highlight-item .stat-label {
    color: #444;
}
.highlight-item .badge {
    font-size: 0.65rem;
    padding: 0.35em 0.6em;
    letter-spacing: 0.5px;
    font-weight: 600;
}
.highlight-item:hover .stat-number,
.highlight-item:hover .stat-label {
    color: #b91c1c;
}

/* Animation: Float for stat items */
@keyframes floatStat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
.stat-item.animated {
    animation: floatStat 3s ease-in-out infinite;
}
.stat-item.animated:hover {
    animation-play-state: paused;
}
/* Hover Opacity Transition */
.hover-opacity-100 {
    opacity: 1 !important;
}
.opacity-0 {
    opacity: 0;
}
.transition-opacity {
    transition: opacity 0.3s ease;
}

/* Button hover effect */
.btn-outline-primary:hover {
    background-color: var(--primary-color);
    color: white !important;
}
/* Hover effect for mission/vision cards */
.card-body:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.12);
    transition: all 0.3s ease;
}

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('images/bcp.png') }}" alt="Bestlink College Logo" width="60" height="60" class="img-fluid rounded" />
                <div>
                    <span class="d-block">Bestlink College</span>
                    <span class="d-block" style="font-size:.75rem;">of the Philippines</span>
                </div>
            </a>

            <div class="collapse navbar-collapse navbar-collapse-desktop" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#aboutus">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#campuses">Campuses</a></li>
                    <li class="nav-item"><a class="nav-link" href="#future">Mission & Vision</a></li>
                    <li class="nav-item"><a class="nav-link" href="#admission">Admission</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bcpnews">BCP News</a></li>
                    <li class="nav-item"><a class="nav-link" href="#facilities">School Facilities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#careers">Organizations</a></li>
                    <li class="nav-item ms-lg-3">
    <a href="{{ route('login') }}" class="btn" style="background-color: #1e3a8a; color: white; padding: 0.5rem 1.25rem; border-radius: 50rem; font-weight: 500; font-size: 1.05rem;">
        <i class="fas fa-sign-in-alt me-1"></i> Sign In
    </a>
</li>
                </ul>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- HERO: Video Background -->
    <section class="hero text-white position-relative">
        <video class="hero-video" autoplay muted loop playsinline preload="auto" poster="{{ asset('images/pcb.jpg') }}">
            <source src="{{ asset('images/montagee.mp4') }}" type="video/mp4">
        </video>
        <div class="video-filter"></div>

        <!-- Decorative parallax bubbles (subtle) -->
        <span class="parallax-bubble bubble-1" data-parallax data-speed="0.25"></span>
        <span class="parallax-bubble bubble-2" data-parallax data-speed="-0.15"></span>
        <span class="parallax-bubble bubble-3" data-parallax data-speed="0.18"></span>

        <div class="hero-content">
            <h1 class="reveal">Welcome to Bestlink College Of The Philippines</h1>
            <p class="lead reveal-up">We provide quality education to make students globally competitive and productive citizens.</p>
            <form action="{{ route('two') }}" method="GET" class="reveal-up">
                <button type="submit" class="btn btn-light btn-lg btn-cta">
                    Get Started
                </button>
            </form>
        </div>
    </section>

    <!-- Offcanvas Mobile Menu -->
    <div class="offcanvas offcanvas-end text-white" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav flex-column">
                <li class="nav-item"><a class="nav-link py-3 border-bottom" href="#aboutus">About Us</a></li>
                <li class="nav-item"><a class="nav-link py-3 border-bottom" href="#admission">Admission</a></li>
                <li class="nav-item"><a class="nav-link py-3 border-bottom" href="#bcpnews">BCP News</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle py-3 border-bottom" href="#" id="mobileStudentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Student Personnel Services</a>
                    <ul class="dropdown-menu w-100" aria-labelledby="mobileStudentDropdown">
                        <li><a class="dropdown-item" href="#guidance">Guidance Services</a></li>
                        <li><a class="dropdown-item" href="#counseling">Counseling</a></li>
                        <li><a class="dropdown-item" href="#studentaffairs">Student Affairs</a></li>
                        <li><a class="dropdown-item" href="#registrar">Registrar</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle py-3 border-bottom" href="#" id="mobileAcademicsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Academics</a>
                    <ul class="dropdown-menu w-100" aria-labelledby="mobileAcademicsDropdown">
                        <li><a class="dropdown-item" href="#shsprograms">Senior High School Programs</a></li>
                        <li><a class="dropdown-item" href="#collegeprograms">College Programs</a></li>
                        <li><a class="dropdown-item" href="#faculty">Faculty</a></li>
                        <li><a class="dropdown-item" href="#academiccalendar">Academic Calendar</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link py-3 border-bottom" href="#careers">Careers</a></li>
                <li class="nav-item"><a class="nav-link py-3 border-bottom" href="#alumni">Alumni</a></li>
                <li class="nav-item"><a class="nav-link py-3 border-bottom" href="#facilities">School Facilities</a></li>
                <li class="nav-item mt-3">
    <a href="{{ route('login') }}" class="btn w-100" style="background-color: #5044e4; color: white; padding: 0.75rem; border-radius: 50rem; font-weight: 500; font-size: 1.1rem;">
        <i class="fas fa-sign-in-alt me-2"></i> Sign In
    </a>
</li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container-fluid">
        

        <!-- About Us -->
<section id="aboutus" class="section">
    <div class="row align-items-center justify-content-center text-center">

        <!-- ============ ENHANCED STATS SECTION ============ -->
<div class="col-lg-10 mx-auto">

    <!-- HEADLINE -->
    <div class="text-center mb-5 reveal-up">
        <h2 class="fw-bold" style="font-size: 1.7rem; letter-spacing: -0.5px; color: var(--primary-color);">
            Why Thousands Choose Bestlink College
        </h2>
        <p class="text-muted mx-auto" style="max-width: 700px; font-size: 1rem; line-height: 1.6;">
            Affordable excellence, future-ready programs, and a community that grows with you — from Senior High to Global Graduation.
        </p>
    </div>

    <!-- FLOATING STATS -->
    <div class="row g-4 justify-content-center mb-5">
        <!-- Stat 1: Year of Excellency -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-item text-center h-100">
                <div class="stat-icon mb-2">
                    <i class="fas fa-award stat-icon-color" style="font-size: 1.6rem;"></i>
                </div>
                <h5 class="mb-1 fw-bold stat-number" data-value="23">0</h5>
                <p class="text-muted small stat-label">Years of<br>Excellence</p>
            </div>
        </div>

        <!-- Stat 2: SHS Programs -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-item text-center h-100">
                <div class="stat-icon mb-2">
                    <i class="fas fa-user-graduate stat-icon-color" style="font-size: 1.6rem;"></i>
                </div>
                <h5 class="mb-1 fw-bold stat-number" data-value="19">0</h5>
                <p class="text-muted small stat-label">SHS<br>Tracks</p>
            </div>
        </div>

        <!-- Stat 3: College Programs -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-item text-center h-100">
                <div class="stat-icon mb-2">
                    <i class="fas fa-building-columns stat-icon-color" style="font-size: 1.6rem;"></i>
                </div>
                <h5 class="mb-1 fw-bold stat-number" data-value="26">0</h5>
                <p class="text-muted small stat-label">College<br>Degrees</p>
            </div>
        </div>

        <!-- Stat 4: 30,000+ Students -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="stat-item text-center h-100">
                <div class="stat-icon mb-2">
                    <i class="fas fa-people-group stat-icon-color" style="font-size: 1.6rem;"></i>
                </div>
                <h5 class="mb-1 fw-bold stat-number" data-value="30000">0</h5>
                <p class="text-muted small stat-label">Learners<br>Nationwide</p>
            </div>
        </div>

        <!-- Stat 5: NO TUITION -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="stat-item highlight-item text-center h-100">
                <div class="stat-icon mb-2">
                    <i class="fas fa-hand-holding-dollar stat-icon-color" style="font-size: 1.6rem;"></i>
                </div>
                <h5 class="mb-1 fw-bold stat-number" data-value="4975">₱0</h5>
                <p class="text-muted small stat-label">Per Semester<br><span class="badge bg-danger text-white mt-1">NO TUITION • 0% INTEREST</span></p>
            </div>
        </div>
    </div>

    <!-- TAGLINE BELOW STATS -->
    <div class="text-center reveal-up mb-5">
        <p class="fw-medium text-dark" style="font-size: 1.05rem; max-width: 750px; margin: 0 auto; line-height: 1.6;">
            <i class="fas fa-check-circle text-success me-2"></i>
            No hidden fees. No debt. Just world-class education within reach.
        </p>
    </div>
</div>

        <!-- Logos with vertical bar -->
        <div class="col-lg-8 mb-4 reveal">
            <div class="d-flex justify-content-center gap-2 align-items-center">
                <img src="{{ asset('images/pcb.png') }}" alt="PCB Logo" width="120" height="120" class="img-fluid" style="border:none; box-shadow:none;" />
                <img src="{{ asset('images/bcp.png') }}" alt="BCP Logo" width="75" height="75" class="img-fluid" style="border:none; box-shadow:none;" />
            </div>
        </div>

        <!-- Centered & Justified Paragraph -->
        <div class="col-lg-8 mb-4 reveal-up">
            <p class="lead" style="font-size: 1rem; text-align: left;">
                Bestlink College of the Philippines (BCP) is a premier educational institution committed to providing
                 quality Senior High School and College education that is both accessible and relevant. Our core mission
                  is to diligently nurture competent, responsible, and globally competitive graduates. We achieve this through 
                  the use of innovative teaching methodologies, a faculty of highly qualified and dedicated educators, and
                  comprehensive community engagement programs that instill social awareness and civic responsibility in our 
                  students. BCP focuses on developing not just academic excellence, but also essential life skills, strong values,
                   and professional ethics that will enable our alumni to excel in their chosen careers and contribute positively
                    to national development. We are dedicated to empowering the next generation of leaders and professionals.
            </p>
            
        </div>

        <!-- YouTube Video -->
        <div class="col-lg-8 mb-4 reveal">
            <div class="video-container animated">
                <iframe 
                    src="https://www.youtube.com/embed/IyZtaIV0QYc?si=2L-9J4J82Ssi3vlD" 
                    title="Bestlink College Overview" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>

         <!-- Sentence below video -->
        <div class="col-lg-8 mb-4 reveal-up">
            <p class="small text-muted">
                Click the video to learn more about our campus, values, and student life.
            </p>
        </div>

        <!-- Text + Line Design (Inspired by Enderun) -->
        <div class="col-lg-8 mb-4 reveal-up">
            <div class="text-center">
                <p class="fw-bold mb-1" style="font-size: 1.5rem; letter-spacing: 1px;">Bestlink College Of the Philippines Campuses</p>
                <div class="w-50 mx-auto my-2 d-flex justify-content-center">
                    
                </div>
            </div>
        </div>

        <!-- Campus Cards Section -->
<div id="campuses" class="col-lg-8 mb-5 reveal">
    <h3 class="text-center fw-bold mb-4" style="color: var(--primary-color);">Our Campuses</h3>
    <div class="row g-4 justify-content-center">

        <!-- Main Campus Card -->
        <div class="col-12 col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="position-relative">
                    <img src="{{ asset('images/main.jpg') }}" 
                         class="card-img-top img-fluid" 
                         alt="Main Campus" 
                         style="height: 200px; object-fit: cover; width: 100%;"
                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-10 d-flex align-items-center justify-content-center opacity-0 hover-opacity-100 transition-opacity">
                        <i class="fas fa-map-marker-alt text-white fa-2x"></i>
                    </div>
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Main Campus</h5>
                    <p class="card-text text-muted small">#1071 Brgy. Kaligayahan, Quirino Highway, Novaliches, Quezon City</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">Explore Campus</a>
                </div>
            </div>
        </div>

        <!-- MV Campus Card -->
        <div class="col-12 col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="position-relative">
                    <img src="{{ asset('images/pcb.jpg') }}" 
                         class="card-img-top img-fluid" 
                         alt="MV Campus" 
                         style="height: 200px; object-fit: cover; width: 100%;"
                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-10 d-flex align-items-center justify-content-center opacity-0 hover-opacity-100 transition-opacity">
                        <i class="fas fa-map-marker-alt text-white fa-2x"></i>
                    </div>
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">MV Campus</h5>
                    <p class="card-text text-muted small">Millionaires Village, Topaz St., Brgy. San Agustin, Novaliches, Quezon City</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">Explore Campus</a>
                </div>
            </div>
        </div>

        <!-- Bulacan Campus Card -->
        <div class="col-12 col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="position-relative">
                    <img src="{{ asset('images/bulacan.jpg') }}" 
                         class="card-img-top img-fluid" 
                         alt="Bulacan Campus" 
                         style="height: 200px; object-fit: cover; width: 100%;"
                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-10 d-flex align-items-center justify-content-center opacity-0 hover-opacity-100 transition-opacity">
                        <i class="fas fa-map-marker-alt text-white fa-2x"></i>
                    </div>
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Bulacan Campus</h5>
                    <p class="card-text text-muted small">IPO Road, Barangay Minuyan Proper, City of San Jose Del Monte, Bulacan. </p>
                    <a href="#" class="btn btn-outline-primary btn-sm">Explore Campus</a>
                </div>
            </div>
        </div>

    </div>
</div>

        <!-- Additional Paragraphs -->
        <div class="col-lg-8 mb-4 reveal-up">
             <p class="text-start" style="font-size: 1rem; text-align: left;">
                Bestlink College is now offering a Articulation Program to its students. This unique partnership provides students a chance to study two years in the Philippines before transferring to Hawai'i for their final two years of study and graduating with a US Bachelor's Degree diploma.
            </p>
             <p class="text-start" style="font-size: 1rem; text-align: left;">
                Students start their journey at Bestlink College, where they complete their freshman and sophomore education under our faculty of international professors and industry experts. Following this foundation in the Philippines, students are presented with the opportunity to transfer to the University of Hawai'i West O'ahu for their junior and senior years.
            </p>
        </div>
    </div>
</section>

<!-- MISSION & VISION SECTION (Enhanced) -->
<section id="future" class="section py-5" style="background: linear-gradient(135deg, #cddfec 0%, #e6f4ff 100%);">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 reveal-up">
            <h2 class="fw-bold display-6" style="color: var(--primary-color); font-size: 2rem; letter-spacing: -0.5px;">
                Our Core Purpose
            </h2>
            <p class="text-muted mx-auto" style="max-width: 700px; font-size: 1.05rem; line-height: 1.6;">
                Guided by our mission and vision, we empower students to become leaders of tomorrow.
            </p>
        </div>
        <div class="row g-4">
            <!-- Mission Card (Enhanced) -->
            <div class="col-lg-6 mb-4 reveal">
                <div class="card border-0 rounded-4 shadow-lg h-100 overflow-hidden" style="background: linear-gradient(to right, #dbeafe, #eff6ff);">
                    <div class="card-body p-5 d-flex flex-column align-items-center text-center">
                        <div class="icon-wrapper mb-4">
                            <div class="rounded-circle bg-primary text-white p-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-bullseye fa-2x"></i>
                            </div>
                        </div>
                        <h3 class="card-title fw-bold text-primary mb-4">Our Mission</h3>
                        <p class="card-text lead flex-grow-1" style="font-size: 1.1rem; line-height: 1.8; color: #1e293b;">
                            To produce a self-motivated and self-directed individual who aims for academic excellence, god-fearing, peaceful, healthy, productive and successful citizen.
                        </p>
                        <a href="#" class="btn btn-outline-primary mt-4 px-4">
                            <i class="fas fa-arrow-right me-2"></i> Learn More
                        </a>
                    </div>
                </div>
            </div>
            <!-- Vision Card (Enhanced) -->
            <div class="col-lg-6 mb-4 reveal-up">
                <div class="card border-0 rounded-4 shadow-lg h-100 overflow-hidden" style="background: linear-gradient(to right, #dcfce7, #f0fdf4);">
                    <div class="card-body p-5 d-flex flex-column align-items-center text-center">
                        <div class="icon-wrapper mb-4">
                            <div class="rounded-circle bg-success text-white p-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-eye fa-2x"></i>
                            </div>
                        </div>
                        <h3 class="card-title fw-bold text-success mb-4">Our Vision</h3>
                        <p class="card-text lead flex-grow-1" style="font-size: 1.1rem; line-height: 1.8; color: #1e293b;">
                            Bestlink College of the Philippines is committed to provide and promote quality education which unique modern and research-based curriculum with delivery system geared toward excellence.
                        </p>
                        <a href="#" class="btn btn-outline-success mt-4 px-4">
                            <i class="fas fa-arrow-right me-2"></i> Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ADMISSION SECTION -->
<section id="admission" class="section py-5">
    <div class="container">
        <!-- Title & Subtitle -->
        <div class="row justify-content-center text-center mb-5 reveal-up">
            <h2 class="fw-bold display-6" style="color: var(--primary-color); font-size: 2rem; letter-spacing: -0.5px;">
                <i class="fas fa-graduation-cap me-2"></i> Enrollment for Academic Year 2025–2026
            </h2>
            <p class="text-muted mx-auto" style="max-width: 700px; font-size: 1.05rem; line-height: 1.6;">
                Secure your spot now! Online enrollment is open and available for all programs.
            </p>
        </div>

        <!-- Grid Layout: 4 Cards on Left + Illustration on Right -->
        <div class="row g-4 align-items-stretch">
            <!-- Left Side: 4 Cards in 2x2 Grid -->
            <div class="col-lg-8">
                <div class="row g-4">
                    <!-- Card 1: Enrollment Period -->
                    <div class="col-md-6 reveal">
                        <div class="card h-100 shadow-sm border-0 rounded-4 bg-white p-4 transition-all">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary text-white rounded-circle p-3 me-3">
                                    <i class="fas fa-calendar-alt fa-lg"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Enrollment Period</h5>
                            </div>
                            <p class="text-muted small mb-0">March 1 – June 30, 2025</p>
                        </div>
                    </div>

                    <!-- Card 2: Online Enrollment -->
                    <div class="col-md-6 reveal-up">
                        <div class="card h-100 shadow-sm border-0 rounded-4 bg-white p-4 transition-all">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary text-white rounded-circle p-3 me-3">
                                    <i class="fas fa-laptop-code fa-lg"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Online Enrollment</h5>
                            </div>
                            <p class="text-muted small mb-0">Available 24/7 via our portal</p>
                        </div>
                    </div>

                    <!-- Card 3: AI (Left) -->
                    <div class="col-md-6 reveal">
                        <div class="card h-100 shadow-sm border-0 rounded-4 bg-white p-4 transition-all">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary text-white rounded-circle p-3 me-3">
                                    <i class="fas fa-headset fa-lg"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">AI Assessment</h5>
                            </div>
                            <p class="text-muted small mb-0">A course suggestion using pre-trained AI <strong>Hugging Face</strong></p>
                        </div>
                    </div>

                    <!-- Card 4: Support (Right) -->
                    <div class="col-md-6 reveal-up">
                        <div class="card h-100 shadow-sm border-0 rounded-4 bg-white p-4 transition-all">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary text-white rounded-circle p-3 me-3">
                                    <i class="fas fa-headset fa-lg"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Quick And Easy</h5>
                            </div>
                            <p class="text-muted small mb-0">quick and easy access <strong>911</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Illustration -->
            <div class="col-lg-4 d-none d-lg-block reveal-up">
                <img src="{{ asset('images/admission.png') }}" 
                     alt="Students waiting in line" 
                     class="img-fluid rounded-4 shadow-sm" 
                     style="height: 300px; object-fit: cover; width: 100%;">
            </div>
        </div>
    </div>
</section>



<!-- NEWS & UPDATES SECTION -->
<section class="section" id="bcpnews" style="background: linear-gradient(135deg, #cddfec 0%, #e6f4ff 100%);">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 reveal-up">
            <h2 class="fw-bold display-6" style="color: var(--primary-color); font-size: 2rem; letter-spacing: -0.5px;">
                <i class="fas fa-newspaper me-2"></i> BCP News & Updates
            </h2>
            <p class="text-muted mx-auto" style="max-width: 700px; font-size: 1.05rem; line-height: 1.6;">
                Stay updated with the latest events, achievements, and announcements from Bestlink College.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @php
                $news = [
                    [
                        'title' => 'BCP Wins National Robotics Competition',
                        'date' => 'June 15, 2025',
                        'image' => 'images/Guidance.png',
                        'desc' => 'Our BSIT students brought home the gold at the National TechFest 2025, showcasing innovation and engineering excellence.'
                    ],
                    [
                        'title' => 'SHS Graduation 2025: 98% Passing Rate',
                        'date' => 'May 30, 2025',
                        'image' => 'images/faculty.jpg',
                        'desc' => 'Celebrating academic excellence! 98% of our Senior High graduates passed college entrance exams with flying colors.'
                    ],
                    [
                        'title' => 'New Partnership with UH West O’ahu',
                        'date' => 'April 10, 2025',
                        'image' => 'images/seminar.jpg',
                        'desc' => 'Exciting news! BCP students can now transfer to University of Hawai’i for their final 2 years and earn a US degree.'
                    ],
                    [
                        'title' => 'Campus Expansion in Bulacan Completed',
                        'date' => 'March 22, 2025',
                        'image' => 'images/research.jpg',
                        'desc' => 'Our new Bulacan campus is now fully operational, featuring state-of-the-art classrooms and student amenities.'
                    ]
                ];
            @endphp

            @foreach($news as $item)
                <div class="col-12 col-md-6 col-lg-3 reveal{{ $loop->index }}">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <img src="{{ asset($item['image']) }}" class="card-img-top img-fluid" alt="{{ $item['title'] }}" style="height: 180px; object-fit: cover;" onerror="this.src='{{ asset('images/placeholder.jpg') }}';">
                            <div class="position-absolute top-0 start-0 bg-primary text-white px-2 py-1 small">
                                {{ $item['date'] }}
                            </div>
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-10 d-flex align-items-center justify-content-center opacity-0 hover-opacity-100 transition-opacity">
                                <i class="fas fa-newspaper text-white fa-2x"></i>
                            </div>
                        </div>
                        <div class="card-body text-center d-flex flex-column">
                            <h6 class="card-title fw-bold text-truncate">{{ $item['title'] }}</h6>
                            <p class="card-text text-muted small flex-grow-1" style="font-size: 0.85rem; line-height: 1.4;">
                                {{ $item['desc'] }}
                            </p>
                            <a href="#" class="btn btn-outline-primary btn-sm mt-auto">
                                <i class="fas fa-arrow-right me-1"></i> Read More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SCHOOL FACILITIES SECTION -->
<section class="section" id="facilities">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 reveal-up">
            <h2 class="fw-bold display-6" style="color: var(--primary-color); font-size: 2rem; letter-spacing: -0.5px;">
                <i class="fas fa-building me-2"></i> School Facilities
            </h2>
            <p class="text-muted mx-auto" style="max-width: 700px; font-size: 1.05rem; line-height: 1.6;">
                Modern, safe, and inspiring learning environments designed to support academic excellence and holistic development.
            </p>
        </div>

        <div class="row g-4">
            @php
                $facilities = [
                    [
                        'title' => 'Modern Computer Labs',
                        'image' => 'images/comlab.jpg',
                        'desc' => 'Equipped with high-end PCs, licensed software, and high-speed internet, our computer labs provide students with hands-on experience in IT, programming, and digital design. Perfect for BSIT and ICT students to master real-world tech skills.'
                    ],
                    [
                        'title' => 'Science & Research Laboratories',
                        'image' => 'images/faculty.jpg',
                        'desc' => 'Fully-equipped chemistry, biology, and physics labs that support STEM curriculum. Students conduct experiments, research projects, and develop scientific inquiry skills under the guidance of expert faculty members.'
                    ],
                    [
                        'title' => 'Culinary & Hospitality Training Center',
                        'image' => 'images/faculty.jpg',
                        'desc' => 'A professional-grade kitchen and dining simulation area where Hospitality and Tourism Management students practice food preparation, service etiquette, and event management in a real-world environment.'
                    ],
                    [
                        'title' => 'Library & Learning Commons',
                        'image' => 'images/library.jpg',
                        'desc' => 'A quiet, air-conditioned space with thousands of books, e-resources, study pods, and group collaboration areas. Free Wi-Fi and research assistance available to all students pursuing academic excellence.'
                    ],
                    [
                        'title' => 'Performing Arts Theater',
                        'image' => 'images/amphi.jpg',
                        'desc' => 'A fully-staged theater with lighting, sound system, and backstage area. Home to HUMSS and Performing Arts students for drama, music, and cultural presentations that build confidence and creativity.'
                    ],
                    [
                        'title' => 'Sports & Recreation Complex',
                        'image' => 'images/gymnasium.jpg',
                        'desc' => 'Includes a basketball court, fitness gym, and open fields. Promotes physical wellness, teamwork, and school spirit. Regular tournaments and PE classes held here to develop discipline and leadership.'
                    ]
                ];
            @endphp

            @foreach($facilities as $facility)
                <div class="col-md-6 col-lg-4 reveal{{ $loop->index % 2 == 0 ? '' : '-up' }}">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden hover-scale">
                        <img src="{{ asset($facility['image']) }}" class="card-img-top" alt="{{ $facility['title'] }}" style="height: 200px; object-fit: cover;" onerror="this.src='{{ asset('images/placeholder.jpg') }}';">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-primary">{{ $facility['title'] }}</h5>
                            <p class="card-text flex-grow-1 small text-muted" style="line-height: 1.6;">
                                {{ $facility['desc'] }}
                            </p>
                            <a href="#" class="btn btn-outline-primary btn-sm mt-auto align-self-start">
                                <i class="fas fa-info-circle me-1"></i> Learn More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ORGANIZATIONS SECTION -->
<section class="section" id="careers">
    <div class="container">
        <div class="row justify-content-center text-center mb-5 reveal-up">
            <h2 class="fw-bold display-6" style="color: var(--primary-color); font-size: 2rem; letter-spacing: -0.5px;">
                <i class="fas fa-users me-2"></i> Student Organizations
            </h2>
            <p class="text-muted mx-auto" style="max-width: 700px; font-size: 1.05rem; line-height: 1.6;">
                Discover dynamic student-led groups that foster leadership, service, and camaraderie.
            </p>
        </div>
        <div class="row g-4 justify-content-center">
            @php
                $organizations = [
                    ['name' => 'Information Technology Arnis Klab (I.T.A.K.)', 'image' => 'org1.jpg'],
                    ['name' => 'Bestlink College Debate Society', 'image' => 'org2.jpg'],
                    ['name' => 'BCP Environmental Advocates', 'image' => 'org3.jpg'],
                    ['name' => 'Future Business Leaders of the Philippines', 'image' => 'org4.jpg'],
                    ['name' => 'Psychology Students Circle', 'image' => 'org5.jpg'],
                    ['name' => 'BCP Performing Arts Guild', 'image' => 'org6.jpg'],
                    ['name' => 'Engineering Innovators Club', 'image' => 'org7.jpg'],
                    ['name' => 'Culinary & Hospitality Student Org', 'image' => 'org8.jpg'],
                    ['name' => 'Business Administration Organization', 'image' => 'org9.jpg'],
                ];
            @endphp

            @foreach($organizations as $index => $org)
                <div class="col-6 col-md-4 col-lg-3 reveal{{ $index % 2 == 0 ? '' : '-up' }}">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <img src="{{ asset('images/' . $org['image']) }}" 
                                 class="card-img-top img-fluid" 
                                 alt="{{ $org['name'] }}" 
                                 style="height: 180px; object-fit: cover; width: 100%;"
                                 onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-10 d-flex align-items-center justify-content-center opacity-0 hover-opacity-100 transition-opacity">
                                <i class="fas fa-users text-white fa-2x"></i>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h6 class="card-title fw-bold">{{ $org['name'] }}</h6>
                            <a href="#" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="fas fa-info-circle me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .hover-scale { transition: transform 0.3s ease; }
    .hover-scale:hover { transform: translateY(-5px); }
</style>










       

    </main>

    <!-- Footer -->
    <!-- Footer -->
<footer class="text-light pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <!-- About Column -->
            <div class="col-md-4">
                <img src="{{ asset('images/bcp.png') }}" alt="Bestlink College Logo" height="50" class="mb-3" />
                <p class="text-light">
                    Bestlink College of the Philippines is committed to excellence in education and student development.
                </p>
            </div>

            <!-- Contact Us Column -->
            <div class="col-md-4">
                <h5 class="text-light">Contact Us</h5>
                <p>
                    <i class="bi bi-geo-alt-fill me-2"></i> MV Branch: #1071 Quirino Highway, Quezon City<br />
                    <i class="bi bi-geo-alt-fill me-2"></i> Bulacan Branch: IPO Road, San Jose Del Monte, Bulacan<br />
                    <i class="bi bi-telephone-fill me-2"></i>417-4355<br/>
                    <i class="bi bi-envelope-fill me-2"></i>bcp-inquiry@bcp.edu.ph
                </p>
            </div>

            <!-- Stay Connected Column -->
            <div class="col-md-4">
                <h5 class="text-light">Stay Connected</h5>
                <div class="d-flex mb-3">
                    <a href="#" class="social-icon text-light me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon text-light me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon text-light me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon text-light me-3"><i class="bi bi-youtube"></i></a>
                </div>
                <div>
                    <p class="mb-2">Subscribe to our newsletter:</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email" />
                        <button class="btn btn-outline-light" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider & Copyright -->
        <hr class="mt-4 mb-3" style="border-color: rgba(255,255,255,0.2);" />
        <p class="text-center mb-0">&copy; 2025 Bestlink College of the Philippines. All rights reserved.</p>
    </div>
</footer>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS: navbar scroll, offcanvas, reveal + parallax -->
    <script>
        // Navbar: transparent to solid
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            if ((window.scrollY || document.documentElement.scrollTop) > 50){
                navbar.classList.add('scrolled');
            }else{
                navbar.classList.remove('scrolled');
            }
        });

        // Offcanvas: close only when real nav link
        document.querySelectorAll('#mobileMenu .nav-link').forEach(link=>{
            link.addEventListener('click', function(){
                if (this.classList.contains('dropdown-toggle')) return;
                const offcanvasEl = document.getElementById('mobileMenu');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (offcanvas) offcanvas.hide();
            });
        });

        // Reveal on scroll (IntersectionObserver)
        const io = new IntersectionObserver((entries)=>{
            entries.forEach(entry=>{
                if(entry.isIntersecting){
                    entry.target.classList.add('show');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal, .reveal-up').forEach(el=> io.observe(el));

        // Lightweight parallax for elements with data-parallax
        const parallaxEls = document.querySelectorAll('[data-parallax]');
        const parallax = ()=>{
            const scroll = window.scrollY || document.documentElement.scrollTop;
            parallaxEls.forEach(el=>{
                const speed = parseFloat(el.getAttribute('data-speed')) || 0.2;
                el.style.transform = `translate3d(0, ${scroll * speed}px, 0)`;
            });
        };
        window.addEventListener('scroll', parallax, { passive: true });

        // Ensure video autoplays on iOS (muted+playsinline already set)
        const heroVideo = document.querySelector('.hero-video');
        if (heroVideo){
            const tryPlay = ()=> heroVideo.play().catch(()=>{});
            document.addEventListener('click', tryPlay, { once:true });
            document.addEventListener('touchstart', tryPlay, { once:true });
        }

        // Animate Numbers (Counter) - Fixed Version
function animateValue(element, start, end, duration) {
    let startTime = null;
    const step = (timestamp) => {
        if (!startTime) startTime = timestamp;
        const progress = Math.min((timestamp - startTime) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        element.textContent = value.toLocaleString();
        if (progress < 1) {
            window.requestAnimationFrame(step);
        } else {
            // Add "+" for 30,000+
            if (element.getAttribute('data-value') === '30000') {
                element.textContent += '+';
            }
            // Add "₱" for tuition
            if (element.getAttribute('data-value') === '4975') {
                element.textContent = '₱' + element.textContent;
            }
        }
    };
    window.requestAnimationFrame(step);
}

// Trigger on scroll
const statNumberObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const el = entry.target;
            const value = el.getAttribute('data-value');
            if (value) {
                const end = parseInt(value.replace(/,/g, ''));
                animateValue(el, 0, end, 2000);
            }
            statNumberObserver.unobserve(el);
        }
    });
}, { threshold: 0.3 });

document.querySelectorAll('.stat-number[data-value]').forEach(el => {
    statNumberObserver.observe(el);
});
    </script>

    
</body>
</html>