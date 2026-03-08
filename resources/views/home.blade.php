<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KEYZONE - Les meilleurs jeux, au meilleur prix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0a0f;
            color: #ffffff;
            line-height: 1.6;
        }

        nav {
            background: rgba(10, 10, 15, 0.98);
            padding: 1rem 5%;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 0.95rem;
            padding: 0.5rem 0;
            border-bottom: 2px solid transparent;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #a78bfa;
            border-bottom-color: #a78bfa;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.7rem 1.8rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-outline {
            background: transparent;
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #a78bfa;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .hero {
            margin-top: 70px;
            padding: 6rem 5%;
            background: linear-gradient(135deg, rgba(88, 28, 135, 0.3) 0%, rgba(30, 27, 75, 0.4) 50%, rgba(15, 15, 30, 0.6) 100%);
            position: relative;
            overflow: hidden;
            min-height: 600px;
            display: flex;
            align-items: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1578632767115-351597cf2477?w=1920&h=1080&fit=crop') center/cover;
            opacity: 0.15;
            z-index: 0;
        }

        .hero-content {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(139, 92, 246, 0.2);
            color: #c4b5fd;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(139, 92, 246, 0.4);
            font-weight: 500;
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #c4b5fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .hero p {
            font-size: 1.2rem;
            color: #a1a1aa;
            margin-bottom: 2.5rem;
            max-width: 600px;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .hero-note {
            color: #71717a;
            font-size: 0.9rem;
            font-style: italic;
        }

        .section {
            padding: 5rem 5%;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .see-all {
            color: #a78bfa;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .see-all:hover {
            color: #c4b5fd;
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .game-card {
            background: linear-gradient(135deg, rgba(30, 33, 52, 0.9) 0%, rgba(15, 15, 30, 0.95) 100%);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid rgba(139, 92, 246, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.3);
            border-color: rgba(139, 92, 246, 0.4);
        }

        .game-image-container {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .game-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .game-card:hover .game-image {
            transform: scale(1.05);
        }

        .game-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(139, 92, 246, 0.9);
            color: #ffffff;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            z-index: 1;
        }

        .game-info {
            padding: 1.5rem;
        }

        .game-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .game-price {
            font-size: 1.5rem;
            color: #a78bfa;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .btn-add-cart {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .why-us {
            background: linear-gradient(135deg, rgba(88, 28, 135, 0.15) 0%, rgba(15, 15, 30, 1) 100%);
            padding: 6rem 5%;
            position: relative;
            overflow: hidden;
        }

        .why-us::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1538481199705-c710c4e965fc?w=1920&h=1080&fit=crop') center/cover;
            opacity: 0.05;
        }

        .why-container {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .why-header {
            margin-bottom: 4rem;
        }

        .why-header h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .why-header p {
            color: #a1a1aa;
            font-size: 1.1rem;
        }

        .features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .feature-image {
            text-align: center;
        }

        .feature-image img {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 40px rgba(139, 92, 246, 0.3));
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .feature-item {
            background: rgba(30, 33, 52, 0.7);
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid rgba(139, 92, 246, 0.2);
            transition: all 0.3s;
        }

        .feature-item:hover {
            border-color: rgba(139, 92, 246, 0.4);
            transform: translateX(10px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
        }

        .feature-item h3 {
            color: #a78bfa;
            margin-bottom: 1rem;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .feature-item p {
            color: #a1a1aa;
            line-height: 1.6;
        }

        .testimonials {
            padding: 5rem 5%;
            background: #0a0a0f;
        }

        .testimonials-header {
            max-width: 1400px;
            margin: 0 auto 3rem;
        }

        .testimonials-header h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .testimonials-header p {
            color: #a1a1aa;
            font-size: 1.1rem;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .testimonial-card {
            background: rgba(30, 33, 52, 0.7);
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid rgba(139, 92, 246, 0.2);
            transition: all 0.3s;
        }

        .testimonial-card:hover {
            border-color: rgba(139, 92, 246, 0.4);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
        }

        .testimonial-card.featured {
            background: rgba(139, 92, 246, 0.1);
            border: 2px solid rgba(139, 92, 246, 0.4);
            transform: scale(1.05);
        }

        .testimonial-text {
            color: #a1a1aa;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #ffffff;
        }

        .author-name {
            font-weight: 600;
            color: #ffffff;
        }

        .stars {
            color: #fbbf24;
            letter-spacing: 2px;
        }

        footer {
            background: rgba(10, 10, 15, 0.98);
            border-top: 1px solid rgba(139, 92, 246, 0.2);
            padding: 4rem 5% 2rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-section h4 {
            color: #a78bfa;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.8rem;
        }

        .footer-section a {
            color: #71717a;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: #a78bfa;
        }

        .footer-brand {
            margin-bottom: 1.5rem;
        }

        .footer-brand h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
        }

        .footer-brand p {
            color: #71717a;
            margin-bottom: 1.5rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            background: rgba(139, 92, 246, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a78bfa;
            transition: all 0.3s;
            font-size: 1.2rem;
        }

        .social-links a:hover {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.3);
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid rgba(139, 92, 246, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .copyright {
            color: #71717a;
            font-size: 0.9rem;
        }

        .payment-methods {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .payment-methods i {
            font-size: 2.2rem;
            color: #71717a;
            transition: color 0.3s;
        }

        .payment-methods i:hover {
            color: #a78bfa;
        }

        @media (max-width: 1200px) {
            .games-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .testimonial-card.featured {
                transform: none;
            }
        }

        @media (max-width: 968px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
            }

            .nav-links {
                display: none;
            }
        }

        @media (max-width: 600px) {
            .hero h1 {
                font-size: 2rem;
            }

            .games-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-container">
            <div class="nav-links">
                <a href="{{ route('home') }}" class="active">Accueil</a>
                <a href="{{ route('games.index') }}">Jeux</a>
            </div>
            <div class="auth-buttons">
                @auth
                    <span style="color: white; display: flex; align-items: center; margin-right: 1rem;">{{ Auth::user()->username ?? Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="btn btn-outline" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Se connecter</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">+ de 1000 joueurs satisfait</div>
            <h1>LES MEILLEURS JEUX, AU MEILLEUR PRIX</h1>
            <p>Accès instantané aux meilleurs titres sur PC, Xbox, Switch et PlayStation.</p>
            <div class="hero-buttons">
                <a href="{{ route('games.index') }}" class="btn btn-primary">Voir les offres disponibles</a>
                <span class="hero-note">*Accès immédiat après paiement</span>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <h2 class="section-title">TENDANCES</h2>
            <a href="{{ route('games.index') }}" class="see-all">Voir plus</a>
        </div>
        <div class="games-grid">
            <div class="game-card">
                <div class="game-image-container">
                    <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1234560/header.jpg" alt="Bread & Fred" class="game-image">
                </div>
                <div class="game-info">
                    <h3 class="game-title">Bread & Fred</h3>
                    <div class="game-price">6,99 €</div>
                    <button class="btn-add-cart" onclick="addToCart('Bread & Fred')">
                        <i class="fas fa-shopping-cart"></i>
                        Ajouter au panier
                    </button>
                </div>
            </div>

            <div class="game-card">
                <div class="game-image-container">
                    <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1579700/header.jpg" alt="Slime Rancher 2" class="game-image">
                </div>
                <div class="game-info">
                    <h3 class="game-title">Slime Rancher 2</h3>
                    <div class="game-price">19,99 €</div>
                    <button class="btn-add-cart" onclick="addToCart('Slime Rancher 2')">
                        <i class="fas fa-shopping-cart"></i>
                        Ajouter au panier
                    </button>
                </div>
            </div>

            <div class="game-card">
                <div class="game-image-container">
                    <div class="game-badge">Incontournable</div>
                    <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/367520/header.jpg" alt="Hollow Knight" class="game-image">
                </div>
                <div class="game-info">
                    <h3 class="game-title">Hollow Knight</h3>
                    <div class="game-price">19,99 €</div>
                    <button class="btn-add-cart" onclick="addToCart('Hollow Knight')">
                        <i class="fas fa-shopping-cart"></i>
                        Ajouter au panier
                    </button>
                </div>
            </div>

            <div class="game-card">
                <div class="game-image-container">
                    <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/1072270/header.jpg" alt="Animal Crossing" class="game-image">
                </div>
                <div class="game-info">
                    <h3 class="game-title">Animal Crossing</h3>
                    <div class="game-price">39,99 €</div>
                    <button class="btn-add-cart" onclick="addToCart('Animal Crossing')">
                        <i class="fas fa-shopping-cart"></i>
                        Ajouter au panier
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="why-us">
        <div class="why-container">
            <div class="why-header">
                <h2>POURQUOI NOUS CHOISIR ?</h2>
                <p>Nous nous engageons à vous offrir la meilleure expérience d'achat de jeux vidéo en ligne.</p>
            </div>
            <div class="features">
                <div class="feature-image">
                    <img src="https://cdn-icons-png.flaticon.com/512/3407/3407025.png" alt="Gaming Character" style="max-width: 400px;">
                </div>
                <div class="feature-list">
                    <div class="feature-item">
                        <h3>Livraison instantanée</h3>
                        <p>Recevez votre clé d'activation immédiatement après le paiement, directement dans votre email et votre compte.</p>
                    </div>
                    <div class="feature-item">
                        <h3>Support 24/7</h3>
                        <p>Notre équipe d'assistance est disponible à tout moment pour répondre à vos questions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="testimonials-header">
            <h2>ILS NOUS FONT CONFIANCE</h2>
            <p>Des milliers de joueurs satisfaits à travers le monde, sur toutes les plateformes.</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <p class="testimonial-text">Achat effectué en moins de 2 minutes, la clé a fonctionné du premier coup sur Steam. Prix très compétitif et processus ultra simple. Je recommande vivement pour des achats rapides sans prise de tête.</p>
                <div class="testimonial-author">
                    <div class="author-info">
                        <div class="author-avatar">AT</div>
                        <span class="author-name">Axelle TEMPIER</span>
                    </div>
                    <div class="stars">★★★★★</div>
                </div>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">J'étais un peu méfiant au départ, mais tout s'est déroulé parfaitement. Paiement sécurisé, clé valide et téléchargement immédiat. Service sérieux.</p>
                <div class="testimonial-author">
                    <div class="author-info">
                        <div class="author-avatar">HB</div>
                        <span class="author-name">Hugo BAIGUE</span>
                    </div>
                    <div class="stars">★★★★★</div>
                </div>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">J'ai économisé presque 40 % par rapport aux plateformes classiques. Aucun problème à l'activation, tout est expliqué clairement. J'ai reçu ma clés en moins de 2 minutes.</p>
                <div class="testimonial-author">
                    <div class="author-info">
                        <div class="author-avatar">CP</div>
                        <span class="author-name">CLAUDE POUABOU</span>
                    </div>
                    <div class="stars">★★★★★</div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-brand">
                    <h3>KEYZONE</h3>
                    <p>Marketplace de clés de jeux dématérialisés.</p>
                </div>
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-discord"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Entreprise</h4>
                <ul>
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Comment ça marche</a></li>
                    <li><a href="#">Garantie</a></li>
                    <li><a href="#">Nous contacter</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Mentions légales</h4>
                <ul>
                    <li><a href="#">Conditions générales</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Politique de remboursement</a></li>
                    <li><a href="#">Politique des cookies</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Jeux populaires</h4>
                <ul>
                    <li><a href="#">PC</a></li>
                    <li><a href="#">XBox</a></li>
                    <li><a href="#">Switch</a></li>
                    <li><a href="#">PlayStation</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="copyright">© 2026 KEYZONE. Tous droits réservés.</p>
            <div class="payment-methods">
                <i class="fab fa-cc-apple-pay"></i>
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-google-pay"></i>
            </div>
        </div>
    </footer>

    <script>
        function addToCart(gameName) {
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    game: gameName
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(gameName + ' ajouté au panier !');
            })
            .catch(error => {
                console.error('Error:', error);
                alert(gameName + ' ajouté au panier !');
            });
        }
    </script>
</body>
</html>