<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo300.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
            margin-top: 6px;
        }
        .role {
            font-size: 15px;
            margin-top: 15px;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, #1e3a8a 0%, #1a2c6b 100%);
            transition: margin-left 0.3s ease-in-out;
            position: fixed;
            z-index: 1030;
            top: 0;
            left: 0;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.15);
        }
        .sidebar .user-profile {
            padding: 1.5rem 1rem;
            text-align: center;
            color: white;
            background: rgba(0, 0, 0, 0.15);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar .user-profile .initials {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0 auto 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .sidebar .nav-link {
            color: #e2e8f0;
            padding: 0.85rem 1.5rem;
            font-size: 0.98rem;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
            transition: all 0.25s ease;
            border-radius: 0 8px 8px 0;
            margin: 0 8px;
            position: relative;
        }
        .sidebar .nav-link i {
            margin-right: 0.85rem;
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
        }
        .sidebar .nav-link.active, 
        .sidebar .nav-link:hover {
            color: #ffffff;
            background: rgba(59, 113, 202, 0.25);
            border-left: 4px solid #4f46e5;
            transform: translateX(3px);
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar .nav-link.active::after {
            content: '';
            position: absolute;
            right: -15px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 36px;
            background: linear-gradient(to left, rgba(30, 58, 138, 0) 0%, rgba(30, 58, 138, 0.8) 100%);
            border-radius: 0 8px 8px 0;
        }

        /* Main Content Wrapper */
        .main-content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-left: 280px;
            width: calc(100% - 280px);
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        /* Top Navbar */
        .top-navbar {
            background: linear-gradient(to right, #ffffff 0%, #f8fafc 100%);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 1.75rem;
            position: sticky;
            top: 0;
            z-index: 1025;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Content Area */
        .content-area {
            padding: 2rem;
            flex-grow: 1;
        }

        /* Footer */
        .footer {
            padding: 1.25rem 2rem;
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            font-size: 0.9rem;
            color: #4a5568;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.03);
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.45);
            z-index: 1029;
            backdrop-filter: blur(2px);
        }

        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -280px;
            }
            .main-content-wrapper {
                margin-left: 0;
                width: 100%;
            }
            body.sidebar-toggled .sidebar {
                margin-left: 0;
            }
            body.sidebar-toggled .sidebar-overlay {
                display: block;
            }
            .notification-bell {
                width: 36px;
                height: 36px;
            }
            .notification-badge {
                min-width: 18px;
                height: 18px;
                font-size: 0.65rem;
                top: -2px;
                right: -2px;
            }
            #userDropdown {
                width: 36px;
                height: 36px;
                font-size: 1.25rem;
            }
        }

        /* === SIDEBAR: Enhanced Spacing & Style === */
        .sidebar .nav-item {
            margin-bottom: 0.35rem;
        }

        .sidebar .sidebar-dropdown-toggle {
            color: #e2e8f0;
            padding: 0.9rem 1.5rem;
            border-radius: 0 8px 8px 0;
            transition: all 0.3s ease;
            position: relative;
            border-left: 3px solid transparent;
            margin: 0 8px;
        }

        .sidebar .sidebar-dropdown-toggle:hover {
            color: #ffffff;
            background: rgba(59, 113, 202, 0.25);
            border-left: 4px solid #4f46e5;
            transform: translateX(3px);
        }

        .sidebar .sidebar-dropdown-toggle[aria-expanded="true"] {
            color: #ffffff;
            background: rgba(59, 113, 202, 0.35);
            border-left: 4px solid #4f46e5;
            transform: translateX(3px);
        }

        .sidebar .toggle-icon {
            font-size: 0.95rem;
            color: #a0aec0;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar .sidebar-dropdown-toggle[aria-expanded="true"] .toggle-icon {
            transform: rotate(180deg);
            color: #ffffff;
        }

        .sidebar .nav-link.py-2 {
            font-size: 0.95rem;
            color: #cbd5e0;
            padding: 0.8rem 1.25rem;
            border-radius: 6px;
            transition: all 0.25s ease;
            margin: 0.25rem 0;
            margin-left: 15px !important;
        }

        .sidebar .nav-link.py-2:hover,
        .sidebar .nav-link.py-2.active {
            background-color: rgba(79, 70, 229, 0.15);
            color: #ffffff;
            transform: translateX(2px);
        }

        .sidebar .nav-link.py-2 i {
            font-size: 1.05rem;
            opacity: 0.95;
            width: 22px;
            text-align: center;
        }

        .sidebar .collapse {
            transition: all 0.35s ease;
        }

        .sidebar .collapse.show {
            margin-top: 0.4rem;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .sidebar .user-profile {
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .sidebar .nav-container {
            flex-grow: 1;
            overflow-y: auto;
            padding-bottom: 20px;
        }

        /* === MODERN NOTIFICATION BELL === */
        .notification-bell {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: #f8fafc;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            margin-right: 1.25rem;
        }

        .notification-bell:hover,
        .notification-bell:focus,
        .notification-bell.show {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transform: scale(1.07) rotate(2deg);
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.35);
            color: white !important;
        }

        .notification-bell:hover i,
        .notification-bell:focus i,
        .notification-bell.show i {
            color: white !important;
        }

        .notification-bell i {
            font-size: 1.5rem;
            transition: all 0.3s ease;
            color: #4a5568;
        }

        .notification-bell:hover i,
        .notification-bell:focus i,
        .notification-bell.show i {
            animation: ring 0.6s ease-in-out;
        }

        @keyframes ring {
            0% { transform: rotate(0deg); }
            15% { transform: rotate(15deg); }
            30% { transform: rotate(-10deg); }
            45% { transform: rotate(5deg); }
            60% { transform: rotate(-5deg); }
            75% { transform: rotate(2deg); }
            100% { transform: rotate(0deg); }
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            color: white;
            font-size: 0.85rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 2px #ffffff, 0 2px 6px rgba(239, 68, 68, 0.45);
            padding: 0 5px;
            animation: pulse 2s infinite;
            z-index: 10;
            border: 1.5px solid white;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7), 0 0 0 2px white; }
            70% { box-shadow: 0 0 0 8px rgba(239, 68, 68, 0), 0 0 0 2px white; }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0), 0 0 0 2px white; }
        }

        .notification-badge:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: inherit;
            z-index: -1;
            animation: ripple 2s infinite;
            opacity: 0.6;
        }

        @keyframes ripple {
            0% { transform: scale(0.8); opacity: 0.8; }
            100% { transform: scale(2.2); opacity: 0; }
        }

        /* User Dropdown Enhancement */
        #userDropdown {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            transition: all 0.3s ease;
            color: #4f46e5;
            font-size: 1.5rem;
            margin-left: 0.75rem;
        }

        #userDropdown:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        /* Search Icon Enhancement */
        .search-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #4a5568;
            background: #f8fafc;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            margin-right: 1.25rem;
            text-decoration: none;
        }

        .search-icon:hover {
            background: #e2e8f0;
            color: #4f46e5;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .search-icon i {
            font-size: 1.3rem;
        }

        /* Time Display Enhancement */
        #current-time {
            font-weight: 500;
            color: #334155;
            font-size: 1.05rem;
            background: #f8fafc;
            padding: 0.35rem 1rem;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        /* Smooth scrolling for sidebar content */
        .nav-container {
            scrollbar-width: thin;
            scrollbar-color: #4f46e5 #2d3748;
        }
        .nav-container::-webkit-scrollbar {
            width: 6px;
        }
        .nav-container::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        .nav-container::-webkit-scrollbar-thumb {
            background-color: #4f46e5;
            border-radius: 10px;
            border: 2px solid #2d3748;
        }
        
        /* Fixed User Dropdown Text Color */
        .dropdown-menu.dropdown-menu-end {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .dropdown-menu .dropdown-item {
            color: #2d3748 !important;
            padding: 0.75rem 1.25rem;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }
        .dropdown-menu .dropdown-item:hover {
            background-color: #f8fafc !important;
            color: #4a5568 !important;
        }
        .dropdown-menu .dropdown-item i {
            width: 20px;
            margin-right: 8px;
        }
        .dropdown-menu .dropdown-header {
            background: #f8fafc;
            padding: 0.75rem 1.25rem;
            color: #4a5568;
            font-weight: 600;
            border-bottom: 1px solid #e2e8f0;
        }

         /* === NOTIFICATION DROPDOWN === */
        .notification-dropdown-menu {
            min-width: 380px;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.15), 0 10px 20px -5px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            padding: 0;
            margin-top: 8px;
            max-height: 450px; /* Adjusted for better scrolling */
            overflow: hidden; /* Changed to hidden for better control */
        }

        .notification-dropdown-body {
            max-height: 350px; /* Body height for scrolling */
            overflow-y: auto;
            overflow-x: hidden;
        }

        .notification-dropdown-body::-webkit-scrollbar {
            width: 6px;
        }
        .notification-dropdown-body::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .notification-dropdown-body::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
        .notification-dropdown-body::-webkit-scrollbar-thumb:hover {
            background-color: #a0aec0;
        }

        .notification-dropdown-menu::-webkit-scrollbar {
            width: 6px;
        }
        .notification-dropdown-menu::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .notification-dropdown-menu::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
        .notification-dropdown-menu::-webkit-scrollbar-thumb:hover {
            background-color: #a0aec0;
        }

        .notification-dropdown-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 1rem 1.25rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-dropdown-header h6 {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }

        .notification-dropdown-header .mark-all-read {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .notification-dropdown-header .mark-all-read:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .notification-dropdown-empty {
            padding: 2rem;
            text-align: center;
            color: #64748b;
        }

        .notification-dropdown-empty i {
            font-size: 3rem;
            opacity: 0.3;
            margin-bottom: 1rem;
        }

        .notification-item {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.25s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .notification-item:hover {
            background-color: #f8fafc;
            transform: translateX(4px);
            box-shadow: inset 4px 0 0 #4f46e5;
        }

        .notification-item.unread {
            background-color: #f0f4ff;
            border-left: 4px solid #4f46e5;
        }

        .notification-item.unread:hover {
            background-color: #e0e7ff;
        }

        .notification-item .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            margin-right: 12px;
        }

        .notification-item .notification-content {
            flex: 1;
        }

        .notification-item .notification-title {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }

        .notification-item .notification-message {
            color: #475569;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .notification-item .notification-time {
            color: #64748b;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .notification-item .notification-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.5rem;
            font-size: 0.8rem;
        }

        .notification-item .badge {
            font-size: 0.7rem;
            padding: 0.35rem 0.6rem;
        }

        .notification-item-footer {
            padding: 0.75rem 1.25rem;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .notification-item-footer a {
            color: #4f46e5;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .notification-item-footer a:hover {
            color: #7c3aed;
            text-decoration: underline;
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
                    <br>
                    <div class="initials">{{ $initials }}</div>
                    <small>{{ $user->email }}</small>
                    <h5 class="mb-0">{{ $user->name }}</h5><br>
                    
                @endif
            </div>
            
            <div class="nav-container">
                <ul class="nav nav-pills flex-column">
                    <!-- Modules Header -->
                    <li class="nav-item px-3 mt-3 mb-2">
                        <small class="text-white text-uppercase fw-bold opacity-75">Main Modules</small>
                    </li>

                    <!-- Dashboard -->
                    <li class="nav-item mb-1">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('accreditation.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i> Enrollment Dashboard
                        </a>
                    </li>

                    <!-- Pending Admissions Dropdown -->
                    <li class="nav-item mb-1">
                        <a class="nav-link d-flex align-items-center sidebar-dropdown-toggle" href="#pending-admissions-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false">
                            <i class="bi bi-clock-history me-2"></i>
                            <span class="flex-grow-1">Pending Admissions</span>
                            <i class="bi bi-chevron-down toggle-icon"></i>
                        </a>
                        <ul class="nav collapse ms-3 flex-column" id="pending-admissions-submenu">
                            <li class="mb-1">
                                <a href="{{ route('modules.pending.college') }}" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                                    <i class="bi bi-building me-2"></i> College
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('modules.pending.shs') }}" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                                    <i class="bi bi-mortarboard me-2"></i> SHS
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Waiting List Dropdown -->
                    <li class="nav-item mb-1">
                        <a class="nav-link d-flex align-items-center sidebar-dropdown-toggle" href="#waiting-list-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false">
                            <i class="bi bi-hourglass me-2"></i>
                            <span class="flex-grow-1">Waiting List</span>
                            <i class="bi bi-chevron-down toggle-icon"></i>
                        </a>
                        <ul class="nav collapse ms-3 flex-column" id="waiting-list-submenu">
                            <li class="mb-1">
                                <a href="{{ route('modules.waiting.college') }}" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                                    <i class="bi bi-building me-2"></i> College
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('modules.waiting.shs') }}" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                                    <i class="bi bi-mortarboard me-2"></i> SHS
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Student Records Dropdown -->
                    <li class="nav-item mb-1">
                        <a class="nav-link d-flex align-items-center sidebar-dropdown-toggle" href="#student-records-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false">
                            <i class="bi bi-journal-text me-2"></i>
                            <span class="flex-grow-1">Student Records</span>
                            <i class="bi bi-chevron-down toggle-icon"></i>
                        </a>
                        <ul class="nav collapse ms-3 flex-column" id="student-records-submenu">
                            <li class="mb-1">
                                <a href="{{ route('modules.records.college') }}" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                                    <i class="bi bi-building me-2"></i> College
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('modules.records.shs') }}" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                                    <i class="bi bi-mortarboard me-2"></i> SHS
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Cancelled Admissions Dropdown -->
                    <li class="nav-item mb-1">
                        <a class="nav-link d-flex align-items-center sidebar-dropdown-toggle" href="#uploaded-docs-submenu" data-bs-toggle="collapse" role="button" aria-expanded="false">
                            <i class="bi bi-file-earmark-x me-2"></i>
                            <span class="flex-grow-1">Cancelled Admissions</span>
                            <i class="bi bi-chevron-down toggle-icon"></i>
                        </a>
                        <ul class="nav collapse ms-3 flex-column" id="uploaded-docs-submenu">
                            <li class="mb-1">
                                <a href="{{ route('modules.cancelled.college') }}" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                                    <i class="bi bi-building me-2"></i> College
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('modules.cancelled.shs') }}" class="nav-link py-2 px-3 d-flex align-items-center" data-load>
                                    <i class="bi bi-mortarboard me-2"></i> SHS
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Concerns -->
                    <li class="nav-item mb-1">
                        <a href="{{ route('modules.concerns') }}" class="nav-link" data-load>
                            <i class="bi bi-exclamation-circle me-2"></i> Concerns
                        </a>
                    </li>

                    <!-- Archive Module -->
                    <li class="nav-item mb-1">
                        <a href="{{ route('modules.archive') }}" class="nav-link" data-load title="Contains all archived admissions and re-evaluation records.">
                            <i class="bi bi-archive me-2"></i> Archive Module
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
            <!-- Top Navbar -->
            <nav class="top-navbar d-flex justify-content-between align-items-center sticky-top">
                <div>
                    <button id="sidebar-toggle" class="btn btn-light d-lg-none shadow-sm"><i class="bi bi-list"></i></button>
                </div>
                <div class="d-flex align-items-center">
                    <span id="current-time" class="me-3 d-none d-sm-inline"></span>
                    
                    <!-- Notification Dropdown -->
