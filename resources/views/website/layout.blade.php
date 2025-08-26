<!-- resources/views/website/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Bestlink College of the Philippines')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Custom Styles -->
  <style>
    :root {
      --primary-color: #203B6B;
      --primary-dark: #0c1f4c;
      --primary-light: #E8F0FE;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
      color: var(--primary-color);
      font-size: 0.9rem;
      line-height: 1.6;
      padding-top: 70px;
    }

    /* Navbar */
    .navbar {
      background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }
    .navbar-brand {
      color: white !important;
      display: flex;
      align-items: center;
    }
    .navbar-brand img {
      margin-right: 10px;
    }
    .nav-link {
      color: rgba(255, 255, 255, 0.85) !important;
      font-weight: 500;
      margin: 0 10px;
    }
    .nav-link:hover {
      color: white !important;
    }

    /* Hero Section */
    .hero-section {
      background: linear-gradient(rgba(32, 59, 107, 0.85), rgba(12, 31, 76, 0.9)), url('../images/home.jpg') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 80px 0;
      text-align: center;
      margin-top: -70px;
      margin-bottom: 40px;
    }

    /* Card & Form */
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* Footer */
    footer {
      background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
      color: white;
      padding: 40px 0 20px;
      margin-top: 60px;
    }
    .footer-link {
      color: rgba(255, 255, 255, 0.7);
      text-decoration: none;
    }
    .footer-link:hover {
      color: white;
      text-decoration: underline;
    }

    /* Required Star */
    .required-star {
      color: #dc3545;
    }
  </style>

  @stack('styles')
</head>
<body>
  <!-- Navbar (Optional: Remove if not needed in enrollment) -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="{{ route('one') }}">
        <img src="{{ asset('images/bcp.png') }}" alt="BCP Logo" width="40" height="40">
        Bestlink College
      </a>
    </div>
  </nav>

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <h4><i class="fas fa-graduation-cap me-2"></i>Bestlink College</h4>
          <p>Providing quality education and holistic development for students since 1999.</p>
        </div>
        <div class="col-md-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Academics</a></li>
            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Admissions</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Contact Us</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> #109 National Highway, Quezon City</li>
            <li class="mb-2"><i class="fas fa-phone me-2"></i> (02) 123-4567</li>
            <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@bestlinkcollege.edu.ph</li>
          </ul>
        </div>
      </div>
      <hr class="my-4 bg-light">
      <div class="text-center">
        <p class="mb-0">&copy; 2025 Bestlink College of the Philippines. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>