<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to E-Library</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient glowing circles */
        .ambient-glow-1 {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, rgba(99, 102, 241, 0) 70%);
            top: -150px;
            left: -150px;
            pointer-events: none;
            z-index: 1;
        }

        .ambient-glow-2 {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.1) 0%, rgba(236, 72, 153, 0) 70%);
            bottom: -100px;
            right: -100px;
            pointer-events: none;
            z-index: 1;
        }

        header {
            padding: 30px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 10;
        }

        @media (max-width: 768px) {
            header {
                padding: 20px 30px;
            }
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.03em;
        }

        .logo i {
            color: #6366f1;
        }

        .nav-links a {
            text-decoration: none;
            color: #94a3b8;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .nav-links a:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .btn-header {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white !important;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        }

        .btn-header:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.35);
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 80px;
            position: relative;
            z-index: 10;
        }

        @media (max-width: 1024px) {
            main {
                flex-direction: column;
                gap: 50px;
                padding: 40px 30px;
                text-align: center;
            }
        }

        .hero-content {
            flex: 1;
            max-width: 600px;
            animation: fadeInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            color: #a5b4fc;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 54px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.04em;
            margin-bottom: 24px;
            color: #ffffff;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 40px;
            }
        }

        h1 span {
            background: linear-gradient(to right, #a5b4fc, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .description {
            font-size: 18px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .cta-buttons {
            display: flex;
            gap: 16px;
        }

        @media (max-width: 1024px) {
            .cta-buttons {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .cta-buttons {
                flex-direction: column;
                align-items: stretch;
            }
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 32px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(99, 102, 241, 0.45);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 32px;
            background-color: rgba(255, 255, 255, 0.03);
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .hero-visual {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeInRight 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .library-illustration {
            width: 100%;
            max-width: 500px;
            height: 380px;
            border-radius: 24px;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.5) 0%, rgba(15, 23, 42, 0.8) 100%);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 40px;
            text-align: center;
            overflow: hidden;
        }

        .library-illustration::before {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: #6366f1;
            filter: blur(80px);
            opacity: 0.15;
            top: 50px;
            left: 50px;
        }

        .library-illustration i.main-icon {
            font-size: 80px;
            background: linear-gradient(135deg, #a5b4fc 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 24px;
            filter: drop-shadow(0 8px 16px rgba(99, 102, 241, 0.2));
        }

        .illustration-title {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
        }

        .illustration-desc {
            font-size: 14px;
            color: #64748b;
            max-width: 300px;
        }

        /* Decorative cards hovering in illustration */
        .floating-card {
            position: absolute;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            animation: float 4s ease-in-out infinite;
        }

        .floating-card.c1 {
            top: 40px;
            right: 40px;
            animation-delay: 0s;
        }

        .floating-card.c2 {
            bottom: 40px;
            left: 40px;
            animation-delay: 2s;
        }

        .floating-card i {
            font-size: 18px;
            color: #818cf8;
        }

        .floating-card span {
            font-size: 12px;
            font-weight: 600;
            color: #e2e8f0;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-8px);
            }
        }

        footer {
            padding: 30px;
            text-align: center;
            font-size: 13px;
            color: #475569;
            border-top: 1px solid rgba(255, 255, 255, 0.03);
            position: relative;
            z-index: 10;
        }
    </style>
</head>
<body>
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <header>
        <div class="logo">
            <i class="fas fa-book-open"></i>
            <span>E-Library</span>
        </div>
        <div class="nav-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-header">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Admin Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-header">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <main>
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-sparkles"></i> Modern Library Platform
            </div>
            <h1>Smart Way to Manage <span>Library Systems</span></h1>
            <p class="description">
                A simple, robust, and beautiful administrative system designed to organize books, catalog shelves, manage student databases, and track loan transactions seamlessly.
            </p>
            <div class="cta-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary">
                        Go to Dashboard <i class="fas fa-arrow-right"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">
                        Get Started <i class="fas fa-sign-in-alt"></i>
                    </a>
                @endauth
                <a href="https://github.com" target="_blank" class="btn-secondary">
                    <i class="fab fa-github"></i> Learn More
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="library-illustration">
                <div class="floating-card c1">
                    <i class="fas fa-bookmark"></i>
                    <span>Fast Returns</span>
                </div>
                <i class="fas fa-graduation-cap main-icon"></i>
                <div class="illustration-title">E-Library Admin Console</div>
                <div class="illustration-desc">Interactive dashboard overviewing real-time database registers and loan status.</div>
                <div class="floating-card c2">
                    <i class="fas fa-swatchbook"></i>
                    <span>Custom Shelves</span>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} E-Library Management System. Crafted with passion & design excellence.</p>
    </footer>
</body>
</html>
