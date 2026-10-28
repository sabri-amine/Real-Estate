<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - RESTATE</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-dark: #17324D;
            --primary-secondary: #315C7D;
            --accent-gold: #D6AD60;
            --bg-light: #F5F7FA;
            --text-dark: #202B38;
            --text-muted: #6B7280;
        }

        body {
            font-family: 'Heebo', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .sidebar {
            background-color: var(--primary-dark);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            padding: 0;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand h2 {
            color: white;
            font-weight: 800;
            font-family: 'Inter', sans-serif;
            margin: 0;
            font-size: 24px;
        }

        .sidebar-brand h2 span {
            color: var(--accent-gold);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--accent-gold);
        }

        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar-menu a i {
            width: 25px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 0;
            min-height: 100vh;
        }

        .topbar {
            background-color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-brand {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 20px;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-dropdown a {
            color: var(--text-dark);
            text-decoration: none;
        }

        .user-dropdown a:hover {
            color: var(--primary-secondary);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border-radius: 12px;
        }

        .btn-primary {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-primary:hover {
            background-color: var(--primary-secondary);
            border-color: var(--primary-secondary);
        }

        .table thead th {
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-weight: 600;
            border-bottom: 2px solid #E5E7EB;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h2>RE<span>STATE</span></h2>
            <small class="text-white-50">Admin Panel</small>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.properties') }}" class="{{ request()->routeIs('admin.properties*') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                Properties
            </a>
            <a href="{{ route('admin.reservations') }}" class="{{ request()->routeIs('admin.reservations*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                Réservations
            </a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i>
                Categories
            </a>
            <a href="{{ route('admin.listing-types.index') }}" class="{{ request()->routeIs('admin.listing-types*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                Listing Types
            </a>
            <a href="{{ route('index') }}" class="mt-3">
                <i class="fas fa-arrow-left"></i>
                Back to Site
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-link d-md-none me-3" id="sidebarToggle">
                    <i class="fas fa-bars" style="color: var(--primary-dark);"></i>
                </button>
                <span class="topbar-brand">Admin Dashboard</span>
            </div>
            <div class="user-dropdown">
                <!-- Notifications -->
                <div class="position-relative me-3">
                    <a href="{{ route('notifications.index') }}" class="btn btn-outline-dark rounded-circle" style="width: 40px; height: 40px; border-color: #E5E7EB; color: #6B7280; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-bell" style="font-size: 16px;"></i>
                    </a>
                    @php
                        $unreadCount = auth()->user()->unreadNotifications()->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #DC3545; font-size: 10px; padding: 4px 6px;">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                    @endif
                </div>

                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-2"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user me-2"></i>My Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-4">
            @yield('content')
        </div>
    </div>

    <!-- Notifications SweetAlert2 -->
    @include('layouts.notifications')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>
</html>
