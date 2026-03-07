<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tous les jeux - KEYZONE</title>
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
            background: rgba(10, 10, 15, 0.95);
            padding: 1rem 5%;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
            backdrop-filter: blur(10px);
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
            font-weight: 500;
            transition: color 0.3s;
            font-size: 0.95rem;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #8b5cf6;
        }

        .nav-links a.active {
            border-bottom: 2px solid #8b5cf6;
            padding-bottom: 0.2rem;
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
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .btn-primary {
            background: #8b5cf6;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #7c3aed;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
        }

        .breadcrumb {
            margin-top: 80px;
            padding: 1.5rem 5%;
            background: rgba(139, 92, 246, 0.05);
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
        }

        .breadcrumb-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .breadcrumb a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: #8b5cf6;
        }

        .breadcrumb span {
            margin: 0 0.5rem;
            color: #64748b;
        }

        .breadcrumb strong {
            color: #ffffff;
        }

        .page-header {
            padding: 3rem 5%;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(15, 15, 30, 1) 100%);
        }

        .page-header-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #ffffff 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-header p {
            color: #94a3b8;
            font-size: 1.1rem;
        }

        .filters {
            padding: 2rem 5%;
            background: rgba(15, 15, 30, 0.5);
        }

        .filters-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group {
            display: flex;
            gap: 0.5rem;
        }

        .filter-btn {
            padding: 0.6rem 1.2rem;
            background: rgba(30, 33, 52, 0.8);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 8px;
            color: #ffffff;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: rgba(139, 92, 246, 0.2);
            border-color: #8b5cf6;
        }

        .search-box {
            margin-left: auto;
            position: relative;
        }

        .search-box input {
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            background: rgba(30, 33, 52, 0.8);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 8px;
            color: #ffffff;
            width: 250px;
            font-size: 0.9rem;
        }

        .search-box input:focus {
            outline: none;
            border-color: #8b5cf6;
        }

        .search-box i {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        .games-section {
            padding: 3rem 5%;
        }

        .games-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .games-count {
            margin-bottom: 2rem;
            color: #94a3b8;
        }

        .games-count span {
            color: #8b5cf6;
            font-weight: 600;
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .game-card {
            background: linear-gradient(135deg, rgba(30, 33, 52, 0.8) 0%, rgba(15, 15, 30, 0.9) 100%);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid rgba(139, 92, 246, 0.1);
        }

        .game-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.2);
            border-color: rgba(139, 92, 246, 0.3);
        }

        .game-image-container {
            position: relative;
            overflow: hidden;
        }

        .game-image {
            width: 100%;
            height: 200px;
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
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
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
        }

        .game-price {
            font-size: 1.5rem;
            color: #8b5cf6;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .btn-add-cart {
            width: 100%;
            padding: 0.8rem;
            background: #8b5cf6;
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
            background: #7c3aed;
            transform: translateY(-2px);
        }

        footer {
            background: rgba(10, 10, 15, 0.95);
            border-top: 1px solid rgba(139, 92, 246, 0.1);
            padding: 2rem 5%;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            text-align: center;
            color: #64748b;
        }

        @media (max-width: 968px) {
            .games-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }

            .search-box input {
                width: 100%;
            }

            .nav-links {
                display: none;
            }
        }

        @media (max-width: 600px) {
            .games-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-container">
            <div class="nav-links">
                <a href="{{ route('home') }}">Accueil</a>
                <a href="{{ route('games.index') }}" class="active">Jeux</a>
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

    <div class="breadcrumb">
        <div class="breadcrumb-container">
            <a href="{{ route('home') }}">Accueil</a>
            <span>&gt;</span>
            <strong>Jeux</strong>
        </div>
    </div>

    <section class="page-header">
        <div class="page-header-content">
            <h1>Tous les jeux</h1>
            <p>Découvrez notre catalogue complet de jeux vidéo aux meilleurs prix</p>
        </div>
    </section>

    <section class="filters">
        <div class="filters-container">
            <div class="filter-group">
                <button class="filter-btn active">Tous</button>
                <button class="filter-btn">PC</button>
                <button class="filter-btn">Xbox</button>
                <button class="filter-btn">PlayStation</button>
                <button class="filter-btn">Switch</button>
            </div>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Rechercher un jeu...">
            </div>
        </div>
    </section>

    <section class="games-section">
        <div class="games-container">
            <div class="games-count">
                Affichage de <span>{{ count($games) }} jeux</span>
            </div>
            <div class="games-grid">
                @foreach($games as $game)
                    <div class="game-card">
                        <div class="game-image-container">
                            @if($game['badge'])
                                <div class="game-badge">{{ $game['badge'] }}</div>
                            @endif
                            <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" class="game-image">
                        </div>
                        <div class="game-info">
                            <h3 class="game-title">{{ $game['title'] }}</h3>
                            <div class="game-price">{{ $game['price'] }} €</div>
                            <a href="{{ route('products.show', ['slug' => $game['slug']]) }}" class="btn-add-cart">
                                <i class="fas fa-shopping-cart"></i>
                                Voir le jeu
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <p>&copy; 2026 KEYZONE. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>