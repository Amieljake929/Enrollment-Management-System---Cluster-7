<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UI Template - Accreditation Management System</title>
    <link rel="icon" href="https://placehold.co/32x32/1e3a8a/ffffff?text=BCP">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            color: #212529;
        }
        .fw-bold {
            font-weight: 700 !important;
        }
        .component-section {
            padding: 2rem;
            margin-bottom: 2rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
        }
        .color-swatch {
            width: 100px;
            height: 100px;
            border-radius: 0.5rem;
            display: inline-block;
            margin-right: 1rem;
            border: 1px solid #dee2e6;
        }
        /* Custom Button Styles */
        .btn-custom-primary {
            background-color: #5044e4;
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            transition: background-color 0.3s;
            font-weight: 700;
        }
        .btn-custom-primary:hover {
            background-color: #3f38b7;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">System UI Template & Style Guide</h1>
            <p class="text-muted">SCHOOL MANAGEMENT SYSTEM III</p>
        </div>

        <!-- ========== Colors ========== -->
        <div class="component-section">
            <h2 class="fw-bold border-bottom pb-2 mb-3">Colors</h2>
            <div>
                <div class="d-inline-block text-center me-4">
                    <div class="color-swatch" style="background-color: #1e3a8a;"></div>
                    <p class="mt-2">Sidebar Blue<br><code>#1e3a8a</code></p>
                </div>
                <div class="d-inline-block text-center me-4">
                    <div class="color-swatch" style="background-color: #5044e4;"></div>
                    <p class="mt-2">Primary Purple<br><code>#5044e4</code></p>
                </div>
                 <div class="d-inline-block text-center me-4">
                    <div class="color-swatch" style="background-color: #3B71CA;"></div>
                    <p class="mt-2">Accent Blue<br><code>#3B71CA</code></p>
                </div>
                <div class="d-inline-block text-center me-4">
                    <div class="color-swatch" style="background-color: #f4f7f6;"></div>
                    <p class="mt-2">Background<br><code>#f4f7f6</code></p>
                </div>
                <div class="d-inline-block text-center me-4">
                    <div class="color-swatch" style="background-color: #ffffff;"></div>
                    <p class="mt-2">Card/White<br><code>#ffffff</code></p>
                </div>
            </div>
        </div>

        <!-- ========== Typography ========== -->
        <div class="component-section">
            <h2 class="fw-bold border-bottom pb-2 mb-3">Typography</h2>
            <p><strong>Font Family:</strong> Poppins</p>
            <h1 class="fw-bold">Heading 1</h1>
            <h2 class="fw-bold">Heading 2</h2>
            <h3>Heading 3</h3>
            <h4>Heading 4</h4>
            <p>This is a standard paragraph of text, using the light (300) weight of the Poppins font. It's used for most of the body copy throughout the application.</p>
            <a href="#">This is a standard link.</a>
        </div>

        <!-- ========== Buttons ========== -->
        <div class="component-section">
            <h2 class="fw-bold border-bottom pb-2 mb-3">Buttons</h2>
            <div class="mb-3">
                <button class="btn btn-custom-primary me-2">Primary Button</button>
                <button class="btn btn-secondary me-2">Secondary Button</button>
                <button class="btn btn-success me-2">Success Button</button>
                <button class="btn btn-danger me-2">Danger Button</button>
            </div>
        </div>

        <!-- ========== Forms ========== -->
        <div class="component-section">
            <h2 class="fw-bold border-bottom pb-2 mb-3">Form Elements</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="textInput" class="form-label">Text Input</label>
                        <input type="text" class="form-control" id="textInput" placeholder="Enter text...">
                    </div>
                    <div class="mb-3">
                        <label for="emailInputInvalid" class="form-label">Invalid Input <span class="text-danger">*</span></label>
                        <input type="email" class="form-control is-invalid" id="emailInputInvalid" required>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>
                     <div class="mb-3">
                        <label for="passwordInput" class="form-label">Password with Toggle</label>
                        <div class="input-group">
                             <input type="password" class="form-control" id="passwordInput" placeholder="Enter password...">
                             <span class="input-group-text"><i class="bi bi-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="mb-3">
                        <label for="selectMenu" class="form-label">Select Menu</label>
                        <select class="form-select" id="selectMenu">
                            <option selected>Choose...</option>
                            <option value="1">Option one</option>
                            <option value="2">Option two</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Checkboxes</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== Cards ========== -->
        <div class="component-section">
            <h2 class="fw-bold border-bottom pb-2 mb-3">Cards</h2>
             <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Card Title</h5>
                    <p class="card-text">This is the standard card component. It uses a light box-shadow and contains the main content sections of a page.</p>
                    <a href="#" class="btn btn-custom-primary">Go somewhere</a>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
