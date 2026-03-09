<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KEYZONE - Les meilleurs jeux, au meilleur prix')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #08080d;
            color: #ffffff;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        a { color: inherit; text-decoration: none; }

        /* =============================== */
        /* NAVIGATION                      */
        /* =============================== */
        nav.main-nav {
            background: rgba(8, 8, 13, 0.85);
            padding: 0 5%;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(139, 92, 246, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transition: all 0.3s ease;
        }
        nav.main-nav.scrolled {
            background: rgba(8, 8, 13, 0.95);
            border-bottom-color: rgba(139, 92, 246, 0.15);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        .nav-brand {
            font-size: 1.6rem;
            font-weight: 900;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #fff 20%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s;
        }
        .nav-brand:hover { opacity: 0.9; }
        .nav-links {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        .nav-links a {
            color: #94a3b8;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 0.9rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            position: relative;
        }
        .nav-links a:hover {
            color: #fff;
            background: rgba(139, 92, 246, 0.08);
        }
        .nav-links a.active {
            color: #c4b5fd;
            background: rgba(139, 92, 246, 0.12);
        }
        .nav-right {
            display: flex;
            gap: 0.8rem;
            align-items: center;
        }
        .nav-cart {
            position: relative;
            color: #94a3b8;
            font-size: 1.1rem;
            padding: 0.6rem 0.8rem;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .nav-cart:hover {
            color: #fff;
            background: rgba(139, 92, 246, 0.1);
        }
        .nav-cart .badge {
            position: absolute;
            top: 2px;
            right: 0;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(139, 92, 246, 0.4);
        }

        /* Buttons */
        .btn {
            padding: 0.65rem 1.5rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.9rem;
            font-family: inherit;
        }
        .btn-outline {
            background: transparent;
            color: #94a3b8;
            border: 1px solid rgba(148, 163, 184, 0.2);
        }
        .btn-outline:hover {
            color: #fff;
            background: rgba(139, 92, 246, 0.1);
            border-color: rgba(139, 92, 246, 0.3);
        }
        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.25);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.35);
        }
        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        .btn-danger:hover {
            background: #ef4444;
            color: #fff;
            border-color: transparent;
        }
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
        }
        .btn-sm { padding: 0.4rem 1rem; font-size: 0.85rem; border-radius: 8px; }

        /* Dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            color: #94a3b8;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .dropdown-toggle:hover {
            background: rgba(139, 92, 246, 0.1);
            color: #fff;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            right: 0;
            background: rgba(20, 20, 35, 0.98);
            border: 1px solid rgba(139, 92, 246, 0.15);
            border-radius: 12px;
            min-width: 220px;
            padding: 0.5rem;
            z-index: 1001;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            animation: dropdownIn 0.2s ease;
        }
        @keyframes dropdownIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.7rem 1rem;
            color: #cbd5e1;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.9rem;
            gap: 0.7rem;
        }
        .dropdown-item:hover {
            background: rgba(139, 92, 246, 0.12);
            color: #fff;
        }
        .dropdown-item i { width: 18px; text-align: center; font-size: 0.85rem; color: #8b5cf6; }
        .dropdown-divider {
            height: 1px;
            background: rgba(139, 92, 246, 0.1);
            margin: 0.3rem 0.5rem;
        }

        /* Main Content */
        .main-content {
            margin-top: 70px;
            flex: 1;
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            backdrop-filter: blur(10px);
        }
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
        }
        .alert-error, .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
        }
        .alert-warning {
            background: rgba(251, 191, 36, 0.1);
            border: 1px solid rgba(251, 191, 36, 0.2);
            color: #fbbf24;
        }
        .alert-info {
            background: rgba(139, 92, 246, 0.1);
            border: 1px solid rgba(139, 92, 246, 0.2);
            color: #a78bfa;
        }

        /* =============================== */
        /* FOOTER                          */
        /* =============================== */
        footer.main-footer {
            background: #060609;
            border-top: 1px solid rgba(139, 92, 246, 0.08);
            padding: 5rem 8% 10rem;
            margin-top: auto;
        }
        .footer-content {
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }
        .footer-section h4 {
            color: #e2e8f0;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .footer-section ul { list-style: none; }
        .footer-section ul li { margin-bottom: 0.8rem; }
        .footer-section a {
            color: #64748b;
            transition: all 0.3s;
            font-size: 0.9rem;
        }
        .footer-section a:hover {
            color: #a78bfa;
            padding-left: 5px;
        }
        .footer-brand { margin-bottom: 1.5rem; }
        .footer-brand h3 {
            font-size: 2rem;
            margin-bottom: 0.8rem;
            background: linear-gradient(135deg, #fff 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 900;
            letter-spacing: -0.5px;
        }
        .footer-brand p { color: #4b5563; margin-bottom: 1.5rem; font-size: 0.95rem; line-height: 1.6; }
        .social-links { display: flex; gap: 0.8rem; }
        .social-links a {
            width: 42px;
            height: 42px;
            background: rgba(139, 92, 246, 0.08);
            border: 1px solid rgba(139, 92, 246, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.3s;
            font-size: 1rem;
        }
        .social-links a:hover {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            border-color: transparent;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        }
        .footer-bottom {
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid rgba(139, 92, 246, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .copyright { color: #374151; font-size: 0.85rem; }
        .payment-methods { display: flex; gap: 1.2rem; align-items: center; }
        .payment-methods i { font-size: 1.8rem; color: #374151; transition: color 0.3s; }
        .payment-methods i:hover { color: #64748b; }

        /* =============================== */
        /* CARDS                           */
        /* =============================== */
        .card {
            background: rgba(20, 20, 40, 0.6);
            border-radius: 16px;
            border: 1px solid rgba(139, 92, 246, 0.1);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backdrop-filter: blur(10px);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 60px rgba(139, 92, 246, 0.06);
            border-color: rgba(139, 92, 246, 0.25);
        }

        /* =============================== */
        /* FORMS                           */
        /* =============================== */
        .form-group { margin-bottom: 1.5rem; }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #cbd5e1;
            font-size: 0.9rem;
        }
        .form-control {
            width: 100%;
            padding: 0.85rem 1rem;
            background: rgba(15, 15, 30, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.15);
            border-radius: 10px;
            color: #fff;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            background: rgba(20, 20, 40, 0.8);
        }
        .form-control::placeholder { color: #4b5563; }
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
        .form-error {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 0.4rem;
        }
        textarea.form-control { min-height: 80px; resize: vertical; }

        /* =============================== */
        /* TABLE                           */
        /* =============================== */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid rgba(139, 92, 246, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(139, 92, 246, 0.06);
        }
        th {
            background: rgba(139, 92, 246, 0.06);
            font-weight: 700;
            color: #c4b5fd;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        tr:hover { background: rgba(139, 92, 246, 0.03); }

        /* =============================== */
        /* MOBILE                          */
        /* =============================== */
        .mobile-menu-toggle { display: none; cursor: pointer; font-size: 1.3rem; color: #94a3b8; padding: 0.5rem; }
        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: rgba(8, 8, 13, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
            padding: 1.5rem 5%;
            z-index: 999;
            animation: slideDown 0.3s ease;
        }
        .mobile-menu.open { display: block; }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .mobile-menu a {
            display: block;
            padding: 0.8rem 0;
            color: #94a3b8;
            font-weight: 600;
            border-bottom: 1px solid rgba(139, 92, 246, 0.05);
        }
        .mobile-menu a.active { color: #c4b5fd; }

        @media (max-width: 968px) {
            .nav-links { display: none; }
            .mobile-menu-toggle { display: block; }
            .footer-content { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .footer-content { grid-template-columns: 1fr; }
            .nav-container { height: 60px; }
            .main-content { margin-top: 60px; }
        }

        @yield('styles')
    </style>
    @stack('head')
</head>
<body>

    <nav class="main-nav" id="main-nav">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-brand">KEYZONE</a>

            <div class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home" style="margin-right: 0.3rem; font-size: 0.85rem;"></i> Accueil
                </a>
                <a href="{{ route('games.index') }}" class="{{ request()->routeIs('games.*') ? 'active' : '' }}">
                    <i class="fas fa-gamepad" style="margin-right: 0.3rem; font-size: 0.85rem;"></i> Jeux
                </a>
            </div>

            <div class="nav-right">
                <div class="mobile-menu-toggle" onclick="document.getElementById('mobile-menu').classList.toggle('open')">
                    <i class="fas fa-bars"></i>
                </div>

                @auth
                    <a href="{{ route('panier.index') }}" class="nav-cart">
                        <i class="fas fa-shopping-cart"></i>
                        @php
                            $panierCount = auth()->user()->panier?->nombre_articles ?? 0;
                        @endphp
                        @if($panierCount > 0)
                            <span class="badge">{{ $panierCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown">
                        <div class="dropdown-toggle">
                            <div style="width: 30px; height: 30px; border-radius: 8px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">{{ strtoupper(substr(Auth::user()->username, 0, 2)) }}</div>
                            {{ Auth::user()->username }}
                            <i class="fas fa-chevron-down" style="font-size: 0.65rem; color: #64748b;"></i>
                        </div>
                        <div class="dropdown-menu">
                            <a href="{{ route('profil.index') }}" class="dropdown-item">
                                <i class="fas fa-user"></i> Mon profil
                            </a>
                            <a href="{{ route('commandes.index') }}" class="dropdown-item">
                                <i class="fas fa-box"></i> Mes commandes
                            </a>
                            @if(Auth::user()->isAdmin())
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                    <i class="fas fa-cog"></i> <span style="color: #a78bfa;">Administration</span>
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt" style="color: #f87171;"></i> <span style="color: #f87171;">Deconnexion</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Se connecter</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Mobile menu --}}
    <div class="mobile-menu" id="mobile-menu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
        <a href="{{ route('games.index') }}" class="{{ request()->routeIs('games.*') ? 'active' : '' }}">Jeux</a>
        @auth
            <a href="{{ route('panier.index') }}">Panier</a>
            <a href="{{ route('profil.index') }}">Mon profil</a>
            <a href="{{ route('commandes.index') }}">Mes commandes</a>
        @else
            <a href="{{ route('login') }}">Se connecter</a>
            <a href="{{ route('register') }}">S'inscrire</a>
        @endauth
    </div>

    <main class="main-content">
        @if(session('success'))
            <div style="max-width: 1400px; margin: 1rem auto; padding: 0 5%;">
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div style="max-width: 1400px; margin: 1rem auto; padding: 0 5%;">
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-brand">
                    <h3>KEYZONE</h3>
                    <p>Votre marketplace de confiance pour l'achat de cles de jeux video dematerialises, au meilleur prix.</p>
                </div>
                <div class="social-links">
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Discord"><i class="fab fa-discord"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Entreprise</h4>
                <ul>
                    <li><a href="#">A propos</a></li>
                    <li><a href="#">Comment ca marche</a></li>
                    <li><a href="#">Garantie</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">CGV</a></li>
                    <li><a href="#">Confidentialite</a></li>
                    <li><a href="#">Remboursement</a></li>
                    <li><a href="#">Cookies</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Plateformes</h4>
                <ul>
                    <li><a href="{{ route('games.index') }}?plateforme=pc"><i class="fas fa-desktop" style="width: 18px; margin-right: 0.3rem;"></i> PC</a></li>
                    <li><a href="{{ route('games.index') }}?plateforme=xbox"><i class="fab fa-xbox" style="width: 18px; margin-right: 0.3rem;"></i> Xbox</a></li>
                    <li><a href="{{ route('games.index') }}?plateforme=playstation"><i class="fab fa-playstation" style="width: 18px; margin-right: 0.3rem;"></i> PlayStation</a></li>
                    <li><a href="{{ route('games.index') }}?plateforme=switch"><i class="fas fa-gamepad" style="width: 18px; margin-right: 0.3rem;"></i> Switch</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="copyright">&copy; {{ date('Y') }} KEYZONE. Tous droits reserves.</p>
            <div class="payment-methods">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-apple-pay"></i>
                <i class="fab fa-cc-google-pay"></i>
                <i class="fab fa-cc-stripe" style="color: #635bff;"></i>
            </div>
        </div>
    </footer>

    <script>
        // CSRF token for AJAX
        window.csrfToken = '{{ csrf_token() }}';

        // Navbar scroll effect
        (function() {
            const nav = document.getElementById('main-nav');
            let ticking = false;
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        nav.classList.toggle('scrolled', window.scrollY > 20);
                        ticking = false;
                    });
                    ticking = true;
                }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
