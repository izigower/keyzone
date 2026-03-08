@extends('layouts.app')

@section('title', 'Tous les jeux - KEYZONE')

@section('styles')
<style>
    .page-hero {
        padding: 3rem 5%;
        background: linear-gradient(180deg, rgba(139, 92, 246, 0.08) 0%, transparent 100%);
        border-bottom: 1px solid rgba(139, 92, 246, 0.06);
    }
    .page-hero-inner {
        max-width: 1400px;
        margin: 0 auto;
    }
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: #64748b;
    }
    .breadcrumb a { color: #64748b; transition: color 0.3s; }
    .breadcrumb a:hover { color: #a78bfa; }
    .breadcrumb .sep { color: #374151; }
    .breadcrumb .current { color: #cbd5e1; font-weight: 600; }
    .page-hero h1 {
        font-size: 2.5rem;
        font-weight: 900;
        letter-spacing: -1px;
        background: linear-gradient(135deg, #fff 0%, #c4b5fd 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }
    .page-hero p { color: #64748b; font-size: 1rem; }

    /* Filters */
    .filters-bar {
        padding: 1.5rem 5%;
        background: rgba(8, 8, 13, 0.5);
        border-bottom: 1px solid rgba(139, 92, 246, 0.05);
        position: sticky;
        top: 70px;
        z-index: 50;
        backdrop-filter: blur(20px);
    }
    .filters-inner {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }
    .filter-group {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
    }
    .filter-chip {
        padding: 0.5rem 1.1rem;
        background: rgba(139, 92, 246, 0.06);
        border: 1px solid rgba(139, 92, 246, 0.1);
        border-radius: 8px;
        color: #94a3b8;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    .filter-chip:hover {
        background: rgba(139, 92, 246, 0.15);
        border-color: rgba(139, 92, 246, 0.25);
        color: #c4b5fd;
    }
    .filter-chip.active {
        background: rgba(139, 92, 246, 0.2);
        border-color: #8b5cf6;
        color: #fff;
    }
    .search-box {
        margin-left: auto;
        position: relative;
    }
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #4b5563;
        font-size: 0.85rem;
    }
    .search-box input {
        padding-left: 2.5rem;
        width: 280px;
        background: rgba(15, 15, 30, 0.6);
        border: 1px solid rgba(139, 92, 246, 0.1);
    }

    /* Games grid - reusing same card style */
    .games-section {
        padding: 2.5rem 5%;
    }
    .games-section-inner {
        max-width: 1400px;
        margin: 0 auto;
    }
    .result-count {
        margin-bottom: 1.5rem;
        color: #64748b;
        font-size: 0.9rem;
    }
    .result-count span { color: #a78bfa; font-weight: 700; }
    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    .game-card {
        background: rgba(20, 20, 40, 0.6);
        border-radius: 16px;
        border: 1px solid rgba(139, 92, 246, 0.08);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        backdrop-filter: blur(10px);
    }
    .game-card:hover {
        transform: translateY(-6px);
        border-color: rgba(139, 92, 246, 0.3);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 60px rgba(139, 92, 246, 0.06);
    }
    .game-card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .game-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .game-card:hover .game-card-image img { transform: scale(1.08); }
    .game-card-badge {
        position: absolute;
        top: 0.8rem;
        padding: 0.25rem 0.7rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 700;
        z-index: 2;
        backdrop-filter: blur(10px);
    }
    .badge-left { left: 0.8rem; }
    .badge-right { right: 0.8rem; }
    .badge-promo { background: rgba(239, 68, 68, 0.9); color: #fff; }
    .badge-new { background: rgba(139, 92, 246, 0.9); color: #fff; }
    .game-card-stock {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        backdrop-filter: blur(3px);
    }
    .game-card-stock span { color: #f87171; font-weight: 700; font-size: 1rem; }
    .game-card-body { padding: 1.2rem 1.3rem 1.5rem; }
    .game-card-platform {
        font-size: 0.78rem;
        color: #4b5563;
        margin-bottom: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .game-card-meta { color: #4b5563; font-size: 0.78rem; }
    .game-card-title {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.7rem;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .game-card-title a { color: #fff; transition: color 0.3s; }
    .game-card-title a:hover { color: #c4b5fd; }
    .game-card-pricing {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    .game-card-price { font-size: 1.35rem; font-weight: 800; color: #a78bfa; }
    .game-card-old-price { font-size: 0.85rem; color: #4b5563; text-decoration: line-through; }
    .game-card-discount {
        background: rgba(239, 68, 68, 0.12);
        color: #f87171;
        padding: 0.15rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-left: auto;
    }
    .game-card-btn {
        width: 100%;
        padding: 0.75rem;
        background: rgba(139, 92, 246, 0.12);
        border: 1px solid rgba(139, 92, 246, 0.2);
        color: #c4b5fd;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    .game-card-btn:hover {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: #fff;
        border-color: transparent;
        box-shadow: 0 5px 20px rgba(139, 92, 246, 0.3);
    }

    /* Pagination */
    .pagination-container {
        margin-top: 3rem;
        display: flex;
        justify-content: center;
    }
    .pagination-container nav { display: flex; gap: 0.3rem; }
    .pagination-container .relative.inline-flex { display: none; }
    .pagination-container span[aria-current], .pagination-container a {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s;
    }
    .pagination-container span[aria-current] {
        background: #8b5cf6;
        color: #fff;
    }

    /* Empty state */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 5rem 2rem;
        color: #4b5563;
    }
    .empty-state i { font-size: 3.5rem; margin-bottom: 1rem; display: block; color: #8b5cf6; }

    @media (max-width: 768px) {
        .page-hero h1 { font-size: 2rem; }
        .search-box { margin-left: 0; width: 100%; }
        .search-box input { width: 100%; }
        .filters-bar { top: 60px; }
    }
</style>
@endsection

@section('content')
    <div class="page-hero">
        <div class="page-hero-inner">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Accueil</a>
                <span class="sep"><i class="fas fa-chevron-right" style="font-size: 0.65rem;"></i></span>
                <span class="current">Jeux</span>
            </div>
            <h1>Tous les jeux</h1>
            <p>Decouvrez notre catalogue complet de jeux video aux meilleurs prix</p>
        </div>
    </div>

    <div class="filters-bar">
        <form method="GET" action="{{ route('games.index') }}" class="filters-inner">
            <div class="filter-group">
                <a href="{{ route('games.index') }}" class="filter-chip {{ !request('plateforme') && !request('categorie') ? 'active' : '' }}">Tous</a>
                @foreach($plateformes as $p)
                    <a href="{{ route('games.index', ['plateforme' => $p->slug]) }}" class="filter-chip {{ request('plateforme') == $p->slug ? 'active' : '' }}">{{ $p->nom }}</a>
                @endforeach
            </div>
            <div class="filter-group">
                @foreach($categories as $cat)
                    <a href="{{ route('games.index', ['categorie' => $cat->slug]) }}" class="filter-chip {{ request('categorie') == $cat->slug ? 'active' : '' }}">{{ $cat->nom }} <span style="opacity: 0.6;">({{ $cat->produits_count }})</span></a>
                @endforeach
            </div>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un jeu..." class="form-control">
            </div>
        </form>
    </div>

    <section class="games-section">
        <div class="games-section-inner">
            <div class="result-count">
                <span>{{ $produits->total() }} jeux</span> trouves
            </div>
            <div class="games-grid">
                @forelse($produits as $produit)
                    <div class="game-card">
                        <a href="{{ route('games.show', $produit->slug) }}" style="display: block;">
                            <div class="game-card-image">
                                @if($produit->badge)
                                    <span class="game-card-badge badge-new badge-left">{{ $produit->badge }}</span>
                                @endif
                                @if($produit->reduction > 0)
                                    <span class="game-card-badge badge-promo badge-right">-{{ $produit->reduction }}%</span>
                                @endif
                                <img src="{{ $produit->image ?? 'https://via.placeholder.com/460x215/1e2134/8b5cf6?text=' . urlencode($produit->nom) }}" alt="{{ $produit->nom }}">
                                @if($produit->stock_reel < 1)
                                    <div class="game-card-stock">
                                        <span><i class="fas fa-ban"></i> Rupture de stock</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                        <div class="game-card-body">
                            <div class="game-card-platform">
                                <i class="fas fa-desktop"></i>
                                {{ $produit->plateforme->nom ?? '' }}
                                <span class="game-card-meta">&bull; {{ $produit->categorie->nom ?? '' }}</span>
                            </div>
                            <div class="game-card-title">
                                <a href="{{ route('games.show', $produit->slug) }}">{{ $produit->nom }}</a>
                            </div>
                            <div class="game-card-pricing">
                                <span class="game-card-price">{{ number_format($produit->prix, 2, ',', ' ') }} &euro;</span>
                                @if($produit->prix_original)
                                    <span class="game-card-old-price">{{ number_format($produit->prix_original, 2, ',', ' ') }} &euro;</span>
                                    <span class="game-card-discount">-{{ $produit->reduction }}%</span>
                                @endif
                            </div>
                            <a href="{{ route('games.show', $produit->slug) }}" class="game-card-btn">
                                <i class="fas fa-eye"></i> Voir le jeu
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-search"></i>
                        <p style="font-size: 1.1rem;">Aucun jeu trouve.</p>
                    </div>
                @endforelse
            </div>
            <div class="pagination-container">
                {{ $produits->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
@endsection
