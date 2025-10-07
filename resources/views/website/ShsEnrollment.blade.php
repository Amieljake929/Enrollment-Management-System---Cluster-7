<!-- resources/views/website/ShsEnrollment.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Bestlink College of the Philippines - SHS Enrollment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
      .stepper {
        flex-direction: column;
        align-items: center;
      }
      .step {
        margin-bottom: 10px;
        font-size: 0.75rem;
      }
      .step::before {
        width: 28px;
        height: 28px;
        line-height: 28px;
        font-size: 0.75rem;
      }
      .summary-label {
        font-size: 0.8rem;
        display: block;
        margin-bottom: 5px;
      }
      .card-body .row .col-md-6,
      .card-body .row .col-md-4,
      .card-body .row .col-md-3 {
        margin-bottom: 10px;
      }
      #summaryContent {
        font-size: 0.85rem;
      }
    }
  </style>
</head>
<body>
  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container" style="margin-top: 2%;">
      <img src="../images/bcp.png" alt="Bestlink College Of The Philippines" class="img-fluid" width="100" height="100">
      <h1 class="display-4 fw-bold">Senior High School Enrollment</h1>
      <p class="lead">Start your Senior High School journey with Bestlink College of the Philippines. Complete your enrollment process quickly and efficiently.</p>
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
  <div class="step disabled" data-step="4">Step 4: Health Info</div>
  <div class="step disabled" data-step="5">Step 5: Preferences</div>
  <div class="step disabled" data-step="6">Step 6: Backgrounds</div>
  <div class="step disabled" data-step="7">Step 7: Documents</div>
  <div class="step disabled" data-step="8">Step 8: How did you hear about us?</div>
  <div class="step disabled" data-step="9">Step 9: Summary</div>
