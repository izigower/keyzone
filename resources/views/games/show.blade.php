@extends('layouts.app')

@section('title', $produit->nom . ' - KEYZONE')

@section('styles')
<style>
    .product-hero {
        padding: 1.5rem 5%;
        background: rgba(139, 92, 246, 0.03);
        border-bottom: 1px solid rgba(139, 92, 246, 0.05);
    }
    .breadcrumb {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: #64748b;
    }
    .breadcrumb a { color: #64748b; transition: color 0.3s; }
    .breadcrumb a:hover { color: #a78bfa; }
    .breadcrumb .sep { color: #374151; font-size: 0.65rem; }
    .breadcrumb .current { color: #cbd5e1; font-weight: 600; }

    .product-main {
        padding: 3rem 5%;
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 4rem;
    }
    .product-image-container {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(139, 92, 246, 0.1);
        position: relative;
        background: #0d0d1a;
    }
    .product-image-container img {
        width: 100%;
        height: auto;
        display: block;
    }
    .product-image-container .oos-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(3px);
    }
    .product-image-container .oos-overlay span {
        color: #f87171;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .product-description {
        margin-top: 2rem;
        background: rgba(20, 20, 40, 0.4);
        padding: 2rem;
        border-radius: 16px;
        border: 1px solid rgba(139, 92, 246, 0.08);
    }
    .product-description h3 {
        color: #a78bfa;
        margin-bottom: 1rem;
        font-size: 1.1rem;
        font-weight: 700;
    }
    .product-description p {
        color: #94a3b8;
        line-height: 1.8;
    }

    /* Right column */
    .product-tags {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
        margin-bottom: 0.8rem;
    }
    .product-tag {
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }
    .product-tag-platform { background: rgba(139, 92, 246, 0.12); color: #c4b5fd; }
    .product-tag-category { background: rgba(30, 33, 52, 0.8); color: #94a3b8; }
    .product-tag-pegi { background: rgba(239, 68, 68, 0.12); color: #f87171; }

    .product-title {
        font-size: 2.5rem;
        font-weight: 900;
        letter-spacing: -1px;
        margin-bottom: 1rem;
        line-height: 1.1;
    }
    .product-badge-inline {
        display: inline-block;
        background: rgba(139, 92, 246, 0.12);
        color: #c4b5fd;
        padding: 0.3rem 0.8rem;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-bottom: 1.2rem;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }
    .product-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    .product-rating .stars { color: #fbbf24; }
    .product-rating .count { color: #64748b; font-size: 0.9rem; }

    /* Price box */
    .price-box {
        background: rgba(20, 20, 40, 0.5);
        padding: 2rem;
        border-radius: 16px;
        border: 1px solid rgba(139, 92, 246, 0.1);
        margin-bottom: 2rem;
    }
    .price-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.2rem;
    }
    .price-current {
        font-size: 2.5rem;
        color: #a78bfa;
        font-weight: 900;
        letter-spacing: -1px;
    }
    .price-original {
        font-size: 1.2rem;
        color: #4b5563;
        text-decoration: line-through;
    }
    .price-discount {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.9rem;
    }
    .stock-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.2rem;
        font-size: 0.9rem;
    }
    .stock-info.in-stock { color: #34d399; }
    .stock-info.out-of-stock { color: #f87171; }

    .buy-btn {
        width: 100%;
        padding: 1.2rem;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-family: inherit;
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
        text-decoration: none;
        text-align: center;
    }
    .buy-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(139, 92, 246, 0.4);
    }

    /* Features grid */
    .features-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.8rem;
    }
    .feature-item {
        background: rgba(20, 20, 40, 0.3);
        padding: 1rem;
        border-radius: 10px;
        text-align: center;
        border: 1px solid rgba(139, 92, 246, 0.06);
        transition: all 0.3s;
    }
    .feature-item:hover {
        border-color: rgba(139, 92, 246, 0.15);
        background: rgba(30, 25, 60, 0.3);
    }
    .feature-item i {
        color: #8b5cf6;
        font-size: 1.2rem;
        margin-bottom: 0.4rem;
        display: block;
    }
    .feature-item span { color: #64748b; font-size: 0.85rem; }

    /* Comments section */
    .comments-section {
        padding: 4rem 5%;
        background: rgba(8, 8, 13, 0.5);
    }
    .comments-inner {
        max-width: 1400px;
        margin: 0 auto;
    }
    .comments-inner h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 2rem;
    }
    .comment-form-box {
        background: rgba(20, 20, 40, 0.4);
        padding: 2rem;
        border-radius: 16px;
        border: 1px solid rgba(139, 92, 246, 0.08);
        margin-bottom: 2rem;
    }
    .comment-form-box h3 {
        color: #a78bfa;
        margin-bottom: 1rem;
        font-size: 1rem;
    }
    .comment-card {
        background: rgba(20, 20, 40, 0.3);
        padding: 1.5rem;
        border-radius: 14px;
        border: 1px solid rgba(139, 92, 246, 0.06);
        margin-bottom: 1rem;
        transition: all 0.3s;
    }
    .comment-card:hover { border-color: rgba(139, 92, 246, 0.12); }
    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
    }
    .comment-user {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    .comment-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.8rem;
        color: #fff;
    }
    .comment-username { font-weight: 600; font-size: 0.95rem; }
    .comment-date { font-size: 0.8rem; color: #4b5563; }
    .comment-stars { color: #fbbf24; font-size: 0.8rem; }
    .comment-text { color: #94a3b8; line-height: 1.7; }

    /* Similar games */
    .similar-section {
        padding: 4rem 5%;
    }
    .similar-inner {
        max-width: 1400px;
        margin: 0 auto;
    }
    .similar-inner h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 2rem;
    }
    .similar-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }
    .similar-card {
        background: rgba(20, 20, 40, 0.5);
        border-radius: 14px;
        border: 1px solid rgba(139, 92, 246, 0.08);
        overflow: hidden;
        transition: all 0.4s;
    }
    .similar-card:hover {
        transform: translateY(-5px);
        border-color: rgba(139, 92, 246, 0.2);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }
    .similar-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .similar-card:hover img { transform: scale(1.05); }
    .similar-card-body { padding: 1rem 1.2rem; }
    .similar-card-body h3 {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }
    .similar-card-body h3 a { color: #fff; transition: color 0.3s; }
    .similar-card-body h3 a:hover { color: #c4b5fd; }
    .similar-card-body .price { color: #a78bfa; font-weight: 700; }

    @media (max-width: 968px) {
        .product-main { grid-template-columns: 1fr; gap: 2rem; }
        .product-title { font-size: 2rem; }
        .similar-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .similar-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
    <div class="product-hero">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="sep"><i class="fas fa-chevron-right"></i></span>
            <a href="{{ route('games.index') }}">Jeux</a>
            <span class="sep"><i class="fas fa-chevron-right"></i></span>
            <span class="current">{{ $produit->nom }}</span>
        </div>
    </div>

    <div class="product-main">
        <!-- Image -->
        <div>
            <div class="product-image-container">
                <img src="{{ $produit->image ?? 'https://via.placeholder.com/600x340/1e2134/8b5cf6?text=' . urlencode($produit->nom) }}" alt="{{ $produit->nom }}">
                @if($produit->stock_reel < 1)
                    <div class="oos-overlay"><span><i class="fas fa-ban"></i> Rupture de stock</span></div>
                @endif
            </div>
            @if($produit->description)
                <div class="product-description">
                    <h3><i class="fas fa-info-circle" style="margin-right: 0.3rem;"></i> Description</h3>
                    <p>{{ $produit->description }}</p>
                </div>
            @endif
        </div>

        <!-- Info -->
        <div>
            <div class="product-tags">
                <span class="product-tag product-tag-platform">{{ $produit->plateforme->nom ?? '' }}</span>
                <span class="product-tag product-tag-category">{{ $produit->categorie->nom ?? '' }}</span>
                @if($produit->age_rating > 0)
                    <span class="product-tag product-tag-pegi">PEGI {{ $produit->age_rating }}</span>
                @endif
            </div>

            <h1 class="product-title">{{ $produit->nom }}</h1>

            @if($produit->badge)
                <div class="product-badge-inline">{{ $produit->badge }}</div>
            @endif

            @if($produit->note_moyenne > 0)
                <div class="product-rating">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa{{ $i <= round($produit->note_moyenne) ? 's' : 'r' }} fa-star"></i>
                        @endfor
                    </div>
                    <span class="count">({{ $produit->commentaires->count() }} avis)</span>
                </div>
            @endif

            <div class="price-box">
                <div class="price-row">
                    <span class="price-current">{{ number_format($produit->prix, 2, ',', ' ') }} &euro;</span>
                    @if($produit->prix_original)
                        <span class="price-original">{{ number_format($produit->prix_original, 2, ',', ' ') }} &euro;</span>
                        <span class="price-discount">-{{ $produit->reduction }}%</span>
                    @endif
                </div>
                <div class="stock-info {{ $produit->stock_reel > 0 ? 'in-stock' : 'out-of-stock' }}">
                    <i class="fas fa-{{ $produit->stock_reel > 0 ? 'check-circle' : 'times-circle' }}"></i>
                    {{ $produit->stock_reel > 0 ? $produit->stock_reel . ' cle(s) disponible(s)' : 'Rupture de stock' }}
                </div>

                @auth
                    @if($produit->stock_reel > 0)
                        <form action="{{ route('panier.ajouter') }}" method="POST">
                            @csrf
                            <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                            <input type="hidden" name="quantite" value="1">
                            <button type="submit" class="buy-btn">
                                <i class="fas fa-shopping-cart"></i> Ajouter au panier
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="buy-btn">
                        <i class="fas fa-sign-in-alt"></i> Connectez-vous pour acheter
                    </a>
                @endauth
            </div>

            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-bolt"></i>
                    <span>Livraison instantanee</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>Paiement securise</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-headset"></i>
                    <span>Support 24/7</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-key"></i>
                    <span>Cle officielle</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments -->
    <section class="comments-section">
        <div class="comments-inner">
            <h2>Avis des joueurs ({{ $produit->commentaires->count() }})</h2>

            @auth
                <div class="comment-form-box">
                    <h3><i class="fas fa-pen" style="margin-right: 0.3rem;"></i> Laisser un avis</h3>
                    <form action="{{ route('commentaires.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                        <div class="form-group">
                            <label>Note</label>
                            <div style="display: flex; gap: 0.5rem;">
                                @for($i = 1; $i <= 5; $i++)
                                    <label style="cursor: pointer;">
                                        <input type="radio" name="note" value="{{ $i }}" style="display: none;" {{ old('note') == $i ? 'checked' : '' }}>
                                        <i class="fas fa-star star-rating" data-value="{{ $i }}" style="font-size: 1.5rem; color: #374151; transition: color 0.2s; cursor: pointer;"></i>
                                    </label>
                                @endfor
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Votre commentaire</label>
                            <textarea name="contenu" class="form-control" rows="3" placeholder="Partagez votre experience..." required>{{ old('contenu') }}</textarea>
                            @error('contenu') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Publier mon avis</button>
                    </form>
                </div>
            @endauth

            <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                @forelse($produit->commentaires->where('is_visible', true) as $commentaire)
                    <div class="comment-card">
                        <div class="comment-header">
                            <div class="comment-user">
                                <div class="comment-avatar">{{ strtoupper(substr($commentaire->user->username, 0, 2)) }}</div>
                                <div>
                                    <span class="comment-username">{{ $commentaire->user->username }}</span>
                                    <div class="comment-date">{{ $commentaire->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.8rem;">
                                @if($commentaire->note)
                                    <div class="comment-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa{{ $i <= $commentaire->note ? 's' : 'r' }} fa-star"></i>
                                        @endfor
                                    </div>
                                @endif
                                @if(auth()->check() && (auth()->id() === $commentaire->user_id || auth()->user()->isAdmin()))
                                    <form action="{{ route('commentaires.destroy', $commentaire->id) }}" method="POST" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: #64748b; cursor: pointer; font-size: 0.85rem; transition: color 0.3s;" onmouseover="this.style.color='#f87171'" onmouseout="this.style.color='#64748b'" onclick="return confirm('Supprimer ce commentaire ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <p class="comment-text">{{ $commentaire->contenu }}</p>
                    </div>
                @empty
                    <p style="color: #4b5563; text-align: center; padding: 3rem;">Aucun avis pour le moment. Soyez le premier !</p>
                @endforelse
            </div>
        </div>
    </section>

    @if($similaires->count() > 0)
        <section class="similar-section">
            <div class="similar-inner">
                <h2>Jeux similaires</h2>
                <div class="similar-grid">
                    @foreach($similaires as $s)
                        <div class="similar-card">
                            <a href="{{ route('games.show', $s->slug) }}">
                                <div style="overflow: hidden;">
                                    <img src="{{ $s->image ?? 'https://via.placeholder.com/460x215/1e2134/8b5cf6?text=' . urlencode($s->nom) }}" alt="{{ $s->nom }}">
                                </div>
                            </a>
                            <div class="similar-card-body">
                                <h3><a href="{{ route('games.show', $s->slug) }}">{{ $s->nom }}</a></h3>
                                <span class="price">{{ number_format($s->prix, 2, ',', ' ') }} &euro;</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script>
document.querySelectorAll('.star-rating').forEach(star => {
    star.addEventListener('click', function() {
        const val = this.dataset.value;
        this.closest('.form-group').querySelector(`input[value="${val}"]`).checked = true;
        this.closest('.form-group').querySelectorAll('.star-rating').forEach(s => {
            s.style.color = s.dataset.value <= val ? '#fbbf24' : '#374151';
        });
    });
    star.addEventListener('mouseenter', function() {
        const val = this.dataset.value;
        this.closest('.form-group').querySelectorAll('.star-rating').forEach(s => {
            s.style.color = s.dataset.value <= val ? '#fbbf24' : '#374151';
        });
    });
});
</script>
@endpush
