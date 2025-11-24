<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ESEM - Event Management')</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navbar */
        .navbar {
            background-color: #14b8a6;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 20px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            background-color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 20px;
        }

        .brand-name {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding-bottom: 5px;
            transition: all 0.3s;
        }

        .nav-menu a.active {
            border-bottom: 2px solid white;
        }

        .nav-menu a:hover {
            opacity: 0.8;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            cursor: pointer;
            position: relative;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-login {
            color: white;
            background: transparent;
            border: none;
            padding: 8px 20px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login:hover {
            opacity: 0.8;
        }

        .btn-register {
            background: white;
            color: #14b8a6;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-register:hover {
            background: #f0f0f0;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 400px);
        }

        /* Footer */
        .footer {
            background: #14b8a6;
            color: white;
            padding: 50px 0 20px;
            margin-top: 60px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 40px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .footer-brand h3 {
            font-size: 28px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 15px;
        }

        .contact-icon {
            font-size: 18px;
            margin-top: 2px;
        }

        .contact-label {
            font-size: 12px;
            color: rgba(255,255,255,0.7);
            display: block;
            margin-bottom: 3px;
        }

        .contact-value {
            font-weight: 500;
            font-size: 14px;
        }

        .footer-nav {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-nav a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
            font-size: 14px;
        }

        .footer-nav a:hover {
            opacity: 0.7;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.2);
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .nav-menu {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .navbar .container {
                flex-wrap: wrap;
            }

            .nav-buttons {
                order: 3;
                width: 100%;
                margin-top: 15px;
                justify-content: center;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                 <img src="/image/icon.png">
                <span class="brand-name">ESEM</span>
            </div>

            <ul class="nav-menu">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#events">Trending Events</a></li>
                <li><a href="#categories">Categories</a></li>
            </ul>

            <div class="nav-buttons">
                @auth
                    <div class="user-profile">
                        <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" 
                             alt="Profile" class="user-avatar">
                        <span class="user-name">{{ auth()->user()->name }}</span>
                        <span>▼</span>
                    </div>
                @else
                    <a href="/login" class="btn-login">Login</a>
                    <a href="/register" class="btn-register">Register</a>
                @endauth
            </div>

            <button class="mobile-menu-btn">☰</button>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div>
                    <div class="footer-brand">
                        <div class="logo-icon">📧</div>
                        <h3>ESEM</h3>
                    </div>
                    <div class="footer-nav">
                        <a href="/">Home</a>
                        <a href="#about">About Us</a>
                        <a href="#blog">Blog</a>
                        <a href="#events">Trending Events</a>
                        <a href="#categories">Categories</a>
                    </div>
                </div>

                <div class="footer-links">
                    <div class="contact-item">
                        <span class="contact-icon">📧</span>
                        <div>
                            <span class="contact-label">Email</span>
                            <div class="contact-value">sparesupport@metaticket.in</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <div>
                            <span class="contact-label">Phone Number</span>
                            <div class="contact-value">8884518858</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📅</span>
                        <div>
                            <span class="contact-label">Working Days</span>
                            <div class="contact-value">Monday - Sunday</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">🕐</span>
                        <div>
                            <span class="contact-label">Working Hours</span>
                            <div class="contact-value">8:00AM - 8:00PM (IST)</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <div>
                            <span class="contact-label">Address</span>
                            <div class="contact-value">1717 Harrison St, San Francisco,<br>CA 94103, INDIA</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} ESEM. All rights reserved. | Event Management System</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>