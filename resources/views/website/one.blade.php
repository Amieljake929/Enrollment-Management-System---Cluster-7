<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bestlink College of the Philippines</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #ffffff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: white;
            color: var(--primary-color);
            margin: 0;
            padding: 0;
        }

        /* --- Navbar: Transparent at top, solid on scroll --- */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: transparent !important;
            transition: background-color 0.4s ease, border-bottom 0.4s ease;
            border-bottom: 1px solid transparent;
            z-index: 1030;
        }

        .navbar.scrolled {
            background-color: var(--primary-color) !important;
            border-bottom: none;
        }

        /* Navbar text and links */
        .navbar-brand, .nav-link {
            color: var(--secondary-color) !important;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            color: #bcd0ff !important;
        }

        /* Remove any unwanted backdrop or dimming */
        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Desktop: Show nav links only on large screens */
        @media (min-width: 992px) {
            .navbar-collapse-desktop {
                display: flex !important;
            }
        }

        @media (max-width: 991.98px) {
            .navbar-collapse-desktop {
                display: none;
            }
        }

        /* --- Offcanvas Menu (Mobile) --- */
        .offcanvas-end {
            width: 85%;
            max-width: 360px;
            background-color: var(--primary-color);
            z-index: 1040;
            box-shadow: -2px 0 15px rgba(0, 0, 0, 0.15);
        }

        .offcanvas-body {
            padding: 2rem 1.5rem;
        }

        .offcanvas-body .nav-link {
            color: var(--secondary-color) !important;
            font-size: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .offcanvas-body .dropdown-toggle::after {
            margin-left: auto;
        }

        .offcanvas-body .dropdown-menu {
            background-color: #f8f9fa;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 5px;
        }

        .offcanvas-body .dropdown-item {
            color: var(--primary-color) !important;
        }

        .offcanvas-body .dropdown-item:hover {
            background-color: #e6f0ff;
        }

        .offcanvas-header .btn-close {
            filter: invert(1);
        }

        /* --- Hero Section: Full Video Background --- */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 600px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            margin-top: 0; /* Ensures no gap */
        }

        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* Fallback background if video fails */
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('images/hero-bg.jpg') }}') center/cover no-repeat;
            z-index: -1;
            opacity: 0.7;
        }

        .hero-content {
            z-index: 1;
            max-width: 800px;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
            margin-bottom: 1rem;
        }

        .hero .lead {
            font-size: 1.3rem;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
            }
            .hero .lead {
                font-size: 1rem;
            }
        }

        /* --- Section Styling --- */
        .section {
            padding: 80px 0;
        }

        h2 {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
            margin-bottom: 40px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), #a9c1e8);
            border-radius: 2px;
        }

        /* --- Footer --- */
        footer {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            padding: 30px 0;
            margin-top: 50px;
        }

        /* --- Prevent backdrop dimming --- */
        .offcanvas-backdrop {
            display: none !important;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <!-- Logo + School Name -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('images/pcb.png') }}" alt="Bestlink College Logo" width="70" height="70" class="img-fluid rounded" />
                <div>
                    <span class="d-block">Bestlink College</span>
                    <span class="d-block" style="font-size: 0.75rem;">of the Philippines</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <div class="collapse navbar-collapse navbar-collapse-desktop" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#aboutus">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#admission">Admission</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bcpnews">BCP News</a></li>

                    <!-- Student Personnel Services Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="studentDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Student Personnel Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="studentDropdown">
                            <li><a class="dropdown-item" href="#guidance">Guidance Services</a></li>
                            <li><a class="dropdown-item" href="#counseling">Counseling</a></li>
                            <li><a class="dropdown-item" href="#studentaffairs">Student Affairs</a></li>
                            <li><a class="dropdown-item" href="#registrar">Registrar</a></li>
                        </ul>
                    </li>

                    <!-- Academics Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="academicsDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Academics
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="academicsDropdown">
                            <li><a class="dropdown-item" href="#shsprograms">Senior High School Programs</a></li>
                            <li><a class="dropdown-item" href="#collegeprograms">College Programs</a></li>
                            <li><a class="dropdown-item" href="#faculty">Faculty</a></li>
                            <li><a class="dropdown-item" href="#academiccalendar">Academic Calendar</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="#careers">Careers</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alumni">Alumni</a></li>
                    <li class="nav-item"><a class="nav-link" href="#facilities">School Facilities</a></li>
                </ul>
            </div>

            <!-- Mobile Hamburger Button (on right) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                    aria-controls="mobileMenu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section with Image Background -->
