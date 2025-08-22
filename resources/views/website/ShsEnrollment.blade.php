<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Bestlink College of the Philippines - SHS Enrollment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
  <!-- Navigation Bar -->
  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container" style="margin-top: 2%;">
     <img src="../images/bcp.png" alt="Bestlink College Of The Philippines" class="img-fluid" width="100"  height="100">
      <h1 class="display-4 fw-bold">SHS Enrollment</h1>
      <p class="lead">Start your Senior High School journey with Bestlink College of the Philippines.</p>
    </div>
  </section>
  <div class="container py-5" id="enrollment-form">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center">
        <h2 class="fw-bold text-primary-custom mb-3 section-title">SHS Enrollment Form</h2>
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
              <div class="step disabled" data-step="4">Step 4: Preferences</div>
              <div class="step disabled" data-step="5">Step 5: Backgrounds</div>
              <div class="step disabled" data-step="6">Step 6: Documents</div>
              <div class="step disabled" data-step="7">Step 7: Summary</div>
            </div>
            <form id="registrationForm" novalidate>
              <!-- STEP 1 -->
              <section class="form-section active" data-step="1">
                <h3 class="stepper-header mb-4">Step 1: Student Information</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="studentType" class="form-label">Student Type<span class="required-star">*</span></label>
                    <select class="form-select" id="studentType" name="studentType" required>
                      <option value="" selected disabled>Choose student type</option>
                      <option value="New Regular">New Regular</option>
                      <option value="Transferee">Transferee</option>
                      <option value="Returnee">Returnee</option>
                    </select>
                    <div class="invalid-feedback">Please select a student type.</div>
                  </div>
                  <div class="col-md-6 d-none" id="previousIdContainer">
                    <label for="previousStudentId" class="form-label">Previous Student ID No (8 digits)<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="previousStudentId" name="previousStudentId" pattern="^\d{8}$" maxlength="8" />
                    <div class="invalid-feedback">Please enter a valid 8-digit Previous Student ID.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="firstName" class="form-label">First Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required />
                    <div class="invalid-feedback">Please enter your first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="middleName" class="form-label">Middle Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="middleName" name="middleName" required />
                    <div class="invalid-feedback">Please enter your middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="lastName" class="form-label">Last Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required />
                    <div class="invalid-feedback">Please enter your last name.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="extensionName" class="form-label">Extension Name (Optional)</label>
                    <input type="text" class="form-control" id="extensionName" name="extensionName" />
                  </div>
                  <div class="col-md-6">
                    <label for="civilStatus" class="form-label">Civil Status<span class="required-star">*</span></label>
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
                    <label for="gender" class="form-label">Gender<span class="required-star">*</span></label>
                    <select class="form-select" id="gender" name="gender" required>
                      <option value="" selected disabled>Choose gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    <div class="invalid-feedback">Please select your gender.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="dob" class="form-label">Date of Birth<span class="required-star">*</span></label>
                    <input type="date" class="form-control" id="dob" name="dob" max="" required />
                    <div class="invalid-feedback">Please enter your date of birth.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="placeOfBirth" class="form-label">Place of Birth<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" required />
                    <div class="invalid-feedback">Please enter your place of birth.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="nationality" class="form-label">Nationality<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="nationality" name="nationality" required />
                    <div class="invalid-feedback">Please enter your nationality.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="lrn" class="form-label">Learner Reference Number (LRN)<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="lrn" name="lrn" pattern="^\d{12}$" maxlength="12" required />
                    <div class="invalid-feedback">Please enter a valid 12-digit LRN.</div>
                  </div>
                </div>
              </section>
              <!-- STEP 2 -->
              <section class="form-section" data-step="2">
                <h3 class="stepper-header mb-4">Step 2: Address</h3>
                <div class="row g-3">
                  <div class="col-md-12">
                    <label for="currentAddress" class="form-label">Current Address<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="currentAddress" name="currentAddress" required />
                    <div class="invalid-feedback">Please enter your current address.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="cityMunicipality" class="form-label">City/Municipality<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="cityMunicipality" name="cityMunicipality" required />
                    <div class="invalid-feedback">Please enter your city or municipality.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="region" class="form-label">Region<span class="required-star">*</span></label>
                    <select class="form-select" id="region" name="region" required>
                      <option value="" selected disabled>Choose region</option>
                      <option>Region I - Ilocos Region</option>
                      <option>Region II - Cagayan Valley</option>
                      <option>Region III - Central Luzon</option>
                      <option>Region IV-A - CALABARZON</option>
                      <option>Region IV-B - MIMAROPA</option>
                      <option>Region V - Bicol Region</option>
                      <option>Region VI - Western Visayas</option>
                      <option>Region VII - Central Visayas</option>
                      <option>Region VIII - Eastern Visayas</option>
                      <option>Region IX - Zamboanga Peninsula</option>
                      <option>Region X - Northern Mindanao</option>
                      <option>Region XI - Davao Region</option>
                      <option>Region XII - SOCCSKSARGEN</option>
                      <option>Region XIII - Caraga</option>
                      <option>BARMM</option>
                    </select>
                    <div class="invalid-feedback">Please select your region.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="zipCode" class="form-label">Zip Code<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="zipCode" name="zipCode" pattern="^\d{4,6}$" required />
                    <div class="invalid-feedback">Please enter a valid zip code (4-6 digits).</div>
                  </div>
                  <div class="col-md-6">
                    <label for="province" class="form-label">Province<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="province" name="province" required />
                    <div class="invalid-feedback">Please enter your province.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="religion" class="form-label">Religion<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="religion" name="religion" required />
                    <div class="invalid-feedback">Please enter your religion.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email<span class="required-star">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" required />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="contactNumber" class="form-label">Contact Number<span class="required-star">*</span></label>
                    <input type="tel" class="form-control" id="contactNumber" name="contactNumber" pattern="^\+?\d{7,15}$" required />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="socialMedia" class="form-label">Social Media Account<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="socialMedia" name="socialMedia" required />
                    <div class="invalid-feedback">Please enter your social media account.</div>
                  </div>
                </div>
              </section>
              <!-- STEP 3 -->
              <section class="form-section" data-step="3">
                <h3 class="stepper-header mb-4">Step 3: Parents Information</h3>
                <div class="row g-3">
                  <h5 class="mb-3" style="color: var(--primary-dark); font-weight: 700;">Mother's Information</h5>
                  <div class="col-md-4">
                    <label for="motherFirstName" class="form-label">First Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="motherFirstName" name="motherFirstName" required />
                    <div class="invalid-feedback">Please enter mother's first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherMiddleName" class="form-label">Middle Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="motherMiddleName" name="motherMiddleName" required />
                    <div class="invalid-feedback">Please enter mother's middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherLastName" class="form-label">Last Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="motherLastName" name="motherLastName" required />
                    <div class="invalid-feedback">Please enter mother's last name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherOccupation" class="form-label">Occupation<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="motherOccupation" name="motherOccupation" required />
                    <div class="invalid-feedback">Please enter mother's occupation.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherContact" class="form-label">Contact Number<span class="required-star">*</span></label>
                    <input type="tel" class="form-control" id="motherContact" name="motherContact" pattern="^\+?\d{7,15}$" required />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherEmail" class="form-label">Email<span class="required-star">*</span></label>
                    <input type="email" class="form-control" id="motherEmail" name="motherEmail" required />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <h5 class="mb-3 mt-4" style="color: var(--primary-dark); font-weight: 700;">Father's Information</h5>
                  <div class="col-md-4">
                    <label for="fatherFirstName" class="form-label">First Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="fatherFirstName" name="fatherFirstName" required />
                    <div class="invalid-feedback">Please enter father's first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherMiddleName" class="form-label">Middle Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="fatherMiddleName" name="fatherMiddleName" required />
                    <div class="invalid-feedback">Please enter father's middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherLastName" class="form-label">Last Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="fatherLastName" name="fatherLastName" required />
                    <div class="invalid-feedback">Please enter father's last name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherOccupation" class="form-label">Occupation<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="fatherOccupation" name="fatherOccupation" required />
                    <div class="invalid-feedback">Please enter father's occupation.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherContact" class="form-label">Contact Number<span class="required-star">*</span></label>
                    <input type="tel" class="form-control" id="fatherContact" name="fatherContact" pattern="^\+?\d{7,15}$" required />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherEmail" class="form-label">Email<span class="required-star">*</span></label>
                    <input type="email" class="form-control" id="fatherEmail" name="fatherEmail" required />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <h5 class="mb-3 mt-4" style="color: var(--primary-dark); font-weight: 700;">Guardian's Information (If not living with parents)</h5>
                  <div class="col-md-4">
                    <label for="guardianFirstName" class="form-label">First Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="guardianFirstName" name="guardianFirstName" />
                    <div class="invalid-feedback">Please enter guardian's first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="guardianMiddleName" class="form-label">Middle Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="guardianMiddleName" name="guardianMiddleName" />
                    <div class="invalid-feedback">Please enter guardian's middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="guardianLastName" class="form-label">Last Name<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="guardianLastName" name="guardianLastName" />
                    <div class="invalid-feedback">Please enter guardian's last name.</div>
                  </div>
                  <div class="col-md-3">
                    <label for="guardianDob" class="form-label">Date of Birth<span class="required-star">*</span></label>
                    <input type="date" class="form-control" id="guardianDob" name="guardianDob" max="" />
                    <div class="invalid-feedback">Please enter guardian's date of birth.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="guardianContact" class="form-label">Contact Number<span class="required-star">*</span></label>
                    <input type="tel" class="form-control" id="guardianContact" name="guardianContact" pattern="^\+?\d{7,15}$" />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-3">
                    <label for="guardianEmail" class="form-label">Email<span class="required-star">*</span></label>
                    <input type="email" class="form-control" id="guardianEmail" name="guardianEmail" />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                </div>
              </section>
              <!-- STEP 4 -->
              <section class="form-section" data-step="4">
                <h3 class="stepper-header mb-4">Step 4: Preferences</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="preferredBranch" class="form-label">Preferred Branch<span class="required-star">*</span></label>
                    <select class="form-select" id="preferredBranch" name="preferredBranch" required>
                      <option value="" selected disabled>Choose preferred branch</option>
                      <option value="Main Branch">Main Branch</option>
                      <option value="Bulacan Branch">Bulacan Branch</option>
                    </select>
                    <div class="invalid-feedback">Please select a preferred branch.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="preferredCourse" class="form-label">Preferred Course<span class="required-star">*</span></label>
                    <select class="form-select" id="preferredCourse" name="preferredCourse" required>
                      <option value="" selected disabled>Choose preferred course</option>
                    </select>
                    <div class="invalid-feedback">Please select a preferred course.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="yearLevelStep4" class="form-label">Year Level<span class="required-star">*</span></label>
                    <select class="form-select" id="yearLevelStep4" name="yearLevelStep4" required>
                      <option value="" selected disabled>Choose year level</option>
                    </select>
                    <div class="invalid-feedback">Please select your year level.</div>
                  </div>
                </div>
              </section>
              <!-- STEP 5 -->
              <section class="form-section" data-step="5">
                <h3 class="stepper-header mb-4">Step 5: Educational Background</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="primarySchool" class="form-label">Primary School<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="primarySchool" name="primarySchool" required />
                    <div class="invalid-feedback">Please enter your primary school.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="primaryYearGraduated" class="form-label">Year Graduated (Primary)<span class="required-star">*</span></label>
                    <input type="number" class="form-control" id="primaryYearGraduated" name="primaryYearGraduated" min="1900" max="2099" step="1" required />
                    <div class="invalid-feedback">Please enter a valid year graduated.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="secondarySchool" class="form-label">Secondary School<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="secondarySchool" name="secondarySchool" required />
                    <div class="invalid-feedback">Please enter your secondary school.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="secondaryYearGraduated" class="form-label">Year Graduated (Secondary)<span class="required-star">*</span></label>
                    <input type="number" class="form-control" id="secondaryYearGraduated" name="secondaryYearGraduated" min="1900" max="2099" step="1" required />
                    <div class="invalid-feedback">Please enter a valid year graduated.</div>
                  </div>
                  <div class="col-md-10">
                    <label for="lastSchoolAttended" class="form-label">Last School Attended<span class="required-star">*</span></label>
                    <input type="text" class="form-control" id="lastSchoolAttended" name="lastSchoolAttended" required />
                    <div class="invalid-feedback">Please enter your last school attended.</div>
                  </div>
                  <div class="col-md-2">
                    <label for="lastSchoolYearGraduated" class="form-label">Year Graduated<span class="required-star">*</span></label>
                    <input type="number" class="form-control" id="lastSchoolYearGraduated" name="lastSchoolYearGraduated" min="1900" max="2099" step="1" required />
                    <div class="invalid-feedback">Please enter a valid year graduated.</div>
                  </div>
                </div>
              </section>

              <!-- STEP 6: Softcopy of Document Submission -->
              <section class="form-section" data-step="6">
                <h3 class="stepper-header mb-4">Step 6: Softcopy of Document Submission</h3>
                <p class="mb-4 text-muted">Please upload clear and legible scanned copies of the following required documents. Acceptable formats: PDF, JPG, PNG (max 5MB each).</p>

                <div id="documentUploadList">
                  <!-- Documents will be populated by JavaScript -->
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

              <!-- STEP 7: Summary -->
              <section class="form-section" data-step="7">
                <h3 class="stepper-header mb-4">Step 7: Summary</h3>
                <div class="alert alert-info mb-4">
                  <strong><i class="fas fa-info-circle me-2"></i>Please review your information carefully before submitting.</strong>
                </div>
                <div id="summaryContent" class="mb-4">
                  <!-- Summary content will be populated by JavaScript -->
                </div>
                <div class="form-check mb-4">
                  <input class="form-check-input" type="checkbox" id="agreement" required>
                  <label class="form-check-label" for="agreement">
                    I certify that the information provided is true and correct to the best of my knowledge.
                  </label>
                </div>
              </section>

              <!-- Navigation Buttons -->
              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" id="prevBtn" disabled><i class="fas fa-arrow-left me-2"></i>Previous</button>
                <button type="button" class="btn btn-primary" id="nextBtn">Next<i class="fas fa-arrow-right ms-2"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Features Section -->
    <div class="row justify-content-center my-5">
      <div class="col-lg-8 text-center mb-5">
        <h2 class="fw-bold text-primary-custom mb-3 section-title">Why Choose Bestlink?</h2>
        <p class="lead">Discover the advantages of studying at Bestlink College of the Philippines</p>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-box">
          <i class="fas fa-award"></i>
          <h4>Accredited Programs</h4>
          <p>Our courses are recognized by CHED and industry partners for quality education.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-box">
          <i class="fas fa-chalkboard-teacher"></i>
          <h4>Expert Faculty</h4>
          <p>Learn from experienced professionals and educators in your field of study.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-box">
          <i class="fas fa-laptop"></i>
          <h4>Modern Facilities</h4>
          <p>State-of-the-art classrooms, laboratories, and learning resources.</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mb-5 mt-5">
      <div class="col-lg-8">
        <h2 class="fw-bold text-primary-custom mb-4 section-title">Enrollment Requirements</h2>
        <p class="mb-4">Prepare the following documents based on your student category to ensure smooth enrollment process.</p>
      </div>
    </div>
    <div class="row justify-content-center g-4">
      <div class="col-md-6">
        <div class="card requirements-card shadow-sm">
          <div class="card-header card-header-custom">
            <h3 class="h4 mb-0"><i class="fas fa-user-graduate me-2"></i>SHS Students</h3>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><i class="fas fa-file-contract me-2 text-primary"></i>Form 138 (Report Card)</li>
              <li class="list-group-item"><i class="fas fa-file-alt me-2 text-primary"></i>Form 137</li>
              <li class="list-group-item"><i class="fas fa-certificate me-2 text-primary"></i>Certificate of Good Moral</li>
              <li class="list-group-item"><i class="fas fa-portrait me-2 text-primary"></i>2"x2" ID Picture (White Background) - 2 pcs</li>
              <li class="list-group-item"><i class="fas fa-file-medical me-2 text-primary"></i>Photocopy of NCAE Result</li>
              <li class="list-group-item"><i class="fas fa-file-medical me-2 text-primary"></i>ESC Certificate, if a graduate of a private Junior High School</li>
              <li class="list-group-item"><i class="fas fa-file-certificate me-2 text-primary"></i>PSA Authenticated Birth Certificate</li>
              <li class="list-group-item"><i class="fas fa-shield-alt me-2 text-primary"></i>Barangay Clearance</li>
              <li class="list-group-item"><i class="fas fa-file-alt me-2 text-primary"></i>Photocopy of Diploma</li>
            </ul>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (() => {
      const form = document.getElementById('registrationForm');
      const steps = Array.from(form.querySelectorAll('section.form-section'));
      const stepperSteps = Array.from(document.querySelectorAll('#stepper .step'));
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');
      let currentStep = 0;

      // Set max date for DOB fields to today
      const today = new Date().toISOString().split('T')[0];
      form.querySelectorAll('input[type="date"]').forEach(input => input.setAttribute('max', today));

      // Show/hide Previous Student ID No. based on Student Type
      const studentTypeSelect = document.getElementById('studentType');
      const previousIdContainer = document.getElementById('previousIdContainer');
      const previousStudentIdInput = document.getElementById('previousStudentId');
      const yearLevelStep4 = document.getElementById('yearLevelStep4');

      // Course options for each branch
      const courseOptions = {
        "Main Branch": [
          "ABM - Accountancy, Business and Management",
          "GAS - General Academic Strand",
          "HECF - Home Economics - Culinary Arts and Food Services",
          "HEHRS - Home Economics - Hotel and Restaurant Services",
          "HEHO - Home Economics - Hotel Operation",
          "HETEM - Home Economics - Tourism and Event Management",
          "HUMSS - Humanities and Social Sciences",
          "ICT-HW - ICT - Hardware",
          "ICT-CP - ICT - Programming",
          "ICT Animation - ICT - Animation",
          "ICT CCS - ICT - Contact Center Services",
          "ICT Visual Graphics - ICT - Visual Graphics",
          "STEM - Science, Technology, Engineering and Mathematics",
          "STEM PBM - STEM - Pre-Baccalaureate Maritime"

        ],
        "Bulacan Branch": [
          "Bulacan ABM - Accountancy, Business and Management",
          "Bulacan HUMSS - Humanities and Social Sciences",
          "Bulacan GAS - General Academic Strand",
          "Bulacan SMAW - Shielded Metal Arc Welding",
          "Bulacan SPORTS - Sport Track",
          "Bulacan AUTO - Automotive",
          "Bulacan ICT - Information and Communications Technology",
          "Bulacan HE - Home Economics",
          "Bulacan STEM - Science, Technology, Engineering and Mathematics"

        ]
      };

      // Handle student type change
      studentTypeSelect.addEventListener('change', () => {
        const studentType = studentTypeSelect.value;
        // Show/hide Previous Student ID
        if (studentType === 'Returnee') {
          previousIdContainer.classList.remove('d-none');
          previousStudentIdInput.setAttribute('required', 'required');
        } else {
          previousIdContainer.classList.add('d-none');
          previousStudentIdInput.removeAttribute('required');
          previousStudentIdInput.value = '';
          previousStudentIdInput.classList.remove('is-invalid');
        }
        // Update year level options
        updateYearLevelOptions();
        // Update document list if Step 6 exists
        if (typeof updateDocumentUploadList === 'function') {
          updateDocumentUploadList();
        }
      });

      // Update year level options based on student type
      function updateYearLevelOptions() {
        const studentType = studentTypeSelect.value;
        yearLevelStep4.innerHTML = '<option value="" selected disabled>Choose year level</option>';
        if (studentType === 'New Regular') {
          yearLevelStep4.innerHTML += '<option value="G11">G11</option>';
        } else if (studentType === 'Transferee' || studentType === 'Returnee') {
          yearLevelStep4.innerHTML += '<option value="G11">G11</option>';
          yearLevelStep4.innerHTML += '<option value="G12">G12</option>';
        }
      }

      // Handle preferred branch change
      const preferredBranchSelect = document.getElementById('preferredBranch');
      const preferredCourseSelect = document.getElementById('preferredCourse');
      preferredBranchSelect.addEventListener('change', () => {
        const branch = preferredBranchSelect.value;
        const courses = courseOptions[branch] || [];
        preferredCourseSelect.innerHTML = '<option value="" selected disabled>Choose preferred course</option>';
        courses.forEach(course => {
          const option = document.createElement('option');
          option.value = course;
          option.textContent = course;
          preferredCourseSelect.appendChild(option);
        });
      });

      // Show specific step
      function showStep(stepIndex) {
        steps.forEach(step => step.classList.remove('active'));
        stepperSteps.forEach(step => step.classList.remove('active', 'completed'));
        steps[stepIndex].classList.add('active');
        stepperSteps[stepIndex].classList.add('active');
        for (let i = 0; i < stepIndex; i++) {
          stepperSteps[i].classList.add('completed');
        }
        prevBtn.disabled = stepIndex === 0;
        nextBtn.textContent = stepIndex === steps.length - 1 ? 'Submit' : 'Next';
        nextBtn.innerHTML = stepIndex === steps.length - 1 ? '<i class="fas fa-paper-plane me-2"></i>Submit' : 'Next<i class="fas fa-arrow-right ms-2"></i>';
        currentStep = stepIndex;
        document.querySelector('.card').scrollIntoView({ behavior: 'smooth' });
      }

      // Validate current step
      function validateStep(index) {
        const step = steps[index];
        const inputs = step.querySelectorAll('input, select, textarea');
        let valid = true;
        inputs.forEach(input => {
          input.classList.remove('is-invalid');
          if (input.hasAttribute('required')) {
            if (input.type === 'checkbox') {
              if (!input.checked) {
                input.classList.add('is-invalid');
                valid = false;
              }
            } else if (input.type === 'text' || input.type === 'number' || input.type === 'email' || input.type === 'tel' || input.tagName === 'SELECT') {
              if (!input.value || !input.checkValidity()) {
                input.classList.add('is-invalid');
                valid = false;
              }
            }
          } else if (input.type === 'text' || input.type === 'number' || input.type === 'email' || input.type === 'tel') {
            if (input.value && !input.checkValidity()) {
              input.classList.add('is-invalid');
              valid = false;
            }
          }
          if (input.id === 'lrn' && !input.value) {
            input.classList.add('is-invalid');
            valid = false;
          }
          if (input.id === 'previousStudentId' && !previousIdContainer.classList.contains('d-none')) {
            if (input.value.length !== 8 || !/^\d{8}$/.test(input.value)) {
              input.classList.add('is-invalid');
              valid = false;
            }
          }
        });

        // Validate document uploads in Step 6
        if (index === 5) {
          const fileInputs = document.querySelectorAll('#documentUploadList input[type="file"]');
          fileInputs.forEach(input => {
            if (!input.files || input.files.length === 0) {
              input.classList.add('is-invalid');
              valid = false;
            } else {
              input.classList.remove('is-invalid');
            }
          });
        }

        return valid;
      }

      // === NEW: Dynamic Document Upload List with Validation & Preview ===
      const documentUploadList = document.getElementById('documentUploadList');

      // All student types have the same required documents
      const requiredDocuments = [
        'Form 138 (Report Card)',
        'Form 137',
        'Certificate of Good Moral',
        '2"x2" ID Picture (White Background) - 2 pcs',
        'Photocopy of NCAE Result',
        'ESC Certificate, if a graduate of a private Junior High School',
        'PSA Authenticated Birth Certificate',
        'Barangay Clearance',
        'Photocopy of Diploma'
      ];

      function updateDocumentUploadList() {
        documentUploadList.innerHTML = '';
        requiredDocuments.forEach((doc, index) => {
          const docGroup = document.createElement('div');
          docGroup.className = 'mb-4';
          docGroup.innerHTML = `
            <label class="form-label">
              <i class="fas fa-file-upload text-primary me-1"></i>
              ${doc} <span class="required-star">*</span>
            </label>
            <input type="file" class="form-control" name="document_${index}" accept=".pdf,.jpg,.jpeg,.png" required />
            <div class="invalid-feedback">Please upload a valid copy of ${doc}.</div>
            <div class="mt-2 preview-container" style="display: none;">
              <strong>Preview:</strong>
              <div class="border rounded p-2 bg-light" style="max-height: 200px; overflow: auto;">
                <img src="" alt="Preview" class="img-fluid mb-2 d-none" style="max-height: 150px;" />
                <a href="#" class="pdf-preview d-none text-danger" target="_blank"><i class="fas fa-file-pdf me-1"></i>View PDF</a>
              </div>
            </div>
          `;
          documentUploadList.appendChild(docGroup);

          const fileInput = docGroup.querySelector('input[type="file"]');
          const previewContainer = docGroup.querySelector('.preview-container');
          const imgPreview = docGroup.querySelector('.img-fluid');
          const pdfPreview = docGroup.querySelector('.pdf-preview');

          fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

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
        });
      }

      // Initialize document upload list
      if (studentTypeSelect.value) {
        updateDocumentUploadList();
      }
      // Update when student type changes
      studentTypeSelect.addEventListener('change', updateDocumentUploadList);

      // Populate summary
      function populateSummary() {
        const data = new FormData(form);
        let html = '<div class="row g-3">';
        html += `<div class="col-12"><h5 style="color: var(--primary-color); font-weight: 700;">Student Information</h5></div>`;
        html += `<div class="col-md-6"><span class="summary-label">Student Type:</span> ${data.get('studentType') || ''}</div>`;
        if (data.get('studentType') === 'Returnee') {
          html += `<div class="col-md-6"><span class="summary-label">Previous Student ID No:</span> ${data.get('previousStudentId') || ''}</div>`;
        }
        html += `<div class="col-md-6"><span class="summary-label">LRN:</span> ${data.get('lrn') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">First Name:</span> ${data.get('firstName') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Middle Name:</span> ${data.get('middleName') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Last Name:</span> ${data.get('lastName') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Extension Name:</span> ${data.get('extensionName') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Civil Status:</span> ${data.get('civilStatus') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Gender:</span> ${data.get('gender') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Date of Birth:</span> ${data.get('dob') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Place of Birth:</span> ${data.get('placeOfBirth') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Nationality:</span> ${data.get('nationality') || ''}</div>`;
        html += `<div class="col-12 mt-3"><h5 style="color: var(--primary-color); font-weight: 700;">Address Information</h5></div>`;
        html += `<div class="col-md-12"><span class="summary-label">Current Address:</span> ${data.get('currentAddress') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">City/Municipality:</span> ${data.get('cityMunicipality') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Region:</span> ${data.get('region') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Zip Code:</span> ${data.get('zipCode') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Province:</span> ${data.get('province') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Religion:</span> ${data.get('religion') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Email:</span> ${data.get('email') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Contact Number:</span> ${data.get('contactNumber') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Social Media:</span> ${data.get('socialMedia') || ''}</div>`;
        html += `<div class="col-12 mt-3"><h5 style="color: var(--primary-color); font-weight: 700;">Parents Information</h5></div>`;
        html += `<div class="col-md-4"><span class="summary-label">Mother's First Name:</span> ${data.get('motherFirstName') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Mother's Middle Name:</span> ${data.get('motherMiddleName') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Mother's Last Name:</span> ${data.get('motherLastName') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Mother's Occupation:</span> ${data.get('motherOccupation') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Mother's Contact:</span> ${data.get('motherContact') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Mother's Email:</span> ${data.get('motherEmail') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Father's First Name:</span> ${data.get('fatherFirstName') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Father's Middle Name:</span> ${data.get('fatherMiddleName') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Father's Last Name:</span> ${data.get('fatherLastName') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Father's Occupation:</span> ${data.get('fatherOccupation') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Father's Contact:</span> ${data.get('fatherContact') || ''}</div>`;
        html += `<div class="col-md-4"><span class="summary-label">Father's Email:</span> ${data.get('fatherEmail') || ''}</div>`;
        if (data.get('guardianFirstName')) {
          html += `<div class="col-12 mt-3"><h5 style="color: var(--primary-color); font-weight: 700;">Guardian Information</h5></div>`;
          html += `<div class="col-md-4"><span class="summary-label">Guardian's First Name:</span> ${data.get('guardianFirstName') || ''}</div>`;
          html += `<div class="col-md-4"><span class="summary-label">Guardian's Middle Name:</span> ${data.get('guardianMiddleName') || ''}</div>`;
          html += `<div class="col-md-4"><span class="summary-label">Guardian's Last Name:</span> ${data.get('guardianLastName') || ''}</div>`;
          html += `<div class="col-md-6"><span class="summary-label">Guardian's Date of Birth:</span> ${data.get('guardianDob') || ''}</div>`;
          html += `<div class="col-md-6"><span class="summary-label">Guardian's Contact:</span> ${data.get('guardianContact') || ''}</div>`;
          html += `<div class="col-md-6"><span class="summary-label">Guardian's Email:</span> ${data.get('guardianEmail') || ''}</div>`;
        }
        html += `<div class="col-12 mt-3"><h5 style="color: var(--primary-color); font-weight: 700;">Preferences</h5></div>`;
        html += `<div class="col-md-6"><span class="summary-label">Preferred Branch:</span> ${data.get('preferredBranch') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Preferred Course:</span> ${data.get('preferredCourse') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Year Level:</span> ${data.get('yearLevelStep4') || ''}</div>`;
        html += `<div class="col-12 mt-3"><h5 style="color: var(--primary-color); font-weight: 700;">Educational Background</h5></div>`;
        html += `<div class="col-md-6"><span class="summary-label">Primary School:</span> ${data.get('primarySchool') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Year Graduated (Primary):</span> ${data.get('primaryYearGraduated') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Secondary School:</span> ${data.get('secondarySchool') || ''}</div>`;
        html += `<div class="col-md-6"><span class="summary-label">Year Graduated (Secondary):</span> ${data.get('secondaryYearGraduated') || ''}</div>`;
        html += `<div class="col-md-12"><span class="summary-label">Last School Attended:</span> ${data.get('lastSchoolAttended') || ''}</div>`;
        html += `<div class="col-md-12"><span class="summary-label">Year Graduated (Last School):</span> ${data.get('lastSchoolYearGraduated') || ''}</div>`;
        html += '</div>';
        document.getElementById('summaryContent').innerHTML = html;
      }

      // Navigation event listeners
      nextBtn.addEventListener('click', () => {
        if (validateStep(currentStep)) {
          if (currentStep < steps.length - 1) {
            showStep(currentStep + 1);
            if (currentStep === 6) {
              populateSummary();
            }
          } else {
            alert('Registration submitted successfully!');
            // Here you would normally submit the form via AJAX
            // form.submit();
          }
        }
      });

      prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
          showStep(currentStep - 1);
        }
      });

      // Initialize
      updateYearLevelOptions();
      if (studentTypeSelect.value) {
        updateDocumentUploadList();
      }
    })();
  </script>
</body>
</html>