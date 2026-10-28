<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - RealEstate</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Inter:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Heebo', sans-serif;
            background-color: #F5F7FA;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(23, 50, 77, 0.12);
            overflow: hidden;
            min-height: 520px;
        }

        .left-column {
            background: linear-gradient(135deg, #17324D 0%, #315C7D 100%);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #FFFFFF;
            position: relative;
            overflow: hidden;
        }

        .left-column::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset('img/header.jpg') }}') center/cover;
            opacity: 0.15;
        }

        .left-column-content {
            position: relative;
            z-index: 1;
        }

        .left-column h1 {
            font-family: 'Inter', sans-serif;
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .left-column p {
            font-size: 15px;
            opacity: 0.9;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-card h3 {
            font-size: 24px;
            font-weight: 700;
            color: #D6AD60;
            margin-bottom: 3px;
        }

        .stat-card p {
            font-size: 12px;
            margin-bottom: 0;
            opacity: 0.9;
        }

        .right-column {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .brand-logo i {
            font-size: 28px;
            color: #17324D;
        }

        .brand-logo span {
            font-family: 'Inter', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #17324D;
        }

        .form-title {
            font-family: 'Inter', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #17324D;
            margin-bottom: 6px;
        }

        .form-subtitle {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 16px;
            position: relative;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #202B38;
            margin-bottom: 6px;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
            font-size: 18px;
        }

        .form-control {
            padding: 12px 14px 12px 42px;
            border: 2px solid #E5E7EB;
            border-radius: 10px;
            font-size: 14px;
            color: #202B38;
            transition: all 0.3s ease;
            background-color: #F9FAFB;
        }

        .form-control:focus {
            border-color: #315C7D;
            background-color: #FFFFFF;
            box-shadow: 0 0 0 4px rgba(49, 92, 125, 0.1);
        }

        .form-control::placeholder {
            color: #9CA3AF;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #315C7D;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #17324D 0%, #315C7D 100%);
            border: none;
            border-radius: 10px;
            color: #FFFFFF;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 12px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(23, 50, 77, 0.3);
        }

        .forgot-password {
            text-align: center;
            margin-top: 14px;
        }

        .forgot-password a {
            color: #315C7D;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #17324D;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #9CA3AF;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #E5E7EB;
        }

        .divider span {
            padding: 0 12px;
        }

        .register-link {
            text-align: center;
            margin-top: 16px;
            font-size: 14px;
            color: #6B7280;
        }

        .register-link a {
            color: #315C7D;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #17324D;
        }

        .alert {
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 16px;
            border: none;
            font-size: 13px;
        }

        .alert-success {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .alert-danger {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .error-message {
            color: #DC2626;
            font-size: 12px;
            margin-top: 4px;
        }

        @media (max-width: 991px) {
            .login-container {
                border-radius: 0;
                box-shadow: none;
                min-height: 100vh;
            }

            .left-column {
                display: none;
            }

            .right-column {
                padding: 30px 20px;
            }

            .form-title {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .right-column {
                padding: 24px 16px;
            }

            .brand-logo {
                margin-bottom: 20px;
            }

            .brand-logo span {
                font-size: 20px;
            }

            .form-title {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="login-container">
            <div class="row g-0">
                <!-- Left Column - Decorative -->
                <div class="col-lg-6 left-column">
                    <div class="left-column-content">
                        <h1>Find Your Dream Property</h1>
                        <p>Discover thousands of properties across Morocco. From luxury apartments to spacious villas, we have the perfect home waiting for you.</p>

                        <div class="stat-card">
                            <h3>500+</h3>
                            <p>Properties Listed</p>
                        </div>

                        <div class="stat-card">
                            <h3>1000+</h3>
                            <p>Happy Customers</p>
                        </div>

                        <div class="stat-card">
                            <h3>50+</h3>
                            <p>Trusted Agents</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Login Form -->
                <div class="col-lg-6 right-column">
                    <div class="brand-logo">
                        <i class="fas fa-home"></i>
                        <span>RealEstate</span>
                    </div>

                    <h2 class="form-title">Welcome Back</h2>
                    <p class="form-subtitle">Sign in to continue to your account</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label class="form-label" for="email">Email Address</label>
                            <div class="input-wrapper">
                                <i class="bi bi-envelope"></i>
                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email"
                                    value="{{ old('email') }}"
                                    required
                                >
                            </div>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-wrapper">
                                <i class="bi bi-lock"></i>
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Enter your password"
                                    required
                                >
                                <i class="bi bi-eye password-toggle" id="togglePassword"></i>
                            </div>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                        </button>

                        <div class="forgot-password">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </form>

                    <div class="divider">
                        <span>or</span>
                    </div>

                    <div class="register-link">
                        Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications SweetAlert2 -->
    @include('layouts.notifications')

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
