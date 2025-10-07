<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Bestlink College of the Philippines - College Enrollment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    :root {
      --primary-color: #203B6B;
      --primary-dark: #0c1f4c;
      --primary-light: #E8F0FE;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
      color: var(--primary-color);
      font-size: 0.9rem;
      line-height: 1.6;
      padding-top: 70px;
    }
    /* Navbar Styles */
    .navbar {
      background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-dark) 100%);
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }
    .navbar-brand {
      color: white !important;
      display: flex;
      align-items: center;
      transition: transform 0.3s ease;
    }
    .navbar-brand:hover {
      transform: scale(1.05);
    }
    .navbar-brand img {
      margin-right: 10px;
      transition: all 0.3s ease;
    }
    .nav-link {
      color: rgba(255, 255, 255, 0.85) !important;
      font-weight: 500;
      position: relative;
      padding: 15px 0;
      margin: 0 10px;
      transition: all 0.3s ease;
    }
    .nav-link:hover {
      color: white !important;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 10px;
      left: 0;
      width: 0;
      height: 2px;
      background-color: white;
      transition: width 0.3s ease;
    }
    .nav-link:hover::after {
      width: 100%;
    }
    .navbar-toggler {
      border: none;
      color: white;
      font-size: 1.5rem;
    }
    .navbar-toggler:focus {
      box-shadow: none;
    }
    /* Main Content Styles */
    .hero-section {
      background: linear-gradient(rgba(32, 59, 107, 0.85), rgba(12, 31, 76, 0.9)), url('../images/home.jpg') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 80px 0;
      text-align: center;
      margin-top: -70px;
      margin-bottom: 40px;
    }
    .hero-section h1, img {
      font-weight: 700;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
      animation: slideInUp 0.8s ease;
    }
    .hero-section p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 20px auto;
      animation: slideInUp 1s ease;
    }
    /* Stepper Styles */
    .stepper {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin-bottom: 2rem;
      counter-reset: step;
    }
    .stepper::before {
      content: "";
      position: absolute;
      top: 15px;
      left: 0;
      right: 0;
      height: 2px;
      background-color: #dee2e6;
      z-index: 1;
    }
    .step {
      position: relative;
      z-index: 2;
      text-align: center;
      flex: 1;
      font-size: 0.85rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .step::before {
      content: counter(step);
      counter-increment: step;
      display: block;
      width: 32px;
      height: 32px;
      line-height: 32px;
      background-color: #e9ecef;
      border: 2px solid #dee2e6;
      border-radius: 50%;
      margin: 0 auto 8px;
      color: #6c757d;
      transition: all 0.3s ease;
    }
    .step.active {
      color: var(--primary-color);
      transform: translateY(-5px);
    }
    .step.active::before {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      color: white;
      box-shadow: 0 4px 8px rgba(32, 59, 107, 0.3);
    }
    .step.completed::before {
      background-color: #198754;
      border-color: #198754;
      color: white;
      content: "✓";
    }
    .step.disabled {
      color: #6c757d;
      pointer-events: none;
      cursor: default;
    }
    .step.completed, .step.active {
      pointer-events: auto;
      cursor: pointer;
    }
    /* Form Styles */
    .form-section {
      display: none;
      animation: fadeIn 0.5s ease;
    }
    .form-section.active {
      display: block;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .stepper-header {
      color: var(--primary-color);
      border-bottom: 2px solid var(--primary-color);
      padding-bottom: 0.5rem;
      margin-bottom: 1.5rem;
      position: relative;
      overflow: hidden;
    }
    .stepper-header::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
      transition: width 0.5s ease;
    }
    .form-section.active .stepper-header::after {
      width: 100%;
    }
    .summary-label {
      font-weight: 600;
      color: var(--primary-dark);
    }
    .card-header-custom {
      background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-dark) 100%) !important;
      color: white !important;
      border-radius: 8px 8px 0 0 !important;
    }
    .card-header-custom {
      background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-dark) 100%) !important;
      color: white !important;
      border-radius: 8px 8px 0 0 !important;
    }
    .requirements-card {
      border: 1px solid #dee2e6;
      transition: all 0.3s ease;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    .requirements-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    .required-star {
      color: #dc3545;
    }
    .btn-primary {
      background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-dark) 100%);
      border: none;
      padding: 10px 25px;
      font-weight: 600;
      transition: all 0.3s ease;
      border-radius: 30px;
    }
    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(32, 59, 107, 0.4);
    }
    .btn-secondary {
      background-color: #6c757d;
      border: none;
      padding: 10px 25px;
      font-weight: 600;
      transition: all 0.3s ease;
      border-radius: 30px;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .invalid-feedback {
      font-size: 0.8rem;
    }
    h1, h2, h3, h4, h5, h6 {
      font-weight: 700;
    }
    .text-primary-custom {
      color: var(--primary-color) !important;
    }
    .form-control, .form-select {
      border: 1px solid #ced4da;
      border-radius: 8px;
      padding: 10px 15px;
      transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(32, 59, 107, 0.25);
    }
    .card {
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease;
      border: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    .section-title {
      position: relative;
      padding-bottom: 15px;
      margin-bottom: 30px;
    }
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
      border-radius: 3px;
    }
    .feature-box {
      text-align: center;
      padding: 30px 20px;
      border-radius: 10px;
      background: white;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      height: 100%;
    }
    .feature-box:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    .feature-box i {
      font-size: 2.5rem;
      color: var(--primary-color);
      margin-bottom: 20px;
    }
    footer {
      background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-dark) 100%);
      color: white;
      padding: 40px 0 20px;
      margin-top: 60px;
    }
    .footer-link {
      color: rgba(255, 255, 255, 0.7);
      transition: all 0.3s ease;
      text-decoration: none;
    }
    .footer-link:hover {
      color: white;
      text-decoration: underline;
    }
    /* File Preview Styling */
    .preview-container {
      font-size: 0.85rem;
      margin-top: 10px;
    }
    .preview-container .border {
      border-width: 1px !important;
    }
    @media (max-width: 768px) {
      .hero-section {
        padding: 60px 0;
      }
      .navbar-brand {
        font-size: 1.2rem;
      }
      .nav-link {
        margin: 5px 0;
        padding: 10px 0;
      }
      .feature-box {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>
  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container" style="margin-top: 2%;">
     <img src="../images/bcp.png" alt="Bestlink College Of The Philippines" class="img-fluid" width="100"  height="100">
      <h1 class="display-4 fw-bold">College Enrollment</h1>
      <p class="lead">Start your higher education journey with Bestlink College of the Philippines. Complete your enrollment process quickly and efficiently.</p>
    </div>
  </section>
  <div class="container py-5" id="enrollment-form">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <h2 class="fw-bold text-primary-custom mb-3 section-title">College Enrollment Form</h2>
        <p class="lead">Fill out the form below to begin your enrollment process at Bestlink College of the Philippines.</p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-sm">
          <div class="card-body p-4 p-md-5">
            <!-- Stepper -->
            <div id="stepper" class="stepper">
  <div class="step active" data-step="1">Step 1: Student Info</div>
  <div class="step disabled" data-step="2">Step 2: Address</div>
  <div class="step disabled" data-step="3">Step 3: Parents Info</div>
  <div class="step disabled" data-step="4">Step 4: Health Info</div>
  <div class="step disabled" data-step="5">Step 5: Preferences</div>
  <div class="step disabled" data-step="6">Step 6: Backgrounds</div>
  <div class="step disabled" data-step="7">Step 7: Documents</div>
  <div class="step disabled" data-step="8">Step 8: How did you hear about us?</div>
  <div class="step disabled" data-step="9">Step 9: Summary</div>
</div>
            <!-- FORM with proper Laravel integration -->
            <form id="registrationForm" novalidate>
              @csrf
              <!-- STEP 1 -->
              <section class="form-section active" data-step="1">
                <h3 class="stepper-header mb-4">Step 1: Student Information</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="studentType" class="form-label">Student Type<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Choose if you are a new student, transferring from another school, or returning after a break. This affects required documents."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <select class="form-select" id="studentType" name="studentType" required aria-describedby="studentTypeHelp">
                      <option value="" selected disabled>Choose student type</option>
                      <option value="New Regular">New Regular</option>
                      <option value="Transferee">Transferee</option>
                      <option value="Returnee">Returnee</option>
                    </select>
                    <div class="invalid-feedback">Please select a student type.</div>
                    <div id="studentTypeHelp" class="form-text d-none">Selected: <span id="studentTypeValue"></span></div>
                  </div>
                  <div class="col-md-6 d-none" id="previousIdContainer">
                    <label for="previousStudentId" class="form-label">Previous Student ID No (8 digits)<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your 8-digit Bestlink College ID number if you were previously enrolled. Only required for Returnees."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="previousStudentId" name="previousStudentId" pattern="^\d{8}$" maxlength="8" />
                    <div class="invalid-feedback">Please enter a valid 8-digit Previous Student ID.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="firstName" class="form-label">First Name<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your first name as it appears on your birth certificate. Example: Juan"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required />
                    <div class="invalid-feedback">Please enter your first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="middleName" class="form-label">Middle Name<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your middle name (usually your mother's maiden name). If none, write N/A. Example: Dela Cruz"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="middleName" name="middleName" required />
                    <div class="invalid-feedback">Please enter your middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="lastName" class="form-label">Last Name<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your last name as it appears on your birth certificate. Example: Santos"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required />
                    <div class="invalid-feedback">Please enter your last name.</div>
                  </div>
                  <div class="col-md-6" id="extensionNameContainer">
                    <label class="form-label">Extension Name (Optional)<span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select Jr., Sr., etc. if applicable to differentiate duplicate names."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="checkbox" id="hasExtensionName" name="hasExtensionName" />
                      <label class="form-check-label" for="hasExtensionName">
                        I have an extension name
                      </label>
                    </div>
                    <select class="form-select" id="extensionName" name="extensionName" disabled>
                      <option value="" selected>Select extension</option>
                      <option value="Sr.">Senior (Sr.)</option>
                      <option value="Jr.">Junior (Jr.)</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="civilStatus" class="form-label">Civil Status<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Your marital status. Choose from Single, Married, Widowed, Separated, Divorced."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <select class="form-select" id="civilStatus" name="civilStatus" required>
                      <option value="" selected disabled>Choose civil status</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Widowed">Widowed</option>
                      <option value="Separated">Separated</option>
                      <option value="Divorced">Divorced</option>
                    </select>
                    <div class="invalid-feedback">Please select your civil status.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="gender" class="form-label">Gender<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select Male or Female based on your official records."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <select class="form-select" id="gender" name="gender" required>
                      <option value="" selected disabled>Choose gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    <div class="invalid-feedback">Please select your gender.</div>
                  </div>
                  <!-- Indigenous Group -->
<div class="col-md-6">
    <label for="indigenous" class="form-label">Indigenous Group<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select your indigenous group if applicable. This helps in identifying cultural backgrounds and possible scholarship eligibility."><i class="fas fa-info-circle text-primary"></i></span></label>
    <select class="form-select" id="indigenous" name="indigenous" required>
        <option value="" selected disabled>Choose Indigenous group</option>
        @foreach($indigenousGroups as $group)
            <option value="{{ $group->indigenous_id }}">{{ $group->indigenous_name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">Please select an Indigenous group.</div>
</div>
<!-- Disability Type -->
<div class="col-md-6">
    <label for="disability" class="form-label">Disability Type<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="If you have any disability, please select the appropriate category. This ensures proper accommodations during your studies."><i class="fas fa-info-circle text-primary"></i></span></label>
    <select class="form-select" id="disability" name="disability" required>
        <option value="" selected disabled>Choose Disability type</option>
        @foreach($disabilityTypes as $type)
            <option value="{{ $type->disability_id }}">{{ $type->disability_name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">Please select a Disability type.</div>
</div>
                  <!-- Date of Birth -->
                  <div class="col-md-6">
                    <label for="dob" class="form-label">Date of Birth<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your date of birth as shown on your PSA Birth Certificate. Format: DD-MM-YYYY. Example: 05-15-1990"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="date" class="form-control" id="dob" name="dob" max="" required />
                    <div class="invalid-feedback">Please enter your date of birth.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="placeOfBirth" class="form-label">Place of Birth<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the city or municipality where you were born. Example: Quezon City, Metro Manila"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" required />
                    <div class="invalid-feedback">Please enter your place of birth.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="nationality" class="form-label">Nationality<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your nationality. For Filipino citizens, write 'Filipino'. For dual citizenship, list both."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="nationality" name="nationality" required />
                    <div class="invalid-feedback">Please enter your nationality.</div>
                  </div>
                </div>
              </section>
              <!-- STEP 2 -->
              <section class="form-section" data-step="2">
                <h3 class="stepper-header mb-4">Step 2: Address</h3>
                <div class="row g-3">
                  <div class="col-md-12">
                    <label for="currentAddress" class="form-label">Current Address<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your complete current address including house number, street, barangay, and city. Example: 123 Anonas St., Brgy. Maligaya, Quezon City"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="currentAddress" name="currentAddress" required />
                    <div class="invalid-feedback">Please enter your current address.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="cityMunicipality" class="form-label">City/Municipality<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the city or municipality where you currently reside. Example: Quezon City"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="cityMunicipality" name="cityMunicipality" required />
                    <div class="invalid-feedback">Please enter your city or municipality.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="region" class="form-label">Region<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select the region where your city/municipality is located. Use the dropdown list provided. Example: Region III - Central Luzon"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <select class="form-select" id="region" name="region" required>
                      <option value="" selected disabled>Choose region</option>
                      <option value="1">NCR - National Capital Region</option>
                      <option value="2">Region I - Ilocos Region</option>
                      <option value="3">Region II - Cagayan Valley</option>
                      <option value="4">Region III - Central Luzon</option>
                      <option value="5">Region IV-A - CALABARZON</option>
                      <option value="6">Region IV-B - MIMAROPA</option>
                      <option value="7">Region V - Bicol Region</option>
                      <option value="8">Region VI - Western Visayas</option>
                      <option value="9">Region VII - Central Visayas</option>
                      <option value="10">Region VIII - Eastern Visayas</option>
                      <option value="11">Region IX - Zamboanga Peninsula</option>
                      <option value="12">Region X - Northern Mindanao</option>
                      <option value="13">Region XI - Davao Region</option>
                      <option value="14">Region XII - SOCCSKSARGEN</option>
                      <option value="15">Region XIII - Caraga</option>
                      <option value="16">BARMM</option>
                    </select>
                    <div class="invalid-feedback">Please select your region.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="zipCode" class="form-label">Zip Code<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your postal zip code. It should be 4 to 6 digits long. Example: 1100"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="zipCode" name="zipCode" pattern="^\d{4,6}$" required />
                    <div class="invalid-feedback">Please enter a valid zip code (4-6 digits).</div>
                  </div>
                  <div class="col-md-6">
                    <label for="province" class="form-label">Province<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the province where you reside. If you're in Metro Manila, write 'Metro Manila'. Example: Bulacan"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="province" name="province" required />
                    <div class="invalid-feedback">Please enter your province.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="religion" class="form-label">Religion<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your religious affiliation. Examples: Roman Catholic, Islam, Protestant, Agnostic, etc."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="religion" name="religion" required />
                    <div class="invalid-feedback">Please enter your religion.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Provide a valid email address that you check regularly. This will be used for communication from the college. Example: student@example.com"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="email" class="form-control" id="email" name="email" required />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="contactNumber" class="form-label">Contact Number<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mobile number with area code. Example: +639123456789"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="tel" class="form-control" id="contactNumber" name="contactNumber" pattern="^\+?\d{7,15}$" required />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="socialMedia" class="form-label">Social Media Account / Facebook<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Provide your Facebook profile link or username so we can verify your identity. Example: facebook.com/juansantos123"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="socialMedia" name="socialMedia" required />
                    <div class="invalid-feedback">Please enter your social media account.</div>
                  </div>
                </div>
              </section>
              <!-- STEP 3 -->
              <section class="form-section" data-step="3">
                <h3 class="stepper-header mb-4">Step 3: Parents Information</h3>
                <div class="row g-3">
                  <h5 class="mb-3" style="color: red; font-weight: 700;">Mother's Maiden Information</h5>
                  <div class="col-md-4">
                    <label for="motherFirstName" class="form-label">First Name<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's first name as it appears on her ID. Example: Maria"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="motherFirstName" name="motherFirstName" required />
                    <div class="invalid-feedback">Please enter mother's first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherMiddleName" class="form-label">Middle Name<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's middle name. Example: Dela Cruz"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="motherMiddleName" name="motherMiddleName" required />
                    <div class="invalid-feedback">Please enter mother's middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherLastName" class="form-label">Last Name<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's last name. Example: Santos"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="motherLastName" name="motherLastName" required />
                    <div class="invalid-feedback">Please enter mother's last name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherOccupation" class="form-label">Occupation<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's current job or profession. Example: Teacher, Nurse, Housewife, etc."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="motherOccupation" name="motherOccupation" required />
                    <div class="invalid-feedback">Please enter mother's occupation.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherContact" class="form-label">Contact Number<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's mobile number. Example: +639123456789"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="tel" class="form-control" id="motherContact" name="motherContact" pattern="^\+?\d{7,15}$" required />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherEmail" class="form-label">Email<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's email address. Example: mom@example.com"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="email" class="form-control" id="motherEmail" name="motherEmail" required />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <h5 class="mb-3 mt-4" style="color: var(--primary-dark); font-weight: 700;">Father's Information</h5>
                  <div class="col-md-4">
                    <label for="fatherFirstName" class="form-label">First Name<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's first name as it appears on his ID. Example: Juan"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="fatherFirstName" name="fatherFirstName" required />
                    <div class="invalid-feedback">Please enter father's first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherMiddleName" class="form-label">Middle Name<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's middle name. Example: Dela Cruz"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="fatherMiddleName" name="fatherMiddleName" required />
                    <div class="invalid-feedback">Please enter father's middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherLastName" class="form-label">Last Name<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's last name. Example: Santos"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="fatherLastName" name="fatherLastName" required />
                    <div class="invalid-feedback">Please enter father's last name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherOccupation" class="form-label">Occupation<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's current job or profession. Example: Engineer, Doctor, Driver, etc."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="fatherOccupation" name="fatherOccupation" required />
                    <div class="invalid-feedback">Please enter father's occupation.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherContact" class="form-label">Contact Number<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's mobile number. Example: +639123456789"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="tel" class="form-control" id="fatherContact" name="fatherContact" pattern="^\+?\d{7,15}$" required />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherEmail" class="form-label">Email<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's email address. Example: dad@example.com"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="email" class="form-control" id="fatherEmail" name="fatherEmail" required />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <div class="col-12 mt-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="notLivingWithParents" name="notLivingWithParents" value="1">
                      <label class="form-check-label" for="notLivingWithParents">
                        Not living with my parents
                      </label>
                    </div>
                  </div>
                  <h5 class="mb-3 mt-4" style="color: var(--primary-dark); font-weight: 700;">Guardian's Information</h5>
                   <div class="col-md-4" id="guardianFirstNameContainer" style="display: none;">
                     <label for="guardianFirstName" class="form-label">First Name<span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the guardian's first name. Example: Ana"><i class="fas fa-info-circle text-primary"></i></span></label>
                     <input type="text" class="form-control" id="guardianFirstName" name="guardianFirstName" />
                     <div class="invalid-feedback">Please enter guardian's first name.</div>
                   </div>
                  <div class="col-md-4" id="guardianMiddleNameContainer" style="display: none;">
                    <label for="guardianMiddleName" class="form-label">Middle Name<span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the guardian's middle name. Example: Dela Cruz"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="guardianMiddleName" name="guardianMiddleName" />
                    <div class="invalid-feedback">Please enter guardian's middle name.</div>
                  </div>
                  <div class="col-md-4" id="guardianLastNameContainer" style="display: none;">
                    <label for="guardianLastName" class="form-label">Last Name<span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the guardian's last name. Example: Garcia"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="guardianLastName" name="guardianLastName" />
                    <div class="invalid-feedback">Please enter guardian's last name.</div>
                  </div>
                  <div class="col-md-3" id="guardianDobContainer" style="display: none;">
                    <label for="guardianDob" class="form-label">Date of Birth<span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the guardian's date of birth. Format: YYYY-MM-DD. Example: 1970-03-10"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="date" class="form-control" id="guardianDob" name="guardianDob" max="" />
                    <div class="invalid-feedback">Please enter guardian's date of birth.</div>
                  </div>
                  <div class="col-md-6" id="guardianContactContainer" style="display: none;">
                    <label for="guardianContact" class="form-label">Contact Number<span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the guardian's mobile number. Example: +639123456789"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="tel" class="form-control" id="guardianContact" name="guardianContact" pattern="^\+?\d{7,15}$" />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-3" id="guardianEmailContainer" style="display: none;">
                    <label for="guardianEmail" class="form-label">Email<span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the guardian's email address. Example: guardian@example.com"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="email" class="form-control" id="guardianEmail" name="guardianEmail" />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <!-- 4Ps Checkbox -->
<div class="col-12 mt-3">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="isFourPs" name="isFourPs" value="1">
    <label class="form-check-label" for="isFourPs">
      Parent / Guardian member of 4Ps?
    </label>
    <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Check if your parent or guardian is a beneficiary of the Pantawid Pamilyang Pilipino Program (4Ps). This may qualify you for financial assistance.">
      <i class="fas fa-info-circle text-primary"></i>
    </span>
  </div>
</div>
                </div>
              </section>

              <!-- STEP 4: Health Info -->
<section class="form-section" data-step="4">
  <h3 class="stepper-header mb-4">Step 4: Health Information</h3>
  <div class="row g-3">
    <div class="col-12">
      <label class="form-label">Do you have any of the following medical conditions?<span class="required-star">*</span></label>
      <div class="row">
        @php
          $conditions = [
            'Asthma', 'Allergies', 'Heart Disease', 'Hypertension',
            'Diabeties Type 2', 'Kidney Disease', 'Pneumonia', 'Tuberculosis',
            'Bleeding Disorders', 'Psychiatric Disorder', 'Cancer', 'Others'
          ];
        @endphp
        @foreach($conditions as $cond)
          <div class="col-md-6 col-lg-4 mb-2">
            <div class="form-check">
              <input class="form-check-input health-condition" type="radio" name="healthCondition" id="cond{{ str_replace(' ', '', $cond) }}" value="{{ $cond }}" required>
              <label class="form-check-label" for="cond{{ str_replace(' ', '', $cond) }}">
                {{ $cond }}
              </label>
            </div>
          </div>
        @endforeach
      </div>
      <div class="invalid-feedback d-block" id="healthConditionFeedback">Please select a condition.</div>
    </div>

    <div class="col-md-12" id="othersField" style="display: none;">
      <label for="healthConditionOthers" class="form-label">Please specify the condition:</label>
      <input type="text" class="form-control" id="healthConditionOthers" name="healthConditionOthers" placeholder="e.g., Epilepsy, Arthritis, etc." />
    </div>

    <div class="col-md-6">
      <label for="weightKg" class="form-label">Weight (kg)<span class="required-star">*</span></label>
      <input type="number" step="0.01" min="0" max="300" class="form-control" id="weightKg" name="weightKg" required />
      <div class="invalid-feedback">Please enter your weight in kilograms.</div>
    </div>
    <div class="col-md-6">
      <label for="heightCm" class="form-label">Height (cm)<span class="required-star">*</span></label>
      <input type="number" step="0.01" min="0" max="300" class="form-control" id="heightCm" name="heightCm" required />
      <div class="invalid-feedback">Please enter your height in centimeters.</div>
    </div>
  </div>
</section>
              <!-- STEP 4 -->
              <section class="form-section" data-step="5">
                <h3 class="stepper-header mb-4">Step 5: Preferences</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="preferredBranch" class="form-label">Preferred Branch<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Choose the campus you prefer to attend. Main Branch is in Bayan Novaliches Quezon City, Bulacan Branch is in Bulacan."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <select class="form-select" id="preferredBranch" name="preferredBranch" required>
                      <option value="" selected disabled>Choose preferred branch</option>
                      <option value="1">Main Branch (#1071 Brgy. Kaligayahan, Quirino Highway Novaliches Quezon City)</option>
                      <option value="2">Bulacan Branch (Lot 1 Ipo Road, Barangay Minuyan Proper, City of San Jose Del Monte, Bulacan)</option>
                    </select>
                    <div class="invalid-feedback">Please select a preferred branch.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="preferredCourse" class="form-label">Preferred Course<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select the course you wish to enroll in. Courses vary by branch. Choose carefully as this affects your academic path."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <select class="form-select" id="preferredCourse" name="preferredCourse" required>
                      <option value="" selected disabled>Choose preferred course</option>
                    </select>
                    <div class="invalid-feedback">Please select a preferred course.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="yearLevelStep4" class="form-label">Year Level<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Choose your year level. New Regular students start at 1st Year. Transferees and Returnees may choose 1st to 5th Year based on units completed."><i class="fas fa-info-circle text-primary"></i></span></label>
                    <select class="form-select" id="yearLevelStep4" name="yearLevelStep4" required>
                      <option value="" selected disabled>Choose year level</option>
                    </select>
                    <div class="invalid-feedback">Please select your year level.</div>
                  </div>
                </div>
              </section>
              <!-- STEP 5 -->
              <section class="form-section" data-step="6">
                <h3 class="stepper-header mb-4">Step 6: Educational Background</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="primarySchool" class="form-label">Primary School<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the name of the school where you completed your elementary education. Example: Maligaya Elementary School"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="primarySchool" name="primarySchool" required />
                    <div class="invalid-feedback">Please enter your primary school.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="primaryYearGraduated" class="form-label">Year Graduated (Primary)<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the year you finished elementary school. Example: 2018"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="number" class="form-control" id="primaryYearGraduated" name="primaryYearGraduated" min="1900" max="2099" step="1" required />
                    <div class="invalid-feedback">Please enter a valid year graduated.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="secondarySchool" class="form-label">Secondary School<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the name of the school where you completed your high school education. Example: Maligaya High School"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="secondarySchool" name="secondarySchool" required />
                    <div class="invalid-feedback">Please enter your secondary school.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="secondaryYearGraduated" class="form-label">Year Graduated (Secondary)<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the year you finished high school. Example: 2022"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="number" class="form-control" id="secondaryYearGraduated" name="secondaryYearGraduated" min="1900" max="2099" step="1" required />
                    <div class="invalid-feedback">Please enter a valid year graduated.</div>
                  </div>
                  <div class="col-md-10">
                    <label for="lastSchoolAttended" class="form-label">Last School Attended<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the name of the school you most recently attended. This could be a university or college. Example: University of Santo Tomas"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="text" class="form-control" id="lastSchoolAttended" name="lastSchoolAttended" required />
                    <div class="invalid-feedback">Please enter your last school attended.</div>
                  </div>
                  <div class="col-md-2">
                    <label for="lastSchoolYearGraduated" class="form-label">Year Graduated<span class="required-star">*</span><span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the year you graduated from your last school. If still studying, leave blank or write 'Ongoing'. Example: 2023"><i class="fas fa-info-circle text-primary"></i></span></label>
                    <input type="number" class="form-control" id="lastSchoolYearGraduated" name="lastSchoolYearGraduated" min="1900" max="2099" step="1" required />
                    <div class="invalid-feedback">Please enter a valid year graduated.</div>
                  </div>
                </div>
              </section>
              <!-- STEP 6 -->
              <section class="form-section" data-step="7">
                <h3 class="stepper-header mb-4">Step 7: Softcopy of Document Submission</h3>
                <p class="mb-4 text-muted">Please upload clear and legible scanned copies of the following required documents. Acceptable formats: PDF, JPG, PNG (max 5MB each).</p>
                <div id="documentUploadList">
                  <!-- Dynamically populated -->
                </div>
                <div class="mt-4">
                  <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-3"></i>
                    <div>
                      <strong>File Requirements:</strong> Maximum file size is <strong>5MB</strong> per document. Supported formats: <strong>PDF, JPG, PNG</strong>.
                    </div>
                  </div>
                </div>
              </section>

              <!-- STEP 8: Referral -->
<section class="form-section" data-step="8">
  <h3 class="stepper-header mb-4">Step 8: How did you hear about our school?</h3>
  <div class="row g-3">
    <div class="col-md-12">
      <label for="referralSource" class="form-label">Referral Source<span class="required-star">*</span></label>
      <select class="form-select" id="referralSource" name="referralSource" required>
        <option value="" selected disabled>Select an option</option>
        <option value="Social Media Account">Social Media Account</option>
        <option value="Adviser/Referral/Others">Adviser/Referral/Others</option>
        <option value="Walk-in/No Referral">Walk-in/No Referral</option>
      </select>
      <div class="invalid-feedback">Please select how you heard about us.</div>
    </div>

    <div class="col-md-6" id="referralNameField" style="display: none;">
      <label for="referralName" class="form-label">Referral Name</label>
      <input type="text" class="form-control" id="referralName" name="referralName" placeholder="e.g., Mrs. Dela Cruz" />
    </div>
    <div class="col-md-6" id="referralRelationField" style="display: none;">
      <label for="referralRelation" class="form-label">Referral Relation</label>
      <input type="text" class="form-control" id="referralRelation" name="referralRelation" placeholder="e.g., Former Teacher, Friend, etc." />
    </div>
  </div>
</section>
<!-- STEP 9 -->
<section class="form-section" data-step="9">
  <h3 class="stepper-header mb-4">Step 9: Summary</h3>
  
  <!-- Info Banner -->
  <div class="alert alert-info mb-4 d-flex align-items-center">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Please review your information carefully before submitting.</strong>
  </div>

  <!-- Summary Content -->
  <div id="summaryContent" class="mb-4">
    <!-- Populated by JS -->
  </div>

  <!-- Agreement Checkbox -->
  <div class="form-check mb-4">
    <input class="form-check-input" type="checkbox" id="agreement" required>
    <label class="form-check-label" for="agreement">
      I certify that the information provided is true and correct to the best of my knowledge.
    </label>
  </div>

  <!-- Privacy Policy Link -->
  <p class="text-muted small">
    By continuing, you agree that your information will only be used for assessment and recommendation purposes.
    For more details, please see our <a href="#" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal" class="text-decoration-underline">[Privacy Policy]</a>.
  </p>
</section>
              <!-- Navigation Buttons -->
              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" id="prevBtn" disabled>
                  <i class="fas fa-arrow-left me-2"></i>Previous
                </button>
                <button type="button" class="btn btn-primary" id="nextBtn">
                  Next<i class="fas fa-arrow-right ms-2"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <h4 class="mb-4"><i class="fas fa-graduation-cap me-2"></i>Bestlink College</h4>
          <p>Providing quality education and holistic development for students since 1999.</p>
          <div class="mt-3">
            <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
        <div class="col-md-4">
          <h5 class="mb-4">Quick Links</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Academics</a></li>
            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Admissions</a></li>
            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Student Services</a></li>
            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i>Campus Life</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5 class="mb-4">Contact Us</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> #109 National Highway, Brgy. Maligaya, Quezon City</li>
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


  <!-- Define route for JS -->
  <script>
    const SUBMIT_ENROLLMENT_URL = "{{ route('enrollment.submit') }}";
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (() => {
      const form = document.getElementById('registrationForm');
      const steps = Array.from(form.querySelectorAll('section.form-section'));
      // Health condition "Others" toggle
const healthConditionInputs = document.querySelectorAll('.health-condition');
healthConditionInputs.forEach(input => {
  input.addEventListener('change', () => {
    const othersField = document.getElementById('othersField');
    if (input.value === 'Others') {
      othersField.style.display = 'block';
      document.getElementById('healthConditionOthers').setAttribute('required', 'required');
    } else {
      othersField.style.display = 'none';
      document.getElementById('healthConditionOthers').removeAttribute('required');
      document.getElementById('healthConditionOthers').value = '';
    }
  });
});

const extensionNameContainer = document.getElementById('extensionNameContainer');
const hasExtensionNameCheckbox = document.getElementById('hasExtensionName');
const extensionNameSelect = document.getElementById('extensionName');

function toggleExtensionName() {
  if (!extensionNameContainer || !hasExtensionNameCheckbox || !extensionNameSelect) {
    console.error('Extension name elements missing');
    return;
  }
  if (hasExtensionNameCheckbox.checked) {
    extensionNameSelect.removeAttribute('disabled');
    extensionNameSelect.setAttribute('required', 'required');
    extensionNameContainer.style.display = 'block';
  } else {
    extensionNameSelect.setAttribute('disabled', 'disabled');
    extensionNameSelect.removeAttribute('required');
    extensionNameSelect.value = '';
    extensionNameContainer.style.display = 'none';
  }
}

hasExtensionNameCheckbox.addEventListener('change', toggleExtensionName);

// Call on page load to set initial state
toggleExtensionName();

// CSS fix to ensure extensionNameContainer is visible by default if checkbox is checked
const style = document.createElement('style');
style.innerHTML = `
  #extensionNameContainer {
    display: block !important;
  }
`;
document.head.appendChild(style);

function toggleGuardianFields() {
  const checkbox = document.getElementById('notLivingWithParents');
  const fields = [
    'guardianFirstName',
    'guardianMiddleName',
    'guardianLastName',
    'guardianDob',
    'guardianContact',
    'guardianEmail'
  ];
  let anyFilled = false;
  fields.forEach(fieldId => {
    const input = document.getElementById(fieldId);
    if (input.value.trim() !== '') {
      anyFilled = true;
    }
  });

  fields.forEach(fieldId => {
    const container = document.getElementById(fieldId + 'Container');
    const input = document.getElementById(fieldId);
    if (checkbox.checked || anyFilled) {
      container.style.display = 'block';
      input.setAttribute('required', 'required');
    } else {
      container.style.display = 'none';
      input.removeAttribute('required');
      input.value = '';
    }
  });
}

document.getElementById('notLivingWithParents').addEventListener('change', toggleGuardianFields);

// Call on page load to set initial state
toggleGuardianFields();

      // Referral source toggle
      const referralSource = document.getElementById('referralSource');
      referralSource.addEventListener('change', () => {
        const nameField = document.getElementById('referralNameField');
        const relationField = document.getElementById('referralRelationField');
        if (referralSource.value === 'Adviser/Referral/Others') {
          nameField.style.display = 'block';
          relationField.style.display = 'block';
          document.getElementById('referralName').setAttribute('required', 'required');
          document.getElementById('referralRelation').setAttribute('required', 'required');
        } else {
          nameField.style.display = 'none';
          relationField.style.display = 'none';
          document.getElementById('referralName').removeAttribute('required');
          document.getElementById('referralRelation').removeAttribute('required');
          document.getElementById('referralName').value = '';
          document.getElementById('referralRelation').value = '';
        }
        // Update summary on referral change
        if (currentStep === steps.length - 1) {
          setTimeout(populateSummary, 0);
        }
      });

      // Also update summary on referral name or relation input change
      document.getElementById('referralName').addEventListener('input', () => {
        if (currentStep === steps.length - 1) {
          setTimeout(populateSummary, 0);
        }
      });
      document.getElementById('referralRelation').addEventListener('input', () => {
        if (currentStep === steps.length - 1) {
          setTimeout(populateSummary, 0);
        }
      });

      // Update summary on any input or select change in the form when on summary step
      form.querySelectorAll('input, select').forEach(element => {
        element.addEventListener('change', () => {
          if (currentStep === steps.length - 1) {
            setTimeout(populateSummary, 0);
          }
        });
      });

// Guardian fields toggle
const guardianFields = ['guardianFirstName', 'guardianMiddleName', 'guardianLastName', 'guardianDob', 'guardianContact', 'guardianEmail'];
const notLivingWithParentsCheckbox = document.getElementById('notLivingWithParents');
notLivingWithParentsCheckbox.addEventListener('change', () => {
  const isChecked = notLivingWithParentsCheckbox.checked;
  guardianFields.forEach(fieldId => {
    const input = document.getElementById(fieldId);
    const label = input.previousElementSibling; // assuming label is before input
    if (isChecked) {
      input.setAttribute('required', 'required');
      if (!label.querySelector('.required-star')) {
        label.insertAdjacentHTML('beforeend', ' <span class="required-star">*</span>');
      }
    } else {
      input.removeAttribute('required');
      const star = label.querySelector('.required-star');
      if (star) star.remove();
    }
  });
});
      const stepperSteps = Array.from(document.querySelectorAll('#stepper .step'));
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');
      let currentStep = 0;
      let maxStep = 0;
      const today = new Date().toISOString().split('T')[0];
      form.querySelectorAll('input[type="date"]').forEach(input => input.setAttribute('max', today));

      // Make stepper steps clickable only if completed or current step
      stepperSteps.forEach((stepElement, index) => {
        // stepElement.style.cursor = 'default'; // Removed to allow CSS cursor pointer to work
        stepElement.addEventListener('click', () => {
          if (stepElement.classList.contains('completed') || stepElement.classList.contains('active')) {
            showStep(index);
          }
        });
      });
      const studentTypeSelect = document.getElementById('studentType');
      const previousIdContainer = document.getElementById('previousIdContainer');
      const yearLevelStep4 = document.getElementById('yearLevelStep4');
      const preferredBranchSelect = document.getElementById('preferredBranch');
      const preferredCourseSelect = document.getElementById('preferredCourse');
      const documentUploadList = document.getElementById('documentUploadList');
      const courseOptions = {
        "1": [
          { course_id: 1, name: "BLIS - Bachelor in Library Information Science" },
          { course_id: 2, name: "BPED - Bachelor in Physical Education" },
          { course_id: 3, name: "BEED - Bachelor of Elementary Education" },
          { course_id: 4, name: "BSAIS - BS in Accounting Information System" },
          { course_id: 5, name: "BSBA FM - BSBA major in Financial Management" },
          { course_id: 6, name: "BSBA HRM - BSBA major in Human Resource Management" },
          { course_id: 7, name: "BSBA MM - BSBA major in Marketing Management" },
          { course_id: 8, name: "BSBA MM - BSBA major in Marketing Management" },
          { course_id: 9, name: "BSCRIM - BS in Criminology" },
          { course_id: 10, name: "BSENTREP - BS in Entrepreneurship" },
          { course_id: 11, name: "BSHM - BS in Hospitality Management" },
          { course_id: 12, name: "BSIT - BS in Information Technology" },
          { course_id: 13, name: "BSOA - BS in Office Administration" },
          { course_id: 14, name: "BSP - BS in Psychology" },
          { course_id: 15, name: "BSTM - BS in Tourism Management" },
          { course_id: 16, name: "BSED english - BSEd major in English" },
          { course_id: 17, name: "BSED filipino - BSEd major in Filipino" },
          { course_id: 18, name: "BSED math - BSEd major in Mathematics" },
          { course_id: 19, name: "BSED science - BSEd major in Science" },
          { course_id: 20, name: "BSED social studies - BSEd major in Social Studies" },
          { course_id: 21, name: "BSED values - BSEd major in Values" },
          { course_id: 22, name: "BTLED - Bachelor of Technology and Livelihood Education" },
          { course_id: 23, name: "CPE - Certificate of Professional Education" }
        ],
        "2": [
          { course_id: 24, name: "Bulacan BTVTED - BTVTED major in Food Service Management" },
          { course_id: 25, name: "Bulacan BPE - Bachelor of Physical Education major in School PE" },
          { course_id: 26, name: "Bulacan BSAIS - Bachelor of Science in Accounting Information System" },
          { course_id: 27, name: "Bulacan BSCPE - Bachelor of Science in Computer Engineering" },
          { course_id: 28, name: "Bulacan BSCRIM - Bachelor of Science in Criminology" },
          { course_id: 29, name: "Bulacan BSENTREP - Bachelor of Science in Entrepreneurship" },
          { course_id: 30, name: "Bulacan BSIS - Bachelor of Science in Information System" },
          { course_id: 31, name: "Bulacan BSP - Bachelor of Science in Psychology" },
          { course_id: 32, name: "Bulacan BSTM - Bachelor of Science in Tourism Management" }
        ]
      };
      const requiredDocuments = {
        'New Regular': [
           { doc_id: 1, name: 'Form 138 (Report Card)' },
           { doc_id: 3, name: 'Form 137' },
           { doc_id: 5, name: 'Certificate of Good Moral' },
           { doc_id: 7, name: 'PSA Authenticated Birth Certificate' },
           { doc_id: 9, name: 'Passport Size ID Picture (White Background, Formal Attire) - 2 pcs' },
           { doc_id: 11, name: 'Barangay Clearance' }
      ],
        'Returnee': [
           { doc_id: 2, name: 'Form 138 (Report Card)' },
           { doc_id: 4, name: 'Form 137' },
           { doc_id: 6, name: 'Certificate of Good Moral' },
           { doc_id: 8, name: 'PSA Authenticated Birth Certificate' },
           { doc_id: 10, name: 'Passport Size ID Picture (White Background, Formal Attire) - 2 pcs' },
           { doc_id: 12, name: 'Barangay Clearance' }
      ],
        'Transferee': [
          { doc_id: 13, name: 'Transcript of Records from Previous School' },
          { doc_id: 14, name: 'Honorable Dismissal' },
          { doc_id: 15, name: 'Certificate of Good Moral' },
          { doc_id: 16, name: 'PSA Authenticated Birth Certificate' },
          { doc_id: 17, name: 'Passport Size ID Picture (White Background, Formal Attire) - 2 pcs' },
          { doc_id: 18, name: 'Barangay Clearance' }
       ]
      };
      function updateYearLevelOptions() {
        const studentType = studentTypeSelect.value;
        yearLevelStep4.innerHTML = '<option value="" selected disabled>Choose year level</option>';
        if (studentType === 'New Regular') {
          yearLevelStep4.innerHTML += '<option value="1">1st Year</option>';
        } else if (['Transferee', 'Returnee'].includes(studentType)) {
          for (let i = 1; i <= 5; i++) {
            const year = `${i}${i === 1 ? 'st' : i === 2 ? 'nd' : i === 3 ? 'rd' : 'th'} Year`;
            yearLevelStep4.innerHTML += `<option value="${i}">${year}</option>`;
          }
        }
      }
      studentTypeSelect.addEventListener('change', () => {
        if (studentTypeSelect.value === 'Returnee') {
          previousIdContainer.classList.remove('d-none');
          document.getElementById('previousStudentId').setAttribute('required', 'required');
        } else {
          previousIdContainer.classList.add('d-none');
          document.getElementById('previousStudentId').removeAttribute('required');
          document.getElementById('previousStudentId').value = '';
        }
        updateYearLevelOptions();
        updateDocumentUploadList();
      });
      preferredBranchSelect.addEventListener('change', () => {
        const branch = preferredBranchSelect.value;
        const courses = courseOptions[branch] || [];
        preferredCourseSelect.innerHTML = '<option value="" selected disabled>Choose preferred course</option>';
        courses.forEach(course => {
               const option = document.createElement('option');
               option.value = course.course_id;
               option.textContent = course.name;
               preferredCourseSelect.appendChild(option);
        });
      });
      function updateDocumentUploadList() {
  const studentType = studentTypeSelect.value;
  const docs = requiredDocuments[studentType] || [];
  documentUploadList.innerHTML = '';

  // Define which doc_ids are "to follow" eligible per student type
  const toFollowEligible = {
    'New Regular': [3, 5],      // Form 137, Certificate of Good Moral
    'Returnee': [4, 6],         // Form 137, Certificate of Good Moral
    'Transferee': [15, 16, 17, 18] // Good Moral, PSA, ID Pic, Barangay Clearance
  };

  const eligibleDocIds = toFollowEligible[studentType] || [];

  docs.forEach((doc, index) => {
    const isEligible = eligibleDocIds.includes(doc.doc_id);
    const docGroup = document.createElement('div');
    docGroup.className = 'mb-4 position-relative';

    // "To follow" checkbox (only if eligible)
    const toFollowCheckbox = isEligible
      ? `<div class="form-check mt-2">
          <input class="form-check-input to-follow-checkbox" type="checkbox" id="toFollow_${doc.doc_id}" name="to_follow[${doc.doc_id}]" value="1">
          <label class="form-check-label text-muted" for="toFollow_${doc.doc_id}">
            To follow (I will submit this later)
          </label>
        </div>`
      : '';

    docGroup.innerHTML = `
      <label class="form-label">
        <i class="fas fa-file-upload text-primary me-1"></i>
        ${doc.name} <span class="required-star">*</span>
      </label>
      <input type="file" class="form-control document-file-input" name="documents[]" accept=".pdf,.jpg,.jpeg,.png" required />
      <div class="invalid-feedback">Please upload a valid copy of ${doc.name}.</div>
      <div class="mt-2 preview-container" style="display: none;">
        <strong>Preview:</strong>
        <div class="border rounded p-2 bg-light" style="max-height: 200px; overflow: auto;">
          <img src="" alt="Preview" class="img-fluid mb-2 d-none" style="max-height: 150px;" />
          <a href="#" class="pdf-preview d-none text-danger" target="_blank"><i class="fas fa-file-pdf me-1"></i>View PDF</a>
        </div>
      </div>
      ${toFollowCheckbox}
    `;

    // Hidden input for doc_id
    const hiddenDocId = document.createElement('input');
    hiddenDocId.type = 'hidden';
    hiddenDocId.name = 'document_doc_id[]';
    hiddenDocId.value = doc.doc_id;
    docGroup.appendChild(hiddenDocId);

    documentUploadList.appendChild(docGroup);

    // File preview logic
    const fileInput = docGroup.querySelector('.document-file-input');
    const previewContainer = docGroup.querySelector('.preview-container');
    const imgPreview = docGroup.querySelector('img');
    const pdfPreview = docGroup.querySelector('.pdf-preview');

    fileInput.dataset.docId = doc.doc_id;

    fileInput.addEventListener('change', function () {
      const file = this.files[0];
      if (!file) {
        previewContainer.style.display = 'none';
        return;
      }
      if (file.size > 5 * 1024 * 1024) {
        alert(`File too large: ${file.name}. Maximum is 5MB.`);
        this.value = '';
        previewContainer.style.display = 'none';
        return;
      }
      const fileURL = URL.createObjectURL(file);
      previewContainer.style.display = 'block';
      imgPreview.classList.add('d-none');
      pdfPreview.classList.add('d-none');
      if (file.type.startsWith('image/')) {
        imgPreview.src = fileURL;
        imgPreview.classList.remove('d-none');
      } else if (file.type === 'application/pdf') {
        pdfPreview.href = fileURL;
        pdfPreview.classList.remove('d-none');
      }
    });

    // "To follow" checkbox toggle logic
    if (isEligible) {
      const toFollowCheckboxEl = docGroup.querySelector('.to-follow-checkbox');
      toFollowCheckboxEl.addEventListener('change', function () {
        const fileInput = docGroup.querySelector('.document-file-input');
        const requiredStar = docGroup.querySelector('.required-star');
        if (this.checked) {
          fileInput.removeAttribute('required');
          fileInput.classList.remove('is-invalid');
          if (requiredStar) {
            requiredStar.textContent = ' (optional if "To follow" is checked)';
          }
        } else {
          fileInput.setAttribute('required', 'required');
          if (requiredStar) {
            requiredStar.innerHTML = '*';
          }
        }
      });
    }
  });
}
      function showStep(index) {
        maxStep = Math.max(maxStep, index);
        // First, set all stepper steps to disabled
        stepperSteps.forEach(s => {
          s.classList.remove('active', 'completed');
          s.classList.add('disabled');
        });
        // Then set active for current
        stepperSteps[index].classList.remove('disabled');
        stepperSteps[index].classList.add('active');
        // Set completed for all steps up to maxStep, except current
        for (let i = 0; i <= maxStep; i++) {
          if (i !== index) {
            stepperSteps[i].classList.remove('disabled');
            stepperSteps[i].classList.add('completed');
          }
        }
        steps.forEach(s => s.classList.remove('active'));
        steps[index].classList.add('active');
        prevBtn.disabled = index === 0;
        nextBtn.innerHTML = index === steps.length - 1
          ? '<i class="fas fa-paper-plane me-2"></i>Submit'
          : 'Next<i class="fas fa-arrow-right ms-2"></i>';
        currentStep = index;
        if (index === steps.length - 1) { // Update summary only on last step
          populateSummary();
        }
        setTimeout(() => document.querySelector('.card').scrollIntoView({ behavior: 'smooth' }), 100);
      }
      function validateStep(index) {
  const step = steps[index];
  const inputs = step.querySelectorAll('input, select');
  let valid = true;

  inputs.forEach(input => {
    input.classList.remove('is-invalid');
    if (input.hasAttribute('required') && !input.value) {
      input.classList.add('is-invalid');
      valid = false;
    }
  });

  // Special handling for Step 7: Document Uploads
  if (index === 6) {
    const fileInputs = document.querySelectorAll('#documentUploadList input[type="file"]');
    fileInputs.forEach(input => {
      const docId = input.dataset.docId;
      const toFollowCheckbox = input.closest('.mb-4').querySelector('.to-follow-checkbox');
      const isToFollow = toFollowCheckbox && toFollowCheckbox.checked;

      // If "To follow" is checked → file is optional → skip validation
      if (isToFollow) {
        input.classList.remove('is-invalid');
        return; // Skip validation for this file
      }

      // Otherwise, validate normally
      if (!input.files || input.files.length === 0) {
        input.classList.add('is-invalid');
        valid = false;
      } else {
        // Optional: Validate file type/size here too if needed
        const file = input.files[0];
        if (file.size > 5 * 1024 * 1024) {
          input.classList.add('is-invalid');
          valid = false;
        }
      }
    });
  }

  return valid;
}
function populateSummary() {
  const data = new FormData(form);
  let html = '';

  // Student Information Card
  html += '<div class="card mb-3"><div class="card-header-custom">Student Information</div><div class="card-body"><div class="row g-3">';
  html += `<div class="col-md-6"><span class="summary-label">Student Type:</span> ${data.get('studentType') || ''}</div>`;
  if (data.get('studentType') === 'Returnee') {
    html += `<div class="col-md-6"><span class="summary-label">Previous Student ID No:</span> ${data.get('previousStudentId') || ''}</div>`;
  }
  html += `<div class="col-md-4"><span class="summary-label">First Name:</span> ${data.get('firstName') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Middle Name:</span> ${data.get('middleName') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Last Name:</span> ${data.get('lastName') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Extension Name:</span> ${data.get('hasExtensionName') ? data.get('extensionName') || 'None' : 'None'}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Civil Status:</span> ${data.get('civilStatus') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Gender:</span> ${data.get('gender') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Date of Birth:</span> ${data.get('dob') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Place of Birth:</span> ${data.get('placeOfBirth') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Nationality:</span> ${data.get('nationality') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Indigenous Group:</span> ${document.querySelector('#indigenous option:checked')?.text || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Disability Type:</span> ${document.querySelector('#disability option:checked')?.text || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Learner Reference Number (LRN):</span> ${data.get('lrn') || ''}</div>`;
  html += '</div></div></div>';

  // Address & Contact Card
  html += '<div class="card mb-3"><div class="card-header-custom">Address & Contact</div><div class="card-body"><div class="row g-3">';
  html += `<div class="col-md-6"><span class="summary-label">Current Address:</span> ${data.get('currentAddress') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">City/Municipality:</span> ${data.get('cityMunicipality') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Province:</span> ${data.get('province') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Region:</span> ${document.querySelector('#region option:checked')?.text || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Zip Code:</span> ${data.get('zipCode') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Religion:</span> ${data.get('religion') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Email:</span> ${data.get('email') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Contact Number:</span> ${data.get('contactNumber') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Social Media:</span> ${data.get('socialMedia') || ''}</div>`;
  html += '</div></div></div>';

  // Parents Information Card
  html += '<div class="card mb-3"><div class="card-header-custom">Parents Information</div><div class="card-body"><div class="row g-3">';
  html += `<div class="col-md-4"><span class="summary-label">Mother's First Name:</span> ${data.get('motherFirstName') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Middle Name:</span> ${data.get('motherMiddleName') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Last Name:</span> ${data.get('motherLastName') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Occupation:</span> ${data.get('motherOccupation') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Contact Number:</span> ${data.get('motherContact') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Email:</span> ${data.get('motherEmail') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Father's First Name:</span> ${data.get('fatherFirstName') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Middle Name:</span> ${data.get('fatherMiddleName') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Last Name:</span> ${data.get('fatherLastName') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Occupation:</span> ${data.get('fatherOccupation') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Contact Number:</span> ${data.get('fatherContact') || ''}</div>`;
  html += `<div class="col-md-4"><span class="summary-label">Email:</span> ${data.get('fatherEmail') || ''}</div>`;
  html += '</div></div></div>';

  // Additional Information Card
  html += '<div class="card mb-3"><div class="card-header-custom">Additional Information</div><div class="card-body"><div class="row g-3">';
  html += `<div class="col-md-6"><span class="summary-label">4Ps Member:</span> ${data.get('isFourPs') ? 'Yes' : 'No'}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Not living with parents:</span> ${data.get('notLivingWithParents') ? 'Yes' : 'No'}</div>`;
  if (data.get('notLivingWithParents')) {
    html += `<div class="col-12"><h6 style="color: var(--primary-color); font-weight: 700;">Guardian Information</h6></div>`;
    html += `<div class="col-md-4"><span class="summary-label">First Name:</span> ${data.get('guardianFirstName') || ''}</div>`;
    html += `<div class="col-md-4"><span class="summary-label">Middle Name:</span> ${data.get('guardianMiddleName') || ''}</div>`;
    html += `<div class="col-md-4"><span class="summary-label">Last Name:</span> ${data.get('guardianLastName') || ''}</div>`;
    html += `<div class="col-md-3"><span class="summary-label">Date of Birth:</span> ${data.get('guardianDob') || ''}</div>`;
    html += `<div class="col-md-6"><span class="summary-label">Contact Number:</span> ${data.get('guardianContact') || ''}</div>`;
    html += `<div class="col-md-3"><span class="summary-label">Email:</span> ${data.get('guardianEmail') || ''}</div>`;
  }
  html += '</div></div></div>';

  // Preferences Card
  html += '<div class="card mb-3"><div class="card-header-custom">Preferences</div><div class="card-body"><div class="row g-3">';
  html += `<div class="col-md-6"><span class="summary-label">Preferred Branch:</span> ${document.querySelector('#preferredBranch option:checked')?.text || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Preferred Course:</span> ${document.querySelector('#preferredCourse option:checked')?.text || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Year Level:</span> ${document.querySelector('#yearLevelStep4 option:checked')?.text || ''}</div>`;
  html += '</div></div></div>';

  // Health Information Card
  html += '<div class="card mb-3"><div class="card-header-custom">Health Information</div><div class="card-body"><div class="row g-3">';
  html += `<div class="col-md-6"><span class="summary-label">Medical Condition:</span> ${data.get('healthCondition') || ''}</div>`;
  if (data.get('healthCondition') === 'Others') {
    html += `<div class="col-md-6"><span class="summary-label">Specified Condition:</span> ${data.get('healthConditionOthers') || ''}</div>`;
  }
  html += `<div class="col-md-6"><span class="summary-label">Weight (kg):</span> ${data.get('weightKg') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Height (cm):</span> ${data.get('heightCm') || ''}</div>`;
  html += '</div></div></div>';

  // Referral Source Card
  html += '<div class="card mb-3"><div class="card-header-custom">Referral Source</div><div class="card-body"><div class="row g-3">';
  html += `<div class="col-md-6"><span class="summary-label">How did you hear about us?:</span> ${data.get('referralSource') || ''}</div>`;
  if (data.get('referralSource') === 'Adviser/Referral/Others') {
    html += `<div class="col-md-6"><span class="summary-label">Referral Name:</span> ${data.get('referralName') || ''}</div>`;
    html += `<div class="col-md-6"><span class="summary-label">Referral Relation:</span> ${data.get('referralRelation') || ''}</div>`;
  }
  html += '</div></div></div>';

  // Educational Background Card
  html += '<div class="card mb-3"><div class="card-header-custom">Educational Background</div><div class="card-body"><div class="row g-3">';
  html += `<div class="col-md-6"><span class="summary-label">Primary School:</span> ${data.get('primarySchool') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Year Graduated (Primary):</span> ${data.get('primaryYearGraduated') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Secondary School:</span> ${data.get('secondarySchool') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Year Graduated (Secondary):</span> ${data.get('secondaryYearGraduated') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Last School Attended:</span> ${data.get('lastSchoolAttended') || ''}</div>`;
  html += `<div class="col-md-6"><span class="summary-label">Year Graduated (Last School):</span> ${data.get('lastSchoolYearGraduated') || ''}</div>`;
  html += '</div></div></div>';

  document.getElementById('summaryContent').innerHTML = html;
}

      // FINAL SUBMIT WITH AJAX (UPDATED)
      nextBtn.addEventListener('click', () => {
        if (validateStep(currentStep)) {
          // Special validation for Step 9: agreement checkbox
          if (currentStep === steps.length - 1) {
            const agreementChecked = document.getElementById('agreement').checked;
            if (!agreementChecked) {
              alert('Please agree to the certification and privacy terms to proceed.');
              return;
            }
          }

          if (currentStep < steps.length - 1) {
            showStep(currentStep + 1);
            if (currentStep === 6) {
              populateSummary();
            }
          } else {
            const formData = new FormData(form);
            nextBtn.disabled = true;
            nextBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
            fetch(SUBMIT_ENROLLMENT_URL, {
              method: 'POST',
              body: formData,
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
              },
              credentials: 'same-origin'
            })
            .then(response => response.json().then(data => ({ status: response.status, ok: response.ok, body: data })))
            .then(({ status, ok, body }) => {
              if (!ok) {
                nextBtn.disabled = false;
                nextBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit';
                if (body.errors) {
                  // Find first step with error and navigate to it
                  let firstErrorStep = null;
                  for (const key in body.errors) {
                    if (body.errors.hasOwnProperty(key)) {
                      // Map error keys to step numbers (example mapping, adjust as needed)
                      if (key.startsWith('student')) firstErrorStep = 0;
                      else if (key.startsWith('address')) firstErrorStep = 1;
                      else if (key.startsWith('parent')) firstErrorStep = 2;
                      else if (key.startsWith('health')) firstErrorStep = 3;
                      else if (key.startsWith('preference')) firstErrorStep = 4;
                      else if (key.startsWith('background')) firstErrorStep = 5;
                      else if (key.startsWith('document')) firstErrorStep = 6;
                      else if (key.startsWith('referral')) firstErrorStep = 7;
                      if (firstErrorStep !== null) break;
                    }
                  }
                  if (firstErrorStep !== null) {
                    (async () => {
                      for (const err of body.errors) {
                        await new Promise(resolve => {
                          alert(err);
                          setTimeout(resolve, 500);
                        });
                      }
                    })();
                    showStep(firstErrorStep);
                    stepperSteps[firstErrorStep].classList.add('error');
                  } else {
                    (async () => {
                      for (const err of body.errors) {
                        await new Promise(resolve => {
                          alert(err);
                          setTimeout(resolve, 500);
                        });
                      }
                    })();
                  }
                } else {
                  alert('Error: ' + (body.message || 'Submission failed'));
                }
                return;
              }
              if (body && body.success) {
                window.location.href = body.redirect;
              } else {
                nextBtn.disabled = false;
                nextBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit';
                if (body && body.errors) {
                  // Show each error in a separate alert sequentially with delay
                  (async () => {
                    console.log('Validation errors array:', body.errors); // Log errors array for debugging
                    for (const err of body.errors) {
                      await new Promise(resolve => {
                        alert(err);
                        setTimeout(resolve, 500); // increased delay to ensure sequential alerts
                      });
                    }
                  })();
                } else {
                  alert('Error: ' + ((body && body.message) || 'Submission failed'));
                }
              }
            })
            .catch(error => {
              nextBtn.disabled = false;
              nextBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit';
              if (error && error.message) {
                alert('Network Error: Submission failed. Reason: ' + error.message);
              } else {
                alert('Network Error: Submission failed. Please try again.');
              }
            });
          }
        }
      });
      prevBtn.addEventListener('click', () => {
        if (currentStep > 0) showStep(currentStep - 1);
      });
      // Initialize
      updateYearLevelOptions();
      if (studentTypeSelect.value) updateDocumentUploadList();
      showStep(0);

      // Initialize tooltips
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.map(tooltipTriggerEl => {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
      
    })();
  </script>



   <!-- Privacy Policy Modal -->
<div class="modal fade" id="privacyPolicyModal" tabindex="-1" aria-labelledby="privacyPolicyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="privacyPolicyModalLabel">Privacy Policy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>We value your privacy and are committed to protecting your personal data in compliance with the Data Privacy Act of 2012 (RA 10173). By taking this assessment, you agree to the collection and use of your information as described below.</p>

        <h6>1. Information We Collect</h6>
        <ul>
          <li><strong>Username</strong> – for record identification.</li>
          <li><strong>Email Address</strong> – to send you a copy of your results and for official communication.</li>
          <li><strong>Assessment Answers and Results</strong> – to generate recommendations and evaluate if the AI system suggested the right course or strand.</li>
        </ul>

        <h6>2. How We Use Your Information</h6>
        <ul>
          <li>To provide your personalized course/strand recommendations.</li>
          <li>To email you a copy of your results.</li>
          <li>To analyze data for research and system improvement.</li>
          <li>To maintain records for enrollment-related purposes.</li>
        </ul>

        <h6>3. Data Retention</h6>
        <p>Your personal information (username, email, answers, results) will be retained for up to 1 year or until it is no longer necessary for the purposes stated. You may request deletion of your data at any time by contacting us.</p>

        <h6>4. Data Sharing</h6>
        <p>We do not sell, rent, or share your data with third parties. Your information will only be accessed by authorized school personnel for academic and system-related purposes.</p>

        <h6>5. Your Rights as a Data Subject</h6>
        <p>Under the Data Privacy Act, you have the right to:</p>
        <ul>
          <li>Access your personal data.</li>
          <li>Request correction of inaccuracies.</li>
          <li>Request deletion of your data.</li>
          <li>Withdraw consent at any time.</li>
        </ul>

        <h6>6. Data Security</h6>
        <p>We implement technical and organizational measures to protect your information from unauthorized access, loss, or misuse.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>