<div class="dropdown me-2">
    <a href="#" class="notification-bell" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
        <i class="bi bi-bell"></i>
        @if($pendingConcernsCount > 0)
            <span class="notification-badge" aria-label="{{ $pendingConcernsCount }} pending concerns">
                {{ $pendingConcernsCount > 9 ? '9+' : $pendingConcernsCount }}
                <span class="visually-hidden">pending concerns</span>
            </span>
        @endif
    </a>
    <ul class="dropdown-menu notification-dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
        <div class="notification-dropdown-header">
            <h6>Notifications</h6>
            @if($pendingConcernsCount > 0)
                <button class="btn btn-sm mark-all-read" onclick="markAllRead(event)">
                    <i class="bi bi-check2-all me-1"></i> Mark all as read
                </button>
            @endif
        </div>
        
        <div class="notification-dropdown-body">
            @if($pendingConcernsCount > 0)
                <!-- Concern Items will be loaded here via AJAX -->
                <div id="notification-list">
                    <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">Loading notifications...</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="notification-dropdown-empty">
                    <i class="bi bi-bell-slash"></i>
                    <p class="mb-0">No new notifications</p>
                </div>
            @endif
        </div>
        
        @if($pendingConcernsCount > 0)
            <div class="notification-item-footer">
                <a href="{{ route('modules.concerns') }}">
                    <i class="bi bi-list-task me-1"></i> View all concerns
                </a>
            </div>
        @endif
    </ul>
