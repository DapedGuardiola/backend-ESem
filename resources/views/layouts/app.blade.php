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

        /* Improved Navbar */
        .navbar {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .container {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            padding: 1.2rem 20px;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: transform 0.3s;
        }

        .nav-brand:hover {
            transform: scale(1.05);
        }

        .logo-icon {
            background-color: white;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 22px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .brand-name {
            color: white;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 40px;
            flex: 1;
            justify-content: center;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            padding: 8px 20px;
            transition: all 0.3s;
            border-radius: 8px;
            position: relative;
        }

        .nav-menu a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: white;
            transition: width 0.3s;
            border-radius: 2px;
        }

        .nav-menu a.active::before,
        .nav-menu a:hover::before {
            width: 80%;
        }

        .nav-menu a:hover {
            background: rgba(255,255,255,0.1);
        }

        .nav-menu a.active {
            background: rgba(255,255,255,0.15);
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 25px;
            transition: all 0.3s;
            background: rgba(255,255,255,0.1);
        }

        .user-profile:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            background: white;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .mobile-menu-btn {
            display: none;
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .mobile-menu-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 450px);
            padding-bottom: 0;
        }

        /* Improved Footer */
        .footer {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: white;
            padding: 60px 0 30px;
            margin-top: 80px;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #14b8a6 0%, #0d9488 100%);
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 50px;
        }

        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 25px;
            color: #14b8a6;
            font-weight: 700;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .footer-brand .logo-icon {
            background: #14b8a6;
            color: white;
        }

        .footer-brand h2 {
            font-size: 32px;
            margin: 0;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .footer-description {
            color: #9ca3af;
            line-height: 1.8;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 12px;
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            transition: all 0.3s;
        }

        .contact-item:hover {
            background: rgba(20,184,166,0.1);
            transform: translateX(5px);
        }

        .contact-icon {
            font-size: 20px;
            margin-top: 2px;
            color: #14b8a6;
        }

        .contact-label {
            font-size: 12px;
            color: #9ca3af;
            display: block;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contact-value {
            font-weight: 600;
            font-size: 14px;
            color: #e5e7eb;
        }

        .footer-nav {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .footer-nav a {
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 14px;
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-nav a::before {
            content: '→';
            opacity: 0;
            transition: all 0.3s;
            transform: translateX(-10px);
        }

        .footer-nav a:hover {
            color: #14b8a6;
            padding-left: 10px;
        }

        .footer-nav a:hover::before {
            opacity: 1;
            transform: translateX(0);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s;
        }

        .social-link:hover {
            background: #14b8a6;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(20,184,166,0.3);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 14px;
            color: #9ca3af;
        }

        .footer-bottom p {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
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
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }
        
        .modal.active {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 30px;
            border-radius: 16px;
            width: 90%;
            max-width: 650px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            position: relative;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(50px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .modal-header h2 {
            margin: 0;
            color: #14b8a6;
            font-size: 26px;
            font-weight: 700;
        }

        .close-btn {
            color: #9ca3af;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .close-btn:hover {
            color: #ef4444;
            background: #fee2e2;
        }

        .modal-body p {
            margin-bottom: 12px;
            font-size: 16px;
            line-height: 1.6;
        }

        .modal-body strong {
            color: #1f2937;
            display: inline-block;
            min-width: 130px;
            font-weight: 600;
        }

        .modal-body .event-detail-item {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
            padding: 10px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .modal-body h4 {
            margin-top: 20px;
            margin-bottom: 15px;
            color: #14b8a6;
            font-size: 18px;
            font-weight: 700;
        }
        
        .modal-footer {
            padding-top: 25px;
            border-top: 2px solid #e5e7eb;
            text-align: right;
        }

        .modal-book-btn {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(20,184,166,0.3);
        }

        .modal-book-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(20,184,166,0.4);
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .nav-menu {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        @media (max-width: 768px) {
            .navbar .container {
                padding: 1rem 15px;
            }

            .brand-name {
                font-size: 22px;
            }

            .logo-icon {
                padding: 8px 12px;
                font-size: 18px;
            }

            .user-name {
                display: none;
            }
            
            .modal-content {
                width: 95%;
                padding: 20px;
            }

            .modal-header h2 {
                font-size: 22px;
            }

            .footer {
                margin-top: 40px;
                padding: 40px 0 20px;
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
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            </ul>

            <div class="nav-buttons">
                @auth
                    <div class="user-profile">
                        <img src="{{ Auth::user()->avatar ?? '/image/default-avatar.png' }}" alt="Profile" class="user-avatar">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </div>
                @else
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
                <!-- About Section -->
                <div class="footer-section">
                    <div class="footer-brand">
                        <div class="logo-icon">📧</div>
                        <h2>ESEM</h2>
                    </div>
                    <p class="footer-description">
                        Your premier platform for discovering and registering for seminars, workshops, and educational events. Join us to expand your knowledge and network with industry professionals.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook">📘</a>
                        <a href="#" class="social-link" title="Twitter">🐦</a>
                        <a href="#" class="social-link" title="Instagram">📷</a>
                        <a href="#" class="social-link" title="LinkedIn">💼</a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <nav class="footer-nav">
                        <a href="/">Home</a>
                        <a href="/seminar">Seminars</a>
                        <a href="#">About Us</a>
                        <a href="#">Contact</a>
                        <a href="#">FAQ</a>
                    </nav>
                </div>
                
                <!-- Contact Section -->
                <div class="footer-section">
                    <h3>Contact Us</h3>
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
                                <div class="contact-value">Jl. Soekarno Hatta No.9<br>Malang, East Java 65141</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 ESEM. All rights reserved. Made with ❤️ for education</p>
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
                <div class="event-detail-item"><strong>📅 Date:</strong> <span id="modalEventDate"></span></div>
                <div class="event-detail-item"><strong>🕐 Time:</strong> <span id="modalEventTime"></span></div>
                <div class="event-detail-item"><strong>📍 Location:</strong> <span id="modalEventLocation"></span></div>
                <div class="event-detail-item"><strong>🎯 Type:</strong> <span id="modalEventType"></span></div>
                <div class="event-detail-item"><strong>👤 Speaker:</strong> <span id="modalEventSpeaker"></span></div>
                <div class="event-detail-item"><strong>💰 Price:</strong> <span id="modalEventPrice"></span></div>
                
                <h4>📝 Event Description</h4>
                <div id="modalEventDescription" style="white-space: pre-wrap; margin-top: 10px; color: #555; line-height: 1.8; padding: 15px; background: #f9fafb; border-radius: 8px;">
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="modalBookNowLink" class="modal-book-btn">Book Now →</a>
            </div>
        </div>
    </div>

    <script>
        // Close modal functionality
        const modal = document.getElementById('eventModal');
        const closeBtn = document.querySelector('.close-btn');

        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                modal.classList.remove('active');
            });
        }

        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });

        // Mobile menu toggle (implement as needed)
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                // Add your mobile menu logic here
                alert('Mobile menu - implement dropdown for navigation');
            });
        }
    </script>

    @stack('scripts')
</body>
</html>