<section class="hero d-flex flex-column justify-content-center text-white position-relative">
    <!-- Hero Image -->
    <img src="{{ asset('images/pcb.jpg') }}" alt="Hero Background" class="hero-image position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: -1;" />

    <!-- Overlay for better text readability (optional) -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4); z-index: -1;"></div>

    <!-- Hero Content -->
    <div class="hero-content text-center">
        <h1>Welcome to Bestlink College</h1>
        <p class="lead">
            We provide quality education to make students globally competitive and productive citizens.
        </p>
        <form action="{{ route('two') }}" method="GET">
            <button type="submit" class="btn btn-light btn-lg rounded-pill px-5 py-3 shadow-sm">
                Enroll Now
            </button>
        </form>
    </div>
</section>

    <!-- Offcanvas Slide Menu (from Right) -->
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

                <!-- Student Personnel Services Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle py-3 border-bottom" href="#" id="mobileStudentDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Student Personnel Services
                    </a>
                    <ul class="dropdown-menu w-100" aria-labelledby="mobileStudentDropdown">
                        <li><a class="dropdown-item" href="#guidance">Guidance Services</a></li>
                        <li><a class="dropdown-item" href="#counseling">Counseling</a></li>
                        <li><a class="dropdown-item" href="#studentaffairs">Student Affairs</a></li>
                        <li><a class="dropdown-item" href="#registrar">Registrar</a></li>
                    </ul>
                </li>

                <!-- Academics Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle py-3 border-bottom" href="#" id="mobileAcademicsDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Academics
                    </a>
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
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container">

        <!-- About Us -->
        <section id="aboutus" class="section">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('images/bestlink.jpg') }}" alt="About Bestlink College" class="img-fluid rounded shadow-sm" />
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div>
                        <h2>About Us</h2>
                        <p>Bestlink College of the Philippines is a premier educational institution committed to providing quality Senior High School and College education.</p>
                        <p>Our mission is to nurture competent, responsible, and globally competitive graduates through innovative teaching and community engagement.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Admission -->
        <section id="admission" class="section">
            <div class="row">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <img src="{{ asset('images/enroll_now.jpg') }}" alt="Admission" class="img-fluid rounded shadow-sm" />
                </div>
                <div class="col-lg-6 order-lg-1 d-flex align-items-center">
                    <div>
                        <h2>Admission</h2>
                        <p>Admission is open for Senior High School and College programs. We welcome eager learners in a supportive environment.</p>
                        <a href="#enroll" class="btn btn-primary rounded-pill px-4">Enroll Now</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- BCP News -->
        <section id="bcpnews" class="section">
            <h2 class="text-center mb-5">BCP News</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('images/seminar.jpg') }}" class="card-img-top" alt="Seminar" />
                        <div class="card-body">
                            <h5 class="card-title">Career Development Seminar</h5>
                            <p class="card-text">Students explored career opportunities and developed professional skills.</p>
                            <a href="#" class="btn btn-sm btn-outline-light">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://storage.googleapis.com/a1aa/image/462fb695-ff1f-4966-9926-4c1fcf9aae24.jpg" class="card-img-top" alt="Outreach" />
                        <div class="card-body">
                            <h5 class="card-title">Community Outreach</h5>
                            <p class="card-text">Students planted trees to promote environmental awareness.</p>
                            <a href="#" class="btn btn-sm btn-outline-light">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('images/faculty.jpg') }}" class="card-img-top" alt="Faculty" />
                        <div class="card-body">
                            <h5 class="card-title">Faculty Recognition</h5>
                            <p class="card-text">Outstanding educators honored for excellence in teaching and research.</p>
                            <a href="#" class="btn btn-sm btn-outline-light">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Student Personnel Services -->
        <section id="studentpersonnelservices" class="section">
            <h2 class="text-center mb-5">Student Personnel Services</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <img src="{{ asset('images/Guidance.png') }}" class="card-img-top mx-auto mt-3" alt="Guidance" style="width: 80px;" />
                        <div class="card-body">
                            <h5 class="card-title">Guidance Services</h5>
                            <p class="card-text">Support for academic and personal goal achievement.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <img src="https://storage.googleapis.com/a1aa/image/462fb695-ff1f-4966-9926-4c1fcf9aae24.jpg" class="card-img-top mx-auto mt-3" alt="Counseling" style="width: 80px;" />
                        <div class="card-body">
                            <h5 class="card-title">Counseling</h5>
                            <p class="card-text">Professional services for mental health and well-being.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <img src="https://storage.googleapis.com/a1aa/image/a40d03c0-080b-4b8e-fcf1-d65ee136d960.jpg" class="card-img-top mx-auto mt-3" alt="Student Affairs" style="width: 80px;" />
                        <div class="card-body">
                            <h5 class="card-title">Student Affairs</h5>
                            <p class="card-text">Leadership programs and student life enrichment.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <img src="https://storage.googleapis.com/a1aa/image/92c5edf8-70d6-4fb6-04af-8abd9b16bfee.jpg" class="card-img-top mx-auto mt-3" alt="Registrar" style="width: 80px;" />
                        <div class="card-body">
                            <h5 class="card-title">Registrar</h5>
                            <p class="card-text">Efficient management of student records and enrollment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Academics -->
        <section id="academics" class="section">
            <h2 class="text-center mb-5">Academics</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <img src="{{ asset('images/shs.jpg') }}" class="card-img-top mx-auto mt-3" alt="SHS" style="width: 80px;" />
                        <div class="card-body">
                            <h5 class="card-title">Senior High School</h5>
                            <p class="card-text">Academic and vocational tracks for college and career prep.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <img src="{{ asset('images/enroll_now.jpg') }}" class="card-img-top mx-auto mt-3" alt="College" style="width: 80px;" />
                        <div class="card-body">
                            <h5 class="card-title">College Programs</h5>
                            <p class="card-text">Comprehensive degrees to develop professional knowledge.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <img src="https://storage.googleapis.com/a1aa/image/dfdb32b3-d0cc-46cc-df68-1a44478edad8.jpg" class="card-img-top mx-auto mt-3" alt="Faculty" style="width: 80px;" />
                        <div class="card-body">
                            <h5 class="card-title">Faculty</h5>
                            <p class="card-text">Dedicated educators committed to student success.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <img src="https://storage.googleapis.com/a1aa/image/08e0c8f3-25df-42cf-17e9-6fe727474205.jpg" class="card-img-top mx-auto mt-3" alt="Calendar" style="width: 80px;" />
                        <div class="card-body">
                            <h5 class="card-title">Academic Calendar</h5>
                            <p class="card-text">Stay updated on enrollment, exams, and events.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Careers -->
        <section id="careers" class="section">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('images/enroll_now.jpg') }}" alt="Careers" class="img-fluid rounded shadow-sm" />
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div>
                        <h2>Careers</h2>
                        <p>Join our passionate team of educators and support staff. Bestlink offers opportunities for qualified individuals.</p>
                        <a href="#apply" class="btn btn-primary rounded-pill px-4">Apply Now</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Alumni -->
        <section id="alumni" class="section">
            <div class="row">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <img src="https://storage.googleapis.com/a1aa/image/0acf481a-dfc7-4580-4ddc-970d9ad3fadd.jpg" alt="Alumni" class="img-fluid rounded shadow-sm" />
                </div>
                <div class="col-lg-6 order-lg-1 d-flex align-items-center">
                    <div>
                        <h2>Alumni</h2>
                        <p>Our alumni are vital to the Bestlink community. We celebrate their achievements and support their growth.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- School Facilities -->
        <section id="facilities" class="section">
            <h2 class="text-center mb-5">School Facilities</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card border-0 shadow-sm text-center">
                        <img src="https://storage.googleapis.com/a1aa/image/453dca07-210d-4448-749b-3a0f9622cf17.jpg" class="card-img-top" alt="Library" />
                        <div class="card-body">
                            <h5 class="card-title">Library</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 shadow-sm text-center">
                        <img src="https://storage.googleapis.com/a1aa/image/0475f0b2-ebdf-4793-b62b-c633f2339187.jpg" class="card-img-top" alt="Computer Lab" />
                        <div class="card-body">
                            <h5 class="card-title">Computer Labs</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 shadow-sm text-center">
                        <img src="https://storage.googleapis.com/a1aa/image/2e041b87-ab46-4dcf-aa05-10f3b08668fb.jpg" class="card-img-top" alt="Auditorium" />
                        <div class="card-body">
                            <h5 class="card-title">Auditorium</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-1"><strong>Bestlink College of the Philippines</strong></p>
            <p class="mb-1">MV Branch: #1071 Quirino Highway, Quezon City</p>
            <p class="mb-1">Bulacan Branch: IPO Road, San Jose Del Monte, Bulacan</p>
            <p>&copy; 2025 All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Transparent to solid navbar on scroll
        let lastScrollTop = 0;
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function () {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;

            if (scrollTop > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            lastScrollTop = scrollTop;
        });

        // Offcanvas: Only close when clicking a direct nav-link (not dropdown toggles)
        document.querySelectorAll('#mobileMenu .nav-link').forEach(link => {
            link.addEventListener('click', function (e) {
                // Check if it's a dropdown toggle
                if (this.classList.contains('dropdown-toggle')) {
                    // Do nothing, let dropdown open/close
                    return;
                }

                // Close offcanvas only for actual links
                const offcanvasEl = document.getElementById('mobileMenu');
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (offcanvas) {
                    offcanvas.hide();
                }
            });
        });
    </script>
</body>
</html>