</div>
                    
                    <a href="#" class="search-icon" title="Search">
                        <i class="bi bi-search"></i>
                    </a>
                    
                    <!-- User Dropdown -->
                    <div class="dropdown ms-2">
    <a href="#" class="user-dropdown-toggle d-flex align-items-center justify-content-center text-decoration-none" 
       id="userDropdown" 
       data-bs-toggle="dropdown" 
       aria-expanded="false" 
       style="width: 40px; height: 40px; background-color: #7c3aed; color: white; border-radius: 50%;">
        <i class="bi bi-person"></i>
    </a>
    
    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" aria-labelledby="userDropdown" style="min-width: 200px;">
        <li class="px-3 py-2 bg-light rounded-top">
            <h6 class="mb-0 fw-bold" style="color: #1e3a8a;">{{ Auth::user()->name }}</h6>
            <small class="text-muted">{{ Auth::user()->email }}</small>
        </li>
        <li><hr class="dropdown-divider m-0"></li>
        <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2 text-primary"></i>Profile</a></li>
        <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2 text-primary"></i>Settings</a></li>
        <li><hr class="dropdown-divider m-0"></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item py-2 text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </button>
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
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <span>Enrollment Management System &copy; {{ date('Y') }}</span>
                    <span class="text-muted small">v2.1.0</span>
                </div>
            </footer>
        </div>
        
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>

        <!-- Session Invalid Modal -->
        <div id="sessionInvalidModal" class="modal fade" tabindex="-1" aria-labelledby="sessionInvalidModalLabel" aria-hidden="true" style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-warning bg-gradient text-white border-0">
                        <h5 class="modal-title" id="sessionInvalidModalLabel">
                            <i class="bi bi-exclamation-triangle me-2"></i>Session Invalidated
                        </h5>
                    </div>
                    <div class="modal-body text-center py-4">
                        <div class="mb-3">
                            <i class="bi bi-exclamation-triangle text-warning" style="font-size: 48px;"></i>
                        </div>
                        <p class="lead fw-bold">Your session has been invalidated</p>
                        <p class="mb-1">You have been logged out because your account was accessed from another device.</p>
                        <p class="text-muted mt-2">You will be automatically redirected in <span id="countdown" class="fw-bold text-danger">5</span> seconds.</p>
                    </div>
                    <div class="modal-footer justify-content-center border-0">
                        <button type="button" id="logoutBtn" class="btn btn-danger px-4 py-2 fw-bold">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <script>
    document.addEventListener('DOMContentLoaded', function () {
        const contentArea = document.getElementById('page-content');

        // Load notifications when dropdown is shown
        const notificationDropdown = document.getElementById('notificationDropdown');
        if (notificationDropdown) {
            notificationDropdown.addEventListener('click', function(e) {
                e.preventDefault();
                loadNotifications();
            });
        }

        // Function to load notifications
        function loadNotifications() {
            const notificationList = document.getElementById('notification-list');
            if (!notificationList) return;

            // Fetch notifications from server
            fetch('{{ route("modules.concerns.notifications") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.concerns.length > 0) {
                    let html = '';
                    data.concerns.forEach(concern => {
                        const isUnread = concern.is_read === 0 || concern.is_read === '0';
                        const createdAt = new Date(concern.created_at);
                        const timeAgo = getTimeAgo(createdAt);
                        
                        html += `
                            <a href="{{ route('modules.concerns') }}" class="notification-item ${isUnread ? 'unread' : ''}" onclick="handleNotificationClick(event, ${concern.id})">
                                <div class="d-flex">
                                    <div class="notification-icon">
                                        <i class="bi bi-exclamation-triangle"></i>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-title">
                                            ${escapeHtml(concern.subject || 'New Concern')}
                                        </div>
                                        <div class="notification-message">
                                            ${escapeHtml(truncateText(concern.message, 80))}
                                        </div>
                                        <div class="notification-meta">
                                            <small class="notification-time">
                                                <i class="bi bi-clock me-1"></i> ${timeAgo}
                                            </small>
                                            ${concern.student_name ? `<span class="badge bg-primary">${escapeHtml(concern.student_name)}</span>` : ''}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        `;
                    });
                    notificationList.innerHTML = html;
                    
                    // Update badge count based on unread notifications
                    const unreadCount = data.concerns.filter(c => c.is_read === 0 || c.is_read === '0').length;
                    updateBadgeCount(unreadCount);
                } else {
                    notificationList.innerHTML = `
                        <div class="notification-dropdown-empty">
                            <i class="bi bi-bell-slash"></i>
                            <p class="mb-0">No new notifications</p>
                        </div>
                    `;
                    // Hide badge if no notifications
                    updateBadgeCount(0);
                }
            })
            .catch(error => {
                console.error('Error loading notifications:', error);
                notificationList.innerHTML = `
                    <div class="notification-dropdown-empty">
                        <i class="bi bi-exclamation-triangle"></i>
                        <p class="mb-0">Failed to load notifications</p>
                    </div>
                `;
            });
        }

        // Helper function to get time ago
        function getTimeAgo(date) {
            const now = new Date();
            const seconds = Math.floor((now - date) / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);

            if (days > 0) {
                return days === 1 ? '1 day ago' : `${days} days ago`;
            }
            if (hours > 0) {
                return hours === 1 ? '1 hour ago' : `${hours} hours ago`;
            }
            if (minutes > 0) {
                return minutes === 1 ? '1 minute ago' : `${minutes} minutes ago`;
            }
            return 'Just now';
        }

        // Helper function to truncate text
        function truncateText(text, maxLength) {
            if (!text) return '';
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }

        // Helper function to escape HTML
        function escapeHtml(text) {
            if (!text) return '';
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

          // Handle notification click - mark as read and navigate to concerns module
        window.handleNotificationClick = function(event, concernId) {
            event.preventDefault();
            
            // Mark as read
            markAsRead(concernId).then(() => {
                // Navigate to concerns module page
                window.location.href = '{{ route('modules.concerns') }}';
            });
        }

        // Mark concern as read
        function markAsRead(concernId) {
            return fetch('{{ url("modules/concerns") }}/' + concernId + '/mark-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Remove unread class from this item
                const item = document.querySelector(`.notification-item[onclick*="${concernId}"]`);
                if (item) {
                    item.classList.remove('unread');
                }
                
                // Update badge count - decrease by 1
                updateBadgeCountAfterRead();
                
                return data;
            })
            .catch(error => {
                console.error('Error marking as read:', error);
                return Promise.resolve();
            });
        }

        // Update badge count after reading a notification
        function updateBadgeCountAfterRead() {
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                // Get current count from badge text
                let currentText = badge.textContent.trim();
                let currentCount = parseInt(currentText);
                
                if (!isNaN(currentCount)) {
                    currentCount--;
                    
                    if (currentCount <= 0) {
                        // Remove badge if count is 0
                        badge.remove();
                    } else {
                        // Update badge text
                        badge.innerHTML = `${currentCount > 9 ? '9+' : currentCount}<span class="visually-hidden">pending concerns</span>`;
                    }
                }
            }
        }

        // Update badge count dynamically
        function updateBadgeCount(count) {
            const badge = document.querySelector('.notification-badge');
            const bell = document.querySelector('.notification-bell');
            
            if (count > 0) {
                if (!badge) {
                    // Create badge if it doesn't exist
                    const newBadge = document.createElement('span');
                    newBadge.className = 'notification-badge';
                    newBadge.setAttribute('aria-label', `${count} pending concerns`);
                    newBadge.innerHTML = `${count > 9 ? '9+' : count}<span class="visually-hidden">pending concerns</span>`;
                    bell.appendChild(newBadge);
                } else {
                    // Update existing badge
                    badge.innerHTML = `${count > 9 ? '9+' : count}<span class="visually-hidden">pending concerns</span>`;
                }
            } else {
                // Remove badge if count is 0
                if (badge) badge.remove();
            }
        }

        // Mark all as read
        window.markAllRead = function(event) {
            event.preventDefault();
            event.stopPropagation();
            
            fetch('{{ route("modules.concerns.mark-all-read") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove notification badge
                    const badge = document.querySelector('.notification-badge');
                    if (badge) badge.remove();
                    
                    // Remove unread class from all items
                    document.querySelectorAll('.notification-item.unread').forEach(item => {
                        item.classList.remove('unread');
                    });
                    
                    // Show success message
                    const notificationList = document.getElementById('notification-list');
                    if (notificationList) {
                        notificationList.innerHTML = `
                            <div class="notification-dropdown-empty">
                                <i class="bi bi-check-circle text-success" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="mb-0 text-success">All notifications marked as read</p>
                            </div>
                        `;
                    }
                }
            })
            .catch(error => console.error('Error marking all as read:', error));
        }

          // Listen to all links with [data-load]
        document.querySelectorAll('a[data-load]').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('href');

                // Add loading spinner
                contentArea.innerHTML = `
                    <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-3 fs-5 fw-bold text-primary">Loading content...</p>
                        </div>
                    </div>
                `;

                // Capture parent dropdown to restore state
                const parentCollapse = this.closest('.collapse');
                const parentToggle = parentCollapse
                    ? document.querySelector(`[href="#${parentCollapse.id}"]`)
                    : null;

                // Fetch content via AJAX
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.querySelector('#page-content')?.innerHTML;

                    if (newContent) {
                        contentArea.innerHTML = newContent;

                        // Re-run all scripts in loaded content
                        const scripts = contentArea.querySelectorAll('script');
                        scripts.forEach(oldScript => {
                            const newScript = document.createElement('script');
                            if (oldScript.src) {
                                newScript.src = oldScript.src;
                                newScript.async = true;
                            } else {
                                newScript.textContent = oldScript.textContent;
                            }
                            oldScript.parentNode.replaceChild(newScript, oldScript);
                        });

                        // Restore dropdown open state
                        if (parentCollapse && parentToggle) {
                            parentCollapse.classList.add('show');
                            parentToggle.setAttribute('aria-expanded', 'true');
                        }

                        // Clear archive access if not archive
                        if (!url.includes('/archive')) {
                            clearArchiveAccess();
                        }

                        function clearArchiveAccess() {
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '{{ route("modules.archive.clear-access") }}', false);
                            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                            xhr.setRequestHeader('Content-Type', 'application/json');
                            xhr.setRequestHeader('Accept', 'application/json');
                            xhr.send();
                            if (xhr.status !== 200) {
                                console.error('Failed to clear archive access:', xhr.responseText);
                            }
                        }
                    } else {
                        contentArea.innerHTML = '<div class="alert alert-danger">Error loading content. Please try again.</div>';
                    }

                    // Update URL
                    window.history.pushState({}, '', url);
                })
                .catch(err => {
                    console.error('Fetch error:', err);
                    contentArea.innerHTML = `
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle me-2 fs-5"></i>
                            <div>Failed to load content. Please try again.</div>
                        </div>
                    `;
                });
            });
        });

        // 🕒 Clock
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                timeElement.textContent = now.toLocaleTimeString('en-US', {
                    hour: '2-digit', 
                    minute: '2-digit', 
                    hour12: true,
                    hourCycle: 'h12'
                });
            }
        }
        setInterval(updateTime, 1000);
        updateTime();
    });
    </script>

</body>
</html>