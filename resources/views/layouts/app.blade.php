<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ESEM - Event Management')</title>z
    
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
            text-decoration: none;
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
            padding: 5px 0;
            transition: all 0.3s;
            border-bottom: 2px solid transparent;
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
            background: white;
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
            transition: all 0.3s;
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
            padding-bottom: 0;
        }

        /* Footer */
        .footer {
            background: #14b8a6;
            color: white;
            padding: 50px 0 20px;
            margin-top: 0;
            clear: both;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .footer-brand h3 {
            font-size: 28px;
            margin: 0;
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            align-items: center;
            justify-content: center;
        }
        
        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            margin: 0;
            color: #14b8a6;
            font-size: 24px;
        }

        .close-btn {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: #333;
        }

        .modal-body p {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.5;
        }

        .modal-body strong {
            color: #333;
            display: inline-block;
            min-width: 120px;
        }

        .modal-body .event-detail-item {
            display: flex;
            gap: 10px;
            margin-bottom: 8px;
        }

        .modal-body h4 {
            margin-top: 15px;
            margin-bottom: 10px;
            color: #14b8a6;
        }
        
        .modal-footer {
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: right;
        }

        .modal-book-btn {
            background-color: #14b8a6;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .modal-book-btn:hover {
            background-color: #0d9488;
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
            
            .modal-content {
                width: 95%;
                padding: 15px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="/" class="nav-brand">
                <div class="logo-icon">📧</div>
                <div class="brand-name">ESEM</div>
            </a>
            
            <ul class="nav-menu">
                <li><a href="/" class="active">Home</a></li>
                <li><a href="/seminar">Seminar</a></li>
            </ul>

            <div class="nav-buttons">
                @auth
                    <div class="user-profile">
                        <img src="{{ Auth::user()->avatar ?? '/image/default-avatar.png' }}" alt="Profile" class="user-avatar">
                        <span>{{ Auth::user()->name }}</span>
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
                <div class="footer-section">
                    <div class="footer-brand">
                        <div class="logo-icon">📧</div>
                        <h3>ESEM</h3>
                    </div>
                    
                    <div class="footer-links">
                        <div class="contact-item">
                            <span class="contact-icon">📧</span>
                            <div>
                                <span class="contact-label">Email</span>
                                <div class="contact-value">esem.events@edu.id</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">📱</span>
                            <div>
                                <span class="contact-label">WhatsApp</span>
                                <div class="contact-value">+62 812-3456-7890</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">📍</span>
                            <div>
                                <span class="contact-label">Address</span>
                                <div class="contact-value">Jl. Soekarno Hatta No.9, Malang, East Java 65141</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <nav class="footer-nav">
                        <a href="/">Home</a>
                        <a href="/about">About Us</a>
                        <a href="/blog">Blog</a>
                        <a href="/trending-events">Trending Events</a>
                        <a href="/categories">Categories</a>
                    </nav>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 ESEM. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Event Detail Modal -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalEventTitle">Event Title</h2>
                <span class="close-btn">&times;</span>
            </div>
            <div class="modal-body">
                <p class="event-detail-item"><strong>📅 Date:</strong> <span id="modalEventDate"></span></p>
                <p class="event-detail-item"><strong>🕐 Time:</strong> <span id="modalEventTime"></span></p>
                <p class="event-detail-item"><strong>📍 Location:</strong> <span id="modalEventLocation"></span></p>
                <p class="event-detail-item"><strong>🎯 Type:</strong> <span id="modalEventType"></span></p>
                <p class="event-detail-item"><strong>👤 Speaker:</strong> <span id="modalEventSpeaker"></span></p>
                <p class="event-detail-item"><strong>💰 Price:</strong> <span id="modalEventPrice"></span></p>
                
                <hr style="margin: 15px 0; border-top: 1px solid #eee;">
                <h4>📝 Event Description:</h4>
                <div id="modalEventDescription" style="white-space: pre-wrap; margin-top: 10px; color: #555; line-height: 1.6;">
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="modalBookNowLink" class="modal-book-btn">Book Now</a>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>