<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo300.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


    <style>
        body {
    background-color: #f4f7f6;
    overflow-x: hidden;
    font-family: 'Poppins', sans-serif;
    font-weight: 300;
}
h1, h2, h3, h4, h5, h6, .fw-bold {
    font-weight: 700 !important;
}
.mb-0 {
    font-size: 16px;
    margin-top: 15px;
}
.role {
    font-size: 15px;
    margin-top: 15px;

}

/* Sidebar */
.sidebar {
    width: 280px;
    min-height: 100vh;
    background-color: #1e3a8a;
    transition: margin-left 0.3s ease-in-out;
    position: fixed; /* Keep sidebar fixed */
    z-index: 1030;
    top: 0;
    left: 0;
}
.sidebar .user-profile {
    padding: 1.5rem 1rem;
    text-align: center;
    color: white;
}
.sidebar .user-profile .initials {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: #5044e4;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 auto 0.5rem;
}
.sidebar .nav-link {
    color: #cbd5e0;
    padding: 0.75rem 1.25rem;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    border-left: 3px solid transparent;
    transition: all 0.2s ease-in-out;
}
.sidebar .nav-link i {
    margin-right: 0.75rem;
    font-size: 1.1rem;
}
.sidebar .nav-link.active, 
.sidebar .nav-link:hover {
    color: #ffffff;
    background-color: #284b9a;
    border-left: 4px solid #3B71CA;
}

/* Main Content Wrapper */
.main-content-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin-left: 280px; /* Default margin for desktop */
    width: calc(100% - 280px);
    transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
}

/* Top Navbar */
.top-navbar {
    background-color: #ffffff !important;
    border-bottom: 1px solid #dee2e6;
    padding: 0.5rem 1.5rem;
    position: sticky;
    top: 0;
    z-index: 1025; /* para laging nasa ibabaw ng content */
}

/* Content Area */
.content-area {
    padding: 2rem;
    flex-grow: 1;
}

/* Footer */
.footer {
    padding: 1rem 2rem;
    background-color: #ffffff;
    border-top: 1px solid #dee2e6;
    font-size: 0.875rem;
    color: #6c757d;
}

/* Sidebar Overlay (pang-mobile) */
.sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5);
    z-index: 1029; /* Just below the sidebar's z-index */
}

/* Responsive Styles */
@media (max-width: 991.98px) {
    .sidebar {
        margin-left: -280px; /* Hide sidebar by default on smaller screens */
    }
    .main-content-wrapper {
        margin-left: 0;
        width: 100%;
    }
    body.sidebar-toggled .sidebar {
        margin-left: 0; /* Show sidebar when toggled */
    }
    body.sidebar-toggled .sidebar-overlay {
        display: block; /* Show overlay when sidebar is toggled on mobile */
    }
}

       /* === SIDEBAR: Enhanced Spacing & Style === */

/* Add space between main menu items */
.sidebar .nav-item {
    margin-bottom: 0.25rem; /* Gentle spacing */
}

/* Main dropdown toggle link */
.sidebar .sidebar-dropdown-toggle {
    color: #cbd5e0;
    padding: 0.8rem 1.25rem;
    border-radius: 6px;
    transition: all 0.3s ease, background-color 0.2s ease;
    position: relative;
    border-left: 3px solid transparent;
}

/* Hover state */
.sidebar .sidebar-dropdown-toggle:hover {
    color: #ffffff;
    background-color: #284b9a;
    border-left: 4px solid #3B71CA;
}

/* Active/Collapsed state (when open) */
.sidebar .sidebar-dropdown-toggle[aria-expanded="true"] {
    color: #ffffff;
    background-color: #284b9a;
    border-left: 4px solid #3B71CA;
}

