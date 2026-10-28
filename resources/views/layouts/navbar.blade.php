        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #FFFFFF; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <div class="container">
                <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
                    <div class="me-2">
                        <i class="fas fa-home" style="font-size: 28px; color: #17324D;"></i>
                    </div>
                    <span class="fw-bold" style="font-size: 24px; color: #17324D;">RealEstate</span>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="color: #17324D;"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="{{ route('index') }}" style="color: #17324D; padding: 12px 20px;">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="{{ route('properties.index') }}" style="color: #202B38; padding: 12px 20px;">
                                Properties
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #202B38; padding: 12px 20px;">
                                Categories
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="categoriesDropdown" style="border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                <li><a class="dropdown-item" href="{{ route('categories.index') }}" style="color: #202B38;">All Categories</a></li>
                                <li><hr class="dropdown-divider"></li>
                                @if(isset($categories))
                                    @foreach($categories->take(5) as $category)
                                        <li><a class="dropdown-item" href="{{ route('show') }}?catigory_filter={{ $category->name }}" style="color: #202B38;">{{ $category->name }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="{{ route('show') }}" style="color: #202B38; padding: 12px 20px;">
                                Search
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center gap-3">
                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium" style="border-color: #D6AD60; color: #D6AD60; transition: all 0.3s ease;">
                                    <i class="fas fa-shield-alt me-2"></i>Admin
                                </a>
                            @endif

                            <!-- Icône de notifications -->
                            <div class="position-relative">
                                <a href="{{ route('notifications.index') }}" class="btn btn-outline-dark rounded-circle" style="width: 45px; height: 45px; border-color: #17324D; color: #17324D; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                    <i class="fas fa-bell" style="font-size: 18px;"></i>
                                </a>
                                @php
                                    $unreadCount = auth()->user()->unreadNotifications()->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #DC3545; font-size: 11px; padding: 5px 8px;">
                                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                    </span>
                                @else
                                    <span class="notification-badge position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color: #DC3545; font-size: 11px; padding: 5px 8px; display: none;">
                                        0
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('reservations.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium" style="border-color: #17324D; color: #17324D; transition: all 0.3s ease;">
                                <i class="fas fa-calendar-alt me-2"></i>Mes Réservations
                            </a>
                            <a href="{{ route('profile') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium" style="border-color: #17324D; color: #17324D; transition: all 0.3s ease;">
                                <i class="fas fa-user me-2"></i>Profile
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-dark rounded-pill px-4 py-2 fw-medium" style="background-color: #17324D; border: none; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(23, 50, 77, 0.2);">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium" style="border-color: #17324D; color: #17324D; transition: all 0.3s ease;">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-dark rounded-pill px-4 py-2 fw-medium" style="background-color: #17324D; border: none; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(23, 50, 77, 0.2);">
                                Sign Up
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->