</div>
            <!-- FORM -->
            <form id="registrationForm" novalidate>
              @csrf
              <!-- STEP 1 -->
              <section class="form-section active" data-step="1">
                <h3 class="stepper-header mb-4">Step 1: Student Information</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="studentType" class="form-label">
                      Student Type<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Choose your student status: New Regular (new student), Transferee (from another school), or Returnee (previously enrolled here).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
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
                    <label for="previousStudentId" class="form-label">
                      Previous Student ID No (8 digits)<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your 8-digit BCP Student ID if you were previously enrolled here. This helps us locate your records.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="previousStudentId" name="previousStudentId" pattern="^\d{8}$" maxlength="8" />
                    <div class="invalid-feedback">Please enter a valid 8-digit Previous Student ID.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="firstName" class="form-label">
                      First Name<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your first name as it appears on your birth certificate.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required />
                    <div class="invalid-feedback">Please enter your first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="middleName" class="form-label">
                      Middle Name<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your middle name. If none, write 'N/A'.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="middleName" name="middleName" required />
                    <div class="invalid-feedback">Please enter your middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="lastName" class="form-label">
                      Last Name<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your last name. This is usually your family name.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required />
                    <div class="invalid-feedback">Please enter your last name.</div>
                  </div>
                  <div class="col-md-6">
                    <div id="extensionNameContainer" class="mt-3">
                      <label class="form-label">
                        Extension Name (Optional)
                        <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select Jr., Sr., etc. if applicable to differentiate duplicate names.">
                          <i class="fas fa-info-circle text-primary"></i>
                        </span>
                      </label>
                       <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="hasExtensionName" name="hasExtensionName" value="1">
                      <label class="form-check-label" for="hasExtensionName">
                        I have an extension name
                      </label>
                    </div>
                      <select class="form-select" id="extensionName" name="extensionName" disabled>
                        <option value="" selected disabled>Choose extension</option>
                        <option value="Jr">Jr.</option>
                        <option value="Sr">Sr.</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="civilStatus" class="form-label">
                      Civil Status<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Your current marital status: Single, Married, Widowed, Separated, or Divorced.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
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
                    <label for="gender" class="form-label">
                      Gender<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select Male or Female based on your official documents.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <select class="form-select" id="gender" name="gender" required>
                      <option value="" selected disabled>Choose gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    <div class="invalid-feedback">Please select your gender.</div>
                  </div>
                  <!-- Indigenous Group -->
                  <div class="col-md-6">
                    <label for="indigenous" class="form-label">
                      Indigenous Group<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select your indigenous group if applicable (e.g., Igorot, Lumad, etc.).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
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
                    <label for="disability" class="form-label">
                      Disability Type<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select your disability type if applicable (e.g., Hearing Impaired, Visually Impaired, etc.).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <select class="form-select" id="disability" name="disability" required>
                      <option value="" selected disabled>Choose Disability type</option>
                      @foreach($disabilityTypes as $type)
                          <option value="{{ $type->disability_id }}">{{ $type->disability_name }}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">Please select a Disability type.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="dob" class="form-label">
                      Date of Birth<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your date of birth in DD-MM-YYYY format (e.g., 01-01-2001).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="date" class="form-control" id="dob" name="dob" max="" required />
                    <div class="invalid-feedback">Please enter your date of birth.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="placeOfBirth" class="form-label">
                      Place of Birth<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the full place where you were born (e.g., Quezon City, Metro Manila).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" required />
                    <div class="invalid-feedback">Please enter your place of birth.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="nationality" class="form-label">
                      Nationality<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your nationality (e.g., Filipino).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="nationality" name="nationality" required />
                    <div class="invalid-feedback">Please enter your nationality.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="lrn" class="form-label">
                      Learner Reference Number (LRN)<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your 12-digit LRN number issued by DepEd. This is required for enrollment.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
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
                    <label for="currentAddress" class="form-label">
                      Current Address<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your complete current address (e.g., Blk 12, Lot 34, Brgy. Maligaya, Quezon City).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="currentAddress" name="currentAddress" required />
                    <div class="invalid-feedback">Please enter your current address.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="cityMunicipality" class="form-label">
                      City/Municipality<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the city or municipality where you currently reside (e.g., Quezon City).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="cityMunicipality" name="cityMunicipality" required />
                    <div class="invalid-feedback">Please enter your city or municipality.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="region" class="form-label">
                      Region<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select the region where you live (e.g., NCR - National Capital Region).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
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
                    <label for="zipCode" class="form-label">
                      Zip Code<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your 4-6 digit zip code (e.g., 1100 for Quezon City).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="zipCode" name="zipCode" pattern="^\d{4,6}$" required />
                    <div class="invalid-feedback">Please enter a valid zip code (4-6 digits).</div>
                  </div>
                  <div class="col-md-6">
                    <label for="province" class="form-label">
                      Province<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the province where you currently live (e.g., Metro Manila).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="province" name="province" required />
                    <div class="invalid-feedback">Please enter your province.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="religion" class="form-label">
                      Religion<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your religious affiliation (e.g., Roman Catholic, Islam, etc.).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="religion" name="religion" required />
                    <div class="invalid-feedback">Please enter your religion.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="email" class="form-label">
                      Email<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter a valid email address that you can access regularly (e.g., student@example.com).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="email" class="form-control" id="email" name="email" required />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="contactNumber" class="form-label">
                      Contact Number<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mobile number (e.g., +639123456789). We will use this to contact you.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="tel" class="form-control" id="contactNumber" name="contactNumber" pattern="^\+?\d{7,15}$" required />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="socialMedia" class="form-label">
                      Social Media Account / Facebook<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your Facebook username or profile link (e.g., facebook.com/juan.santos).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
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
                    <label for="motherFirstName" class="form-label">
                      First Name<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's first name (e.g., Maria).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="motherFirstName" name="motherFirstName" required />
                    <div class="invalid-feedback">Please enter mother's first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherMiddleName" class="form-label">
                      Middle Name<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's middle name (e.g., Dela Cruz).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="motherMiddleName" name="motherMiddleName" required />
                    <div class="invalid-feedback">Please enter mother's middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherLastName" class="form-label">
                      Last Name<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's last name (e.g., Santos).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="motherLastName" name="motherLastName" required />
                    <div class="invalid-feedback">Please enter mother's last name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherOccupation" class="form-label">
                      Occupation<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's current job (e.g., Teacher, Nurse, Housewife).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="motherOccupation" name="motherOccupation" required />
                    <div class="invalid-feedback">Please enter mother's occupation.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherContact" class="form-label">
                      Contact Number<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's phone number (e.g., +639123456789).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="tel" class="form-control" id="motherContact" name="motherContact" pattern="^\+?\d{7,15}$" required />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="motherEmail" class="form-label">
                      Email<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your mother's email address (e.g., mom@example.com).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="email" class="form-control" id="motherEmail" name="motherEmail" required />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                  <h5 class="mb-3 mt-4" style="color: var(--primary-dark); font-weight: 700;">Father's Information</h5>
                  <div class="col-md-4">
                    <label for="fatherFirstName" class="form-label">
                      First Name<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's first name (e.g., Juan).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="fatherFirstName" name="fatherFirstName" required />
                    <div class="invalid-feedback">Please enter father's first name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherMiddleName" class="form-label">
                      Middle Name<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's middle name (e.g., Dela Cruz).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="fatherMiddleName" name="fatherMiddleName" required />
                    <div class="invalid-feedback">Please enter father's middle name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherLastName" class="form-label">
                      Last Name<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's last name (e.g., Santos).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="fatherLastName" name="fatherLastName" required />
                    <div class="invalid-feedback">Please enter father's last name.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherOccupation" class="form-label">
                      Occupation<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's current job (e.g., Engineer, Driver, Retired).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="fatherOccupation" name="fatherOccupation" required />
                    <div class="invalid-feedback">Please enter father's occupation.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherContact" class="form-label">
                      Contact Number<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's phone number (e.g., +639123456789).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="tel" class="form-control" id="fatherContact" name="fatherContact" pattern="^\+?\d{7,15}$" required />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-4">
                    <label for="fatherEmail" class="form-label">
                      Email<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your father's email address (e.g., dad@example.com).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="email" class="form-control" id="fatherEmail" name="fatherEmail" required />
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                  </div>
                 <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="notLivingWithParents" name="notLivingWithParents" value="1">
                      <label class="form-check-label" for="notLivingWithParents">
                        Not living with parents
                      </label>
                    </div>
                  <h5 class="mb-3 mt-4" style="color: var(--primary-dark); font-weight: 700;">Guardian's Information (If not living with parents)</h5>
                  <div class="col-12 mt-3">
                  </div>
                  <div class="col-md-4 d-none" id="guardianFirstNameContainer">
                    <label for="guardianFirstName" class="form-label">
                      First Name
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your guardian's first name if applicable (e.g., Auntie Rosa).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="guardianFirstName" name="guardianFirstName" disabled />
                  </div>
                  <div class="col-md-4 d-none" id="guardianMiddleNameContainer">
                    <label for="guardianMiddleName" class="form-label">
                      Middle Name
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your guardian's middle name if applicable.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="guardianMiddleName" name="guardianMiddleName" disabled />
                  </div>
                  <div class="col-md-4 d-none" id="guardianLastNameContainer">
                    <label for="guardianLastName" class="form-label">
                      Last Name
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your guardian's last name if applicable.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="guardianLastName" name="guardianLastName" disabled />
                  </div>
                  <div class="col-md-3 d-none" id="guardianDobContainer">
                    <label for="guardianDob" class="form-label">
                      Date of Birth
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your guardian's date of birth if applicable.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="date" class="form-control" id="guardianDob" name="guardianDob" max="" disabled />
                  </div>
                  <div class="col-md-6 d-none" id="guardianContactContainer">
                    <label for="guardianContact" class="form-label">
                      Contact Number
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your guardian's phone number if applicable.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="tel" class="form-control" id="guardianContact" name="guardianContact" pattern="^\+?\d{7,15}$" disabled />
                    <div class="invalid-feedback">Please enter a valid contact number.</div>
                  </div>
                  <div class="col-md-3 d-none" id="guardianEmailContainer">
                    <label for="guardianEmail" class="form-label">
                      Email
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter your guardian's email address if applicable.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="email" class="form-control" id="guardianEmail" name="guardianEmail" disabled />
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
              <!-- STEP 5 -->
              <section class="form-section" data-step="5">
                <h3 class="stepper-header mb-4">Step 5: Preferences</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="preferredBranch" class="form-label">
                      Preferred Branch<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Choose your preferred campus location (Main Branch or Bulacan Branch).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <select class="form-select" id="preferredBranch" name="preferredBranch" required>
                      <option value="" selected disabled>Choose preferred branch</option>
                      <option value="1">Main Branch (#1071 Brgy. Kaligayahan, Quirino Highway Novaliches Quezon City)</option>
                      <option value="2">Bulacan Branch (Lot 1 Ipo Road, Barangay Minuyan Proper, City of San Jose Del Monte, Bulacan)</option>
                    </select>
                    <div class="invalid-feedback">Please select a preferred branch.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="preferredCourse" class="form-label">
                      Preferred Course<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select your desired course of study (e.g., ABM, STEM, HUMSS).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <select class="form-select" id="preferredCourse" name="preferredCourse" required>
                      <option value="" selected disabled>Choose preferred course</option>
                    </select>
                    <div class="invalid-feedback">Please select a preferred course.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="yearLevelStep4" class="form-label">
                      Year Level<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Select Grade 11 or Grade 12 depending on your level.">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <select class="form-select" id="yearLevelStep4" name="yearLevelStep4" required>
                      <option value="" selected disabled>Choose year level</option>
                    </select>
                    <div class="invalid-feedback">Please select your year level.</div>
                  </div>
                </div>
              </section>
              <!-- STEP 6 -->
              <section class="form-section" data-step="6">
                <h3 class="stepper-header mb-4">Step 6: Educational Background</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="primarySchool" class="form-label">
                      Primary School<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the name of your elementary school (e.g., Maligaya Elementary School).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="primarySchool" name="primarySchool" required />
                    <div class="invalid-feedback">Please enter your primary school.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="primaryYearGraduated" class="form-label">
                      Year Graduated (Primary)<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the year you graduated from elementary (e.g., 2020).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="number" class="form-control" id="primaryYearGraduated" name="primaryYearGraduated" min="1900" max="2099" step="1" required />
                    <div class="invalid-feedback">Please enter a valid year graduated (1900-2099).</div>
                  </div>
                  <div class="col-md-6">
                    <label for="secondarySchool" class="form-label">
                      Secondary School<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the name of your junior high school (e.g., Maligaya Junior High School).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="secondarySchool" name="secondarySchool" required />
                    <div class="invalid-feedback">Please enter your secondary school.</div>
                  </div>
                  <div class="col-md-6">
                    <label for="secondaryYearGraduated" class="form-label">
                      Year Graduated (Secondary)<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the year you graduated from junior high (e.g., 2023).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="number" class="form-control" id="secondaryYearGraduated" name="secondaryYearGraduated" min="1900" max="2099" step="1" required />
                    <div class="invalid-feedback">Please enter a valid year graduated (1900-2099).</div>
                  </div>
                  <div class="col-md-10">
                    <label for="lastSchoolAttended" class="form-label">
                      Last School Attended<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the name of the school you last attended (e.g., ABC High School).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="text" class="form-control" id="lastSchoolAttended" name="lastSchoolAttended" required />
                    <div class="invalid-feedback">Please enter your last school attended.</div>
                  </div>
                  <div class="col-md-2">
                    <label for="lastSchoolYearGraduated" class="form-label">
                      Year Graduated<span class="required-star">*</span>
                      <span class="ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Enter the year you last graduated or are currently attending (e.g., 2024).">
                        <i class="fas fa-info-circle text-primary"></i>
                      </span>
                    </label>
                    <input type="number" class="form-control" id="lastSchoolYearGraduated" name="lastSchoolYearGraduated" min="1900" max="2099" step="1" required />
                    <div class="invalid-feedback">Please enter a valid year graduated (1900-2099).</div>
                  </div>
                </div>
              </section>
              <!-- STEP 6 -->
              <section class="form-section" data-step="7">
                <h3 class="stepper-header mb-4">Step 6: Softcopy of Document Submission</h3>
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
  <div class="alert alert-info mb-4">
    <strong><i class="fas fa-info-circle me-2"></i>Please review your information carefully before submitting.</strong>
  </div>
  <div id="summaryContent" class="mb-4">
    <!-- Populated by JS -->
  </div>
  <div class="form-check mb-4">
    <input class="form-check-input" type="checkbox" id="agreement" required>
    <label class="form-check-label" for="agreement">
      I certify that the information provided is true and correct to the best of my knowledge.
    </label>
  </div>
  <p class="text-muted small">
    By submitting this form, you agree to our terms and conditions.
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
    const SUBMIT_ENROLLMENT_URL = "{{ route('shs.enrollment.submit') }}";
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  (() => {
    const form = document.getElementById('registrationForm');
    const steps = Array.from(form.querySelectorAll('section.form-section'));
    const stepperSteps = Array.from(document.querySelectorAll('#stepper .step'));
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    let currentStep = 0;
    const today = new Date().toISOString().split('T')[0];
    // Set max date to today
    form.querySelectorAll('input[type="date"]').forEach(input => input.setAttribute('max', today));
    const studentTypeSelect = document.getElementById('studentType');
    const previousIdContainer = document.getElementById('previousIdContainer');
    const yearLevelStep4 = document.getElementById('yearLevelStep4');
    const preferredBranchSelect = document.getElementById('preferredBranch');
    const preferredCourseSelect = document.getElementById('preferredCourse');
    const documentUploadList = document.getElementById('documentUploadList');
    // SHS COURSES
    const courseOptions = {
      "1": [
        { course_id: 1, name: "ABM - Accountancy, Business and Management" },
        { course_id: 2, name: "GAS - General Academic Strand" },
        { course_id: 3, name: "HECT - Home Economics - Culinary Arts and Food Services" },
        { course_id: 4, name: "HEHRS - Home Economics Hotel and Restaurant Services" },
        { course_id: 5, name: "HEHO - Home Economics Hotel Operation" },
        { course_id: 6, name: "HETEM - Home Economics Tourism and Event Management" },
        { course_id: 7, name: "HUMSS - Humanities and Social Sciences" },
        { course_id: 8, name: "ICT-HW - ICT Hardware" },
        { course_id: 9, name: "JCT-CP - ICT-Programming" },
        { course_id: 10, name: "ICT Animation - ICT Animation" },
        { course_id: 11, name: "ICT CCS - ICT-Contact Center Services" },
        { course_id: 12, name: "ICT Visual Graphics - ICT Visual Graphics" },
        { course_id: 13, name: "STEM - Science, Technology, Engineering and Mathematics" },
        { course_id: 14, name: "STEM PBM - STEM-Pre-Baccalaureate Maritime" }
      ],
      "2": [
        { course_id: 15, name: "Bulacan ARM - Accountancy, Business and Management" },
        { course_id: 16, name: "Bulacan HUMSS - Humanities and Social Sciences" },
        { course_id: 17, name: "Bulacan GAS - General Academic Strand" },
        { course_id: 18, name: "Bulacan SMAW - Shielded Metal Arc Welding" },
        { course_id: 19, name: "Bulacan SPORTS - Sport Track" },
        { course_id: 20, name: "Bulacan AUTO - Automotive" },
        { course_id: 21, name: "Bulacan ICT - Information and Communications Technology" },
        { course_id: 22, name: "Bulacan HE - Home Economics" },
        { course_id: 23, name: "Bulacan STEM - Science, Technology, Engineering and Mathematics" }
      ]
    };
    // SHS REQUIRED DOCUMENTS
    const requiredDocuments = {
      'New Regular': [
        { doc_id: 1, name: 'Form 138 (Report Card)' },
        { doc_id: 2, name: 'Form 137' },
        { doc_id: 3, name: 'Certificate of Good Moral' },
        { doc_id: 4, name: '2"x2" ID Picture (White Background) - 2 pcs' },
        { doc_id: 5, name: 'Photocopy of NCAE Result' },
        { doc_id: 6, name: 'ESC Certificate, if a graduate of a private Junior High School' },
        { doc_id: 7, name: 'PSA Authenticated Birth Certificate' },
        { doc_id: 8, name: 'Barangay Clearance' },
        { doc_id: 9, name: 'Photocopy of Diploma' }
      ],
      'Returnee': [
        { doc_id: 1, name: 'Form 138 (Report Card)' },
        { doc_id: 2, name: 'Form 137' },
        { doc_id: 3, name: 'Certificate of Good Moral' },
        { doc_id: 4, name: '2"x2" ID Picture (White Background) - 2 pcs' },
        { doc_id: 5, name: 'Photocopy of NCAE Result' },
        { doc_id: 6, name: 'ESC Certificate, if a graduate of a private Junior High School' },
        { doc_id: 7, name: 'PSA Authenticated Birth Certificate' },
        { doc_id: 8, name: 'Barangay Clearance' },
        { doc_id: 9, name: 'Photocopy of Diploma' }
      ],
      'Transferee': [
        { doc_id: 1, name: 'Form 138 (Report Card)' },
        { doc_id: 2, name: 'Form 137' },
        { doc_id: 3, name: 'Certificate of Good Moral' },
        { doc_id: 4, name: '2"x2" ID Picture (White Background) - 2 pcs' },
        { doc_id: 5, name: 'Photocopy of NCAE Result' },
        { doc_id: 6, name: 'ESC Certificate, if a graduate of a private Junior High School' },
        { doc_id: 7, name: 'PSA Authenticated Birth Certificate' },
        { doc_id: 8, name: 'Barangay Clearance' },
        { doc_id: 9, name: 'Photocopy of Diploma' }
      ]
    };
    function updateYearLevelOptions() {
      const studentType = studentTypeSelect.value;
      yearLevelStep4.innerHTML = '<option value="" selected disabled>Choose year level</option>';
      if (studentType === 'New Regular') {
        yearLevelStep4.innerHTML += '<option value="11">Grade 11</option>';
      } else if (['Transferee', 'Returnee'].includes(studentType)) {
        yearLevelStep4.innerHTML += '<option value="11">Grade 11</option>';
        yearLevelStep4.innerHTML += '<option value="12">Grade 12</option>';
      }
    }
    studentTypeSelect.addEventListener('change', function () {
      if (studentTypeSelect.value === 'Returnee') {
        previousIdContainer.classList.remove('d-none');
        document.getElementById('previousStudentId').setAttribute('required', 'required');
      } else {
        previousIdContainer.classList.add('d-none');
        const prevInput = document.getElementById('previousStudentId');
        prevInput.removeAttribute('required');
        prevInput.value = '';
      }
      updateYearLevelOptions();
      updateDocumentUploadList();
    });
    preferredBranchSelect.addEventListener('change', function () {
      const branch = preferredBranchSelect.value;
      const courses = courseOptions[branch] || [];
      preferredCourseSelect.innerHTML = '<option value="" selected disabled>Choose preferred course</option>';
      courses.forEach(function (course) {
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

  // Define which doc_ids are eligible for "To follow"
  // Based on your list: doc_id 1 = Form 138 (required), doc_id 4 = ID Pic (required)
  // Others (2,3,5,6,7,8,9) are eligible
  const toFollowEligibleDocIds = [2, 3, 5, 6, 7, 8, 9]; // Form 137, Good Moral, NCAE, ESC, PSA, Barangay, Diploma

  docs.forEach(function (doc) {
    const isEligible = toFollowEligibleDocIds.includes(doc.doc_id);
    const docGroup = document.createElement('div');
    docGroup.className = 'mb-4 position-relative';

    const toFollowCheckboxHtml = isEligible
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
      ${toFollowCheckboxHtml}
    `;

    const hiddenDocId = document.createElement('input');
    hiddenDocId.type = 'hidden';
    hiddenDocId.name = 'document_doc_id[]';
    hiddenDocId.value = doc.doc_id;
    docGroup.appendChild(hiddenDocId);

    documentUploadList.appendChild(docGroup);

    // File preview
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
        alert('File too large: ' + file.name + '. Maximum is 5MB.');
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

    // "To follow" toggle logic
    if (isEligible) {
      const toFollowCheckbox = docGroup.querySelector('.to-follow-checkbox');
      toFollowCheckbox.addEventListener('change', function () {
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
      steps.forEach(s => s.classList.remove('active'));
      stepperSteps.forEach(s => s.classList.remove('active', 'completed'));
      steps[index].classList.add('active');
      stepperSteps[index].classList.add('active');
      for (let i = 0; i < index; i++) {
        stepperSteps[i].classList.add('completed');
      }
      prevBtn.disabled = index === 0;
      nextBtn.innerHTML = index === steps.length - 1 
        ? '<i class="fas fa-paper-plane me-2"></i>Submit' 
        : 'Next<i class="fas fa-arrow-right ms-2"></i>';
      currentStep = index;
      setTimeout(() => {
        document.querySelector('.card').scrollIntoView({ behavior: 'smooth' });
      }, 100);
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
      // Validate years and order
      if (index === 5) { // Step 6: Educational Background
        const primaryYear = parseInt(document.getElementById('primaryYearGraduated').value);
        const secondaryYear = parseInt(document.getElementById('secondaryYearGraduated').value);
        const lastSchoolYear = parseInt(document.getElementById('lastSchoolYearGraduated').value);
        const yearInputs = [primaryYear, secondaryYear, lastSchoolYear];
        const yearFields = ['primaryYearGraduated', 'secondaryYearGraduated', 'lastSchoolYearGraduated'];
        for (let i = 0; i < yearInputs.length; i++) {
          const val = yearInputs[i];
          if (isNaN(val) || val < 1900 || val > 2099) {
            const field = document.getElementById(yearFields[i]);
            field.classList.add('is-invalid');
            field.nextElementSibling.textContent = 'Invalid year. Must be between 1900 and 2099.';
            valid = false;
          }
        }
        if (valid && (primaryYear >= secondaryYear || secondaryYear >= lastSchoolYear)) {
          alert('Invalid year order. Years must be in chronological order: Primary < Secondary < Last School.');
          valid = false;
        }
      }
      // Validate documents
      // Validate documents (Step 7)
if (index === 6) {
  const fileInputs = document.querySelectorAll('#documentUploadList .document-file-input');
  fileInputs.forEach(input => {
    const docId = parseInt(input.dataset.docId);
    const docGroup = input.closest('.mb-4');
    const toFollowCheckbox = docGroup.querySelector('.to-follow-checkbox');
    const isToFollow = toFollowCheckbox && toFollowCheckbox.checked;

    input.classList.remove('is-invalid');

    if (!isToFollow) {
      if (!input.files || input.files.length === 0) {
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
      html += `<div class="col-md-6"><span class="summary-label">Extension Name:</span> ${data.get('extensionName') || 'None'}</div>`;
      html += `<div class="col-md-6"><span class="summary-label">Civil Status:</span> ${data.get('civilStatus') || ''}</div>`;
      html += `<div class="col-md-6"><span class="summary-label">Gender:</span> ${data.get('gender') || ''}</div>`;
      html += `<div class="col-md-6"><span class="summary-label">Date of Birth:</span> ${data.get('dob') || ''}</div>`;
      html += `<div class="col-md-6"><span class="summary-label">Place of Birth:</span> ${data.get('placeOfBirth') || ''}</div>`;
      html += `<div class="col-md-6"><span class="summary-label">Nationality:</span> ${data.get('nationality') || ''}</div>`;
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
      html += `<div class="col-md-12"><span class="summary-label">Last School Attended:</span> ${data.get('lastSchoolAttended') || ''}</div>`;
      html += `<div class="col-md-12"><span class="summary-label">Year Graduated (Last School):</span> ${data.get('lastSchoolYearGraduated') || ''}</div>`;
      html += '</div></div></div>';

      document.getElementById('summaryContent').innerHTML = html;
    }
    nextBtn.addEventListener('click', function () {
  if (validateStep(currentStep)) {
    if (currentStep === steps.length - 1) {
      const agreementChecked = document.getElementById('agreement').checked;
      if (!agreementChecked) {
        alert('Please agree to the certification and privacy terms to proceed.');
        return;
      }
    }

    if (currentStep < steps.length - 1) {
      if (currentStep + 1 === 8) {
        populateSummary();
      }
      showStep(currentStep + 1);
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
      .then(async response => {
        // ✅ Check if response is JSON
        const contentType = response.headers.get('content-type');
        let data;
        if (contentType && contentType.includes('application/json')) {
          data = await response.json();
        } else {
          // ❌ Not JSON → likely server error (500, syntax error, etc.)
          throw new Error('Server error: Invalid response format.');
        }

        if (!response.ok) {
          // ✅ Handle validation errors
          if (data.errors && Array.isArray(data.errors)) {
            let errorIndex = 0;
            const showError = () => {
              if (errorIndex < data.errors.length) {
                alert(data.errors[errorIndex]);
                errorIndex++;
                setTimeout(showError, 500);
              } else {
                nextBtn.disabled = false;
                nextBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit';
              }
            };
            showError();
            return;
          } else {
            // Generic backend error
            alert(data.message || 'Submission failed. Please try again.');
            nextBtn.disabled = false;
            nextBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit';
            return;
          }
        }

        // ✅ Success
        if (data.success) {
          window.location.href = data.redirect;
        } else {
          alert(data.message || 'Submission failed.');
          nextBtn.disabled = false;
          nextBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit';
        }
      })
      .catch(error => {
        // ❌ Only show network error if it's truly a network issue
        if (error.message && !error.message.includes('Invalid response format')) {
          alert('Network error: ' + error.message);
        } else {
          // Silent fail or log only (optional)
          console.error('Submission error:', error);
          alert('An unexpected error occurred. Please try again later.');
        }
        nextBtn.disabled = false;
        nextBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit';
      });
    }
  } else {
    alert('Please fill all required fields correctly.');
  }
});
    prevBtn.addEventListener('click', function () {
      if (currentStep > 0) {
        showStep(currentStep - 1);
      }
    });
    // Initialize
    updateYearLevelOptions();
    if (studentTypeSelect.value) {
      updateDocumentUploadList();
    }
    showStep(0);

    // Auto-update summary on form changes when on summary step
    const formElements = form.querySelectorAll('input, select, textarea');
    formElements.forEach(element => {
      element.addEventListener('change', () => {
        if (currentStep === 8) { // Step 9 (0-indexed)
          populateSummary();
        }
      });
      if (element.type === 'text' || element.type === 'email' || element.type === 'tel' || element.type === 'number' || element.tagName === 'TEXTAREA') {
        element.addEventListener('input', () => {
          if (currentStep === 8) {
            populateSummary();
          }
        });
      }
    });

    const hasExtensionNameCheckbox = document.getElementById('hasExtensionName');
    const extensionNameSelect = document.getElementById('extensionName');

    function toggleExtensionNameSelect() {
      if (hasExtensionNameCheckbox.checked) {
        extensionNameSelect.disabled = false;
      } else {
        extensionNameSelect.disabled = true;
        extensionNameSelect.value = '';
      }
    }

    // On page load, set select disabled/enabled based on checkbox
    toggleExtensionNameSelect();

    // Extension name toggle
    hasExtensionNameCheckbox.addEventListener('change', toggleExtensionNameSelect);

    // Guardian toggle
    function toggleGuardianFields() {
      const checkbox = document.getElementById('notLivingWithParents');
      const containers = document.querySelectorAll('#guardianFirstNameContainer, #guardianMiddleNameContainer, #guardianLastNameContainer, #guardianDobContainer, #guardianContactContainer, #guardianEmailContainer');
      const inputs = document.querySelectorAll('[id*="guardian"] input, [id*="guardian"] select');
      if (checkbox.checked) {
        containers.forEach(container => container.classList.remove('d-none'));
        inputs.forEach(input => input.disabled = false);
      } else {
        containers.forEach(container => container.classList.add('d-none'));
        inputs.forEach(input => {
          input.disabled = true;
          input.value = '';
        });
      }
    }

    // On page load, set initial state
    toggleGuardianFields();

    // Add event listener for checkbox change
    document.getElementById('notLivingWithParents').addEventListener('change', toggleGuardianFields);
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

// Referral source toggle
const referralSource = document.getElementById('referralSource');
if (referralSource) {
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
  });
}
// >>>>>>>>>> END OF NEW CODE <<<<<<<<<<
  // Make stepper steps clickable with updated logic
  stepperSteps.forEach((stepElem, index) => {
    stepElem.style.cursor = 'pointer';
    stepElem.addEventListener('click', () => {
      // Allow navigation if step is current or completed (not disabled)
      if (stepElem.classList.contains('active') || stepElem.classList.contains('completed')) {
        showStep(index);
      } else {
        // If clicking on a future step, check if current step is valid before allowing navigation
        if (index < currentStep) {
          // Allow going back to previous steps even if current step is invalid
          showStep(index);
        } else {
          if (validateStep(currentStep)) {
            showStep(index);
          } else {
            alert('Please fill all required fields correctly before proceeding.');
          }
        }
      }
    });
  });

  })();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(tooltipTriggerEl => {
      new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });
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