/* Dropdown Chevron */
.sidebar .toggle-icon {
    font-size: 0.9rem;
    color: #94a3b8;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Rotate chevron when open */
.sidebar .sidebar-dropdown-toggle[aria-expanded="true"] .toggle-icon {
    transform: rotate(180deg);
    color: #ffffff;
}

/* Submenu Items */
.sidebar .nav-link.py-2 {
    font-size: 0.92rem;
    color: #e2e8f0;
    padding: 0.75rem 0.9rem;
    border-radius: 6px;
    transition: all 0.2s ease;
    margin-bottom: 0.25rem;
}

.sidebar .nav-link.py-2:hover,
.sidebar .nav-link.py-2.active {
    background-color: #2c52a0;
    color: #ffffff;
}

/* Submenu Icons */
.sidebar .nav-link.py-2 i {
    font-size: 1rem;
    opacity: 0.9;
}

/* Smooth collapse animation */
.sidebar .collapse {
    transition: all 0.3s ease-out;
}

.sidebar .collapse.show {
    margin-top: 0.3rem;
}

/* User Profile */
.sidebar .user-profile {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
<div id="sidebar" class="d-flex flex-column flex-shrink-0 sidebar">
    <div class="user-profile">
        <br>
    
        @if(Auth::check())
            @php
                $user = Auth::user();
                $initials = strtoupper(substr($user->name, 0, 1) . (str_contains($user->name, ' ') ? substr(strrchr($user->name, ' '), 1, 1) : ''));
            @endphp
            <div class="initials">{{ $initials }}</div>
            <h5 class="mb-0">{{ $user->name }}</h5>
            <small>{{ $user->email }}</small>
            <p class="role">{{ Auth::user()->role }}</p>

        @endif
    </div>
    

    <ul class="nav nav-pills flex-column mb-auto">

        <br>


        <!-- Modules Header -->
        <li class="nav-item px-3 mt-3 mb-2">
            <small class="text-white text-uppercase fw-bold">Modules</small>
        </li>

        <!-- Pending Admissions Dropdown -->
<li class="nav-item mb-2">
    

    <!-- Dashboard -->
        <li class="nav-item mb-2">
            <a href="{{ route('dashboard.staff') }}" class="nav-link {{ request()->routeIs('dashboard.staff') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Staff Dashboard
            </a>
        </li>

    <a class="nav-link d-flex align-items-center sidebar-dropdown-toggle" href="#pending-admissions-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false">
        <i class="bi bi-clock-history me-2"></i>
        <span class="flex-grow-1">Pending Admissions</span>
        <i class="bi bi-chevron-down toggle-icon fs-small"></i>
    </a>
    <ul class="nav collapse ms-3 flex-column" id="pending-admissions-submenu">
        <li class="mb-1">
            <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                <i class="bi bi-building me-2"></i> College
            </a>
        </li>
        <li class="mb-1">
            <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                <i class="bi bi-mortarboard me-2"></i> SHS
            </a>
        </li>
    </ul>
</li>

        <!-- Waiting List Dropdown -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center sidebar-dropdown-toggle" href="#waiting-list-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false">
                <i class="bi bi-hourglass me-2"></i>
                <span class="flex-grow-1">Waiting List</span>
                <i class="bi bi-chevron-down toggle-icon fs-small"></i>
            </a>
            <ul class="nav collapse ms-3 flex-column" id="waiting-list-submenu">
                <li class="mb-1">
                    <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                        <i class="bi bi-building me-2"></i> College
                    </a>
                </li>
                <li class="mb-1">
                    <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                        <i class="bi bi-mortarboard me-2"></i> SHS
                    </a>
                </li>
            </ul>
        </li>

        <!-- Student Records Dropdown -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center sidebar-dropdown-toggle" href="#student-records-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false">
                <i class="bi bi-journal-text me-2"></i>
                <span class="flex-grow-1">Student Records</span>
                <i class="bi bi-chevron-down toggle-icon fs-small"></i>
            </a>
            <ul class="nav collapse ms-3 flex-column" id="student-records-submenu">
                <li class="mb-1">
                    <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                        <i class="bi bi-building me-2"></i> College
                    </a>
                </li>
                <li class="mb-1">
                    <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                        <i class="bi bi-mortarboard me-2"></i> SHS
                    </a>
                </li>
            </ul>
        </li>

        <!-- Uploaded Documents Dropdown -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center sidebar-dropdown-toggle" href="#uploaded-docs-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false">
                <i class="bi bi-file-earmark-arrow-up me-2"></i>
                <span class="flex-grow-1">Uploaded Documents</span>
                <i class="bi bi-chevron-down toggle-icon fs-small"></i>
            </a>
            <ul class="nav collapse ms-3 flex-column" id="uploaded-docs-submenu">
                <li class="mb-1">
                    <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                        <i class="bi bi-building me-2"></i> College
                    </a>
                </li>
                <li class="mb-1">
                    <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                        <i class="bi bi-mortarboard me-2"></i> SHS
                    </a>
                </li>
            </ul>
        </li>

        <!-- Parents Notification Dropdown -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center sidebar-dropdown-toggle" href="#parents-notification-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false">
                <i class="bi bi-envelope-paper me-2"></i>
                <span class="flex-grow-1">Parents Notification</span>
                <i class="bi bi-chevron-down toggle-icon fs-small"></i>
            </a>
            <ul class="nav collapse ms-3 flex-column" id="parents-notification-submenu">
                <li class="mb-1">
                    <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                        <i class="bi bi-building me-2"></i> College
                    </a>
                </li>
                <li class="mb-1">
                    <a href="#" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                        <i class="bi bi-mortarboard me-2"></i> SHS
                    </a>
                </li>
            </ul>
        </li>

    </ul>

    <div class="p-3">
        <!-- Placeholder -->
    </div>
</div>

        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
            <!-- Top Navbar -->
            <!-- Top Navbar -->
<nav class="top-navbar d-flex justify-content-between align-items-center sticky-top">
    <div>
        <button id="sidebar-toggle" class="btn btn-light d-lg-none"><i class="bi bi-list"></i></button>
    </div>
    <div class="d-flex align-items-center">
        <span id="current-time" class="me-3 d-none d-sm-inline"></span>
        <a href="#" class="text-dark me-3"><i class="bi bi-bell fs-5"></i></a>
        <a href="#" class="text-dark me-3"><i class="bi bi-search fs-5"></i></a>
        
        <!-- User Dropdown -->
        <div class="dropdown">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-4"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><h6 class="dropdown-header">{{ Auth::user()->name }}</h6></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


           <!-- Content Area -->
               <main class="content-area">
                 <div id="page-content">
                    @yield('content')
                 </div>
               </main>

            <!-- Footer -->
            <footer class="footer">
                Enrollment Management System &copy; {{ date('Y') }}
            </footer>
        </div>
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>

        <!-- Session Invalid Modal -->
        <div id="sessionInvalidModal" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <div class="text-center mb-6">
                    <i class="bi bi-exclamation-triangle text-warning" style="font-size: 30px;"></i>
                    <h5 class="modal-title d-flex align-items-center justify-content-center">
                        Session Invalidated
                    </h5>
                    <div class="modal-underline"></div>
                </div>
                <div class="modal-body text-center">
                    <p>Your session has been invalidated because you logged in from another device or browser.</p>
                    <p>Please log in again to continue.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="logoutBtn" class="btn-custom-primary">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

     <script>
// Prevent full page reload and load content via AJAX
document.addEventListener('DOMContentLoaded', function () {
    const contentArea = document.getElementById('page-content');

    // Listen to all links with [data-load]
    document.querySelectorAll('a[data-load]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Huwag mag-refresh

            const url = this.getAttribute('href');

            // Add loading state
            contentArea.innerHTML = `
                <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3">Loading content...</p>
                    </div>
                </div>
            `;

            // Fetch the page content
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Laravel detects AJAX
                },
            })
            .then(response => response.text())
            .then(html => {
                // Extract the body content (remove <html>, <head>, etc.)
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // Kunin lang ang #page-content mula sa response
                const newContent = doc.querySelector('#page-content')?.innerHTML;

                if (newContent) {
                    contentArea.innerHTML = newContent;
                } else {
                    contentArea.innerHTML = '<p>Error loading content.</p>';
                }

                // Update URL sa browser (para back button gumana)
                window.history.pushState({}, '', url);
            })
            .catch(err => {
                console.error('Fetch error:', err);
                contentArea.innerHTML = `
                    <div class="alert alert-danger">Failed to load content. Please try again.</div>
                `;
            });
        });
    });

    // Clock Functionality (nandito na)
    function updateTime() {
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            const now = new Date();
            timeElement.textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
        }
    }
    setInterval(updateTime, 1000);
    updateTime();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoutBtn = document.getElementById('logoutBtn');
    const sessionInvalidModal = document.getElementById('sessionInvalidModal');

    // Polling function to check if session is still valid
    async function checkSession() {
        try {
            const response = await fetch('/check-session', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();
            if (!data.authenticated) {
                // Show modal if session invalidated
                if (sessionInvalidModal) {
                    sessionInvalidModal.style.display = 'flex';
                    document.body.classList.add('modal-open');
                }
            }
        } catch (error) {
            console.error('Error checking session:', error);
        }
    }

    // Check session every 10 seconds
    setInterval(checkSession, 10000);

    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            // Redirect to logout route to clear session and redirect to login
            window.location.href = "{{ route('logout') }}";
        });
    }
});
</script>

</body>
</html>
