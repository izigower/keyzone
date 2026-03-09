@extends('layouts.app')

@section('title', 'KEYZONE - Les meilleurs jeux, au meilleur prix')

@section('styles')
<style>
/* =============================== */
/*  HERO SECTION                   */
/* =============================== */
.hero {
    position: relative;
    display: flex;
    align-items: flex-start;
    overflow: hidden;
    margin-top: 70px;
    padding: 16rem 8% 10rem;
}



@keyframes float-particle {
    0% { transform: translateY(100vh) scale(0); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(-10vh) scale(1); opacity: 0; }
}

/* Floating geometric shapes */
.geo-shape {
    position: absolute;
    border: 1px solid rgba(139, 92, 246, 0.15);
    border-radius: 10px;
    z-index: 1;
    animation: float-shape 20s ease-in-out infinite;
}
@keyframes float-shape {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    25% { transform: translateY(-30px) rotate(5deg); }
    50% { transform: translateY(-15px) rotate(-3deg); }
    75% { transform: translateY(-25px) rotate(2deg); }
}

.hero-content {
    position: relative;
    z-index: 2;
    margin: 0 auto;
    padding: 5rem 8%;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    background: linear-gradient(135deg, #0d0221 0%, #150535 30%, #0a0a1a 70%, #000 100%);
}
.hero-text { max-width: 650px; }
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(139, 92, 246, 0.12);
    border: 1px solid rgba(139, 92, 246, 0.3);
    color: #c4b5fd;
    padding: 0.6rem 1.4rem;
    border-radius: 50px;
    font-size: 0.85rem;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
    animation: fadeInUp 0.8s ease;
}
.hero-badge .pulse-dot {
    width: 8px;
    height: 8px;
    background: #10b981;
    border-radius: 50%;
    animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.5); }
}
.hero-title {
    font-size: clamp(2.8rem, 5vw, 4.5rem);
    font-weight: 900;
    line-height: 1.05;
    margin-bottom: 1.5rem;
    letter-spacing: -2px;
    animation: fadeInUp 0.8s ease 0.1s both;
}
.hero-title .gradient-text {
    background: linear-gradient(135deg, #fff 0%, #e0d4ff 40%, #8b5cf6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-title .accent {
    background: linear-gradient(135deg, #a78bfa 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-subtitle {
    font-size: 1.2rem;
    color: #94a3b8;
    line-height: 1.7;
    margin-bottom: 2.5rem;
    animation: fadeInUp 0.8s ease 0.2s both;
}
.hero-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    animation: fadeInUp 0.8s ease 0.3s both;
    flex-wrap: wrap;
}
.hero-btn-primary {
    padding: 1rem 2.5rem;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.7rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 8px 30px rgba(139, 92, 246, 0.4), inset 0 1px 0 rgba(255,255,255,0.1);
    position: relative;
    overflow: hidden;
}
.hero-btn-primary::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.3s;
}
.hero-btn-primary:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 12px 40px rgba(139, 92, 246, 0.5);
}
.hero-btn-primary:hover::before { opacity: 1; }

.hero-btn-secondary {
    padding: 1rem 2rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    color: #e2e8f0;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    backdrop-filter: blur(10px);
}
.hero-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: #8b5cf6;
    color: #fff;
}

/* Hero featured game cards (right side) */
.hero-cards {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 450px;
    animation: fadeInRight 1s ease 0.4s both;
}
.hero-featured-card {
    position: absolute;
    width: 280px;
    border-radius: 20px;
    overflow: hidden;
    background: rgba(20, 20, 40, 0.9);
    border: 1px solid rgba(139, 92, 246, 0.2);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    backdrop-filter: blur(20px);
}
.hero-featured-card:nth-child(1) {
    transform: rotate(-6deg) translateX(-40px);
    z-index: 1;
    animation: card-float-1 6s ease-in-out infinite;
}
.hero-featured-card:nth-child(2) {
    transform: rotate(0deg) translateY(-20px);
    z-index: 3;
    animation: card-float-2 5s ease-in-out infinite;
}
.hero-featured-card:nth-child(3) {
    transform: rotate(6deg) translateX(40px);
    z-index: 2;
    animation: card-float-3 7s ease-in-out infinite;
}
@keyframes card-float-1 {
    0%, 100% { transform: rotate(-6deg) translateX(-40px) translateY(0); }
    50% { transform: rotate(-6deg) translateX(-40px) translateY(-15px); }
}
@keyframes card-float-2 {
    0%, 100% { transform: rotate(0deg) translateY(-20px); }
    50% { transform: rotate(0deg) translateY(-35px); }
}
@keyframes card-float-3 {
    0%, 100% { transform: rotate(6deg) translateX(40px) translateY(0); }
    50% { transform: rotate(6deg) translateX(40px) translateY(-10px); }
}
.hero-featured-card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
}
.hero-featured-card .card-info {
    padding: 1rem 1.2rem;
}
.hero-featured-card .card-info h4 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 0.3rem;
    color: #fff;
}
.hero-featured-card .card-price {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.hero-featured-card .card-price .price {
    font-size: 1.2rem;
    font-weight: 800;
    color: #a78bfa;
}
.hero-featured-card .card-price .old-price {
    font-size: 0.85rem;
    color: #64748b;
    text-decoration: line-through;
}
.hero-featured-card .card-discount {
    background: #ef4444;
    color: white;
    padding: 0.2rem 0.6rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    margin-left: auto;
}

/* Hero stats */
.hero-stats {
    display: flex;
    gap: 3rem;
    margin-top: 3rem;
    animation: fadeInUp 0.8s ease 0.5s both;
}
.hero-stat {
    text-align: left;
}
.hero-stat-number {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #8b5cf6, #a78bfa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-stat-label {
    font-size: 0.85rem;
    color: #64748b;
    margin-top: 0.2rem;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
}

/* =============================== */
/*  CATEGORIES BAR                 */
/* =============================== */
.categories-bar {
    padding: 5rem 8%;
}
.categories-inner {
    margin: 0 auto;
    display: flex;
    gap: 1rem;
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    padding: 0.5rem 0;
}
.categories-inner::-webkit-scrollbar { display: none; }
.cat-chip {
    flex-shrink: 0;
    padding: 0.7rem 1.5rem;
    background: rgba(139, 92, 246, 0.08);
    border: 1px solid rgba(139, 92, 246, 0.15);
    border-radius: 50px;
    color: #c4b5fd;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
}
.cat-chip:hover, .cat-chip.active {
    background: rgba(139, 92, 246, 0.2);
    border-color: #8b5cf6;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(139, 92, 246, 0.2);
}
.cat-chip .count {
    background: rgba(139, 92, 246, 0.3);
    padding: 0.1rem 0.5rem;
    border-radius: 20px;
    font-size: 0.75rem;
}

/* =============================== */
/*  TRENDING SECTION               */
/* =============================== */
.section-trending {
    padding: 5rem 8%;
    position: relative;
}
.section-trending::before {
    display: none;
}
.section-header {
    margin: 0 auto 3rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    position: relative;
}
.section-header h2 {
    font-size: 2.2rem;
    font-weight: 800;
    letter-spacing: -0.5px;
}
.section-header h2 .section-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    border-radius: 10px;
    margin-right: 0.8rem;
    font-size: 1rem;
    vertical-align: middle;
}
.section-header .see-more {
    color: #a78bfa;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    padding: 0.6rem 1.2rem;
    border-radius: 8px;
}
.section-header .see-more:hover {
    background: rgba(139, 92, 246, 0.1);
    gap: 0.8rem;
}

/* Game cards */
.games-grid {
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
}
.game-card {
    background: rgba(20, 20, 40, 0.6);
    border-radius: 16px;
    border: 1px solid rgba(139, 92, 246, 0.1);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    backdrop-filter: blur(10px);
}
.game-card:hover {
    transform: translateY(-8px);
    border-color: rgba(139, 92, 246, 0.4);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 80px rgba(139, 92, 246, 0.08);
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
.game-card:hover .game-card-image img {
    transform: scale(1.08);
}
.game-card-image .overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.8) 100%);
    opacity: 0;
    transition: opacity 0.3s;
}
.game-card:hover .game-card-image .overlay { opacity: 1; }
.game-card-badge {
    position: absolute;
    top: 0.8rem;
    left: 0.8rem;
    padding: 0.3rem 0.8rem;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 700;
    z-index: 2;
    backdrop-filter: blur(10px);
}
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
.game-card-stock span {
    color: #f87171;
    font-weight: 700;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.game-card-body {
    padding: 1.2rem 1.3rem 1.5rem;
}
.game-card-platform {
    font-size: 0.8rem;
    color: #64748b;
    margin-bottom: 0.4rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}
.game-card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.8rem;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.game-card-title a { color: #fff; text-decoration: none; }
.game-card-title a:hover { color: #c4b5fd; }
.game-card-pricing {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}
.game-card-price {
    font-size: 1.4rem;
    font-weight: 800;
    color: #a78bfa;
}
.game-card-old-price {
    font-size: 0.85rem;
    color: #64748b;
    text-decoration: line-through;
}
.game-card-discount {
    background: rgba(239, 68, 68, 0.15);
    color: #f87171;
    padding: 0.15rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 700;
    margin-left: auto;
}
.game-card-btn {
    width: 100%;
    padding: 0.8rem;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(124, 58, 237, 0.3) 100%);
    border: 1px solid rgba(139, 92, 246, 0.3);
    color: #c4b5fd;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}
.game-card-btn:hover {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 5px 20px rgba(139, 92, 246, 0.3);
}
.game-card-btn-disabled {
    background: rgba(55, 65, 81, 0.5);
    color: #6b7280;
    cursor: not-allowed;
    border-color: rgba(55, 65, 81, 0.3);
}
.game-card-btn-disabled:hover {
    background: rgba(55, 65, 81, 0.5);
    color: #6b7280;
    box-shadow: none;
    border-color: rgba(55, 65, 81, 0.3);
}

/* =============================== */
/*  WHY CHOOSE US                  */
/* =============================== */
.section-why {
    padding: 5rem 8%;
    background: linear-gradient(180deg, #0a0a0f 0%, rgba(15, 10, 40, 0.5) 50%, #0a0a0f 100%);
    position: relative;
    overflow: hidden;
}
.section-why::before {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.06) 0%, transparent 70%);
    top: -200px;
    right: -200px;
}
.why-grid {
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
}
.why-card {
    background: rgba(20, 20, 40, 0.4);
    border: 1px solid rgba(139, 92, 246, 0.1);
    border-radius: 20px;
    padding: 2.5rem 2rem;
    text-align: center;
    transition: all 0.4s;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
}
.why-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #8b5cf6, transparent);
    opacity: 0;
    transition: opacity 0.4s;
}
.why-card:hover {
    transform: translateY(-5px);
    border-color: rgba(139, 92, 246, 0.3);
    background: rgba(30, 25, 60, 0.5);
}
.why-card:hover::before { opacity: 1; }
.why-icon {
    width: 70px;
    height: 70px;
    border-radius: 18px;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(139, 92, 246, 0.05));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 1.5rem;
    color: #a78bfa;
    transition: all 0.4s;
}
.why-card:hover .why-icon {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: #fff;
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
}
.why-card h3 {
    font-size: 1.15rem;
    font-weight: 700;
    margin-bottom: 0.8rem;
    color: #e2e8f0;
}
.why-card p {
    color: #94a3b8;
    font-size: 0.9rem;
    line-height: 1.6;
}

/* =============================== */
/*  INFINITE SCROLL TESTIMONIALS   */
/* =============================== */
.section-testimonials {
    padding: 5rem 0;
    background: #08080d;
    overflow: hidden;
    position: relative;
}
.section-testimonials .section-header {
    padding: 1rem 8%;
}
.testimonial-marquee-container {
    position: relative;
}
.testimonial-marquee-container::before,
.testimonial-marquee-container::after {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 150px;
    z-index: 2;
    pointer-events: none;
}
.testimonial-marquee-container::before {
    left: 0;
    background: linear-gradient(90deg, #08080d 0%, transparent 100%);
}
.testimonial-marquee-container::after {
    right: 0;
    background: linear-gradient(-90deg, #08080d 0%, transparent 100%);
}
.testimonial-track {
    display: flex;
    gap: 1.5rem;
    animation: scroll-left 40s linear infinite;
    width: max-content;
}
.testimonial-track:hover {
    animation-play-state: paused;
}
@keyframes scroll-left {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.testimonial-track-reverse {
    animation-direction: reverse;
    margin-top: 1.5rem;
}

.testimonial-card {
    flex-shrink: 0;
    width: 380px;
    background: rgba(20, 20, 40, 0.5);
    border: 1px solid rgba(139, 92, 246, 0.1);
    border-radius: 16px;
    padding: 1.8rem;
    backdrop-filter: blur(10px);
    transition: all 0.3s;
}
.testimonial-card:hover {
    border-color: rgba(139, 92, 246, 0.3);
    background: rgba(30, 25, 60, 0.4);
}
.testimonial-stars {
    color: #fbbf24;
    margin-bottom: 1rem;
    letter-spacing: 2px;
    font-size: 0.9rem;
}
.testimonial-text {
    color: #cbd5e1;
    line-height: 1.7;
    font-size: 0.95rem;
    margin-bottom: 1.5rem;
    font-style: italic;
}
.testimonial-author {
    display: flex;
    align-items: center;
    gap: 0.8rem;
}
.testimonial-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: linear-gradient(135deg, #8b5cf6, #ec4899);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
    color: #fff;
}
.testimonial-author-name {
    font-weight: 600;
    font-size: 0.95rem;
    color: #e2e8f0;
}
.testimonial-author-tag {
    font-size: 0.8rem;
    color: #64748b;
}

/* =============================== */
/*  HOW IT WORKS                   */
/* =============================== */
.section-steps {
    padding: 5rem 8%;
    position: relative;
}
.steps-grid {
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 3rem;
    position: relative;
}
.steps-grid::before {
    content: '';
    position: absolute;
    top: 30px;
    left: 16.5%;
    right: 16.5%;
    height: 2px;
    background: linear-gradient(90deg, rgba(139, 92, 246, 0.3), rgba(139, 92, 246, 0.1));
    z-index: 0;
}
.step-card {
    text-align: center;
    position: relative;
    z-index: 1;
}
.step-number {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 1.3rem;
    font-weight: 800;
    color: #fff;
    box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
}
.step-card h3 {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 0.6rem;
    color: #e2e8f0;
}
.step-card p {
    color: #94a3b8;
    font-size: 0.95rem;
    line-height: 1.6;
    margin: 0 auto;
}

/* =============================== */
/*  CTA SECTION                    */
/* =============================== */
.section-cta {
    padding: 5rem 8%;
    position: relative;
    overflow: hidden;
}
.cta-box {
    margin: 0 auto;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(20, 20, 40, 0.8) 100%);
    border: 1px solid rgba(139, 92, 246, 0.2);
    border-radius: 24px;
    padding: 4rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(20px);
}
.cta-box::before {
    content: '';
    position: absolute;
    inset: -2px;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.3), transparent, rgba(236, 72, 153, 0.2));
    border-radius: 24px;
    z-index: -1;
    filter: blur(20px);
}
.cta-box h2 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #fff, #c4b5fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.cta-box p {
    color: #94a3b8;
    font-size: 1.1rem;
    margin-bottom: 2.5rem;
    margin-left: auto;
    margin-right: auto;
}

/* =============================== */
/*  RESPONSIVE                     */
/* =============================== */
@media (max-width: 1024px) {
    .hero-content { grid-template-columns: 1fr; }
    .hero-cards { display: none; }
    .games-grid { grid-template-columns: repeat(2, 1fr); }
    .why-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .hero { min-height: 70vh; padding: 6rem 5% 3rem; }
    .hero-title { font-size: 2.5rem; }
    .hero-stats { gap: 1.5rem; }
    .hero-stat-number { font-size: 1.5rem; }
    .games-grid { grid-template-columns: 1fr; max-width: 400px; }
    .why-grid { grid-template-columns: 1fr; max-width: 400px; }
    .steps-grid { grid-template-columns: 1fr; }
    .steps-grid::before { display: none; }
    .cta-box { padding: 2.5rem 1.5rem; }
    .cta-box h2 { font-size: 1.8rem; }
    .testimonial-card { width: 300px; }
}
</style>
@endsection

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="hero">
    <div class="hero-bg">
        <div class="geo-shape" style="width: 200px; height: 200px; top: 10%; left: 5%; animation-delay: 0s;"></div>
        <div class="geo-shape" style="width: 120px; height: 120px; top: 60%; right: 10%; animation-delay: -5s; border-color: rgba(236, 72, 153, 0.1);"></div>
        <div class="geo-shape" style="width: 80px; height: 80px; bottom: 15%; left: 30%; animation-delay: -10s;"></div>
    </div>

    <div class="hero-content">
        <div class="hero-text">
            <div class="hero-badge">
                <span class="pulse-dot"></span>
                +{{ number_format(($tendances->count() * 250), 0, ',', ' ') }} joueurs en ligne
            </div>
            <h1 class="hero-title">
                <span class="gradient-text">VOS JEUX PREFERES,</span><br>
                <span class="accent">AU MEILLEUR PRIX.</span>
            </h1>
            <p class="hero-subtitle">
                Recevez vos cles d'activation instantanement. Des milliers de jeux PC, Xbox, PlayStation et Nintendo Switch a prix reduit.
            </p>
            <div class="hero-actions">
                <a href="{{ route('games.index') }}" class="hero-btn-primary">
                    <i class="fas fa-gamepad"></i> Explorer le catalogue
                </a>
                <a href="#how-it-works" class="hero-btn-secondary">
                    <i class="fas fa-play-circle"></i> Comment ca marche
                </a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-number" data-count="1500">0</div>
                    <div class="hero-stat-label">Jeux disponibles</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-number" data-count="15000">0</div>
                    <div class="hero-stat-label">Clients satisfaits</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-number" data-count="99">0%</div>
                    <div class="hero-stat-label">Avis positifs</div>
                </div>
            </div>
        </div>

        <div class="hero-cards">
            @foreach($tendances->take(3) as $i => $game)
                <div class="hero-featured-card">
                    <img src="{{ $game->image ?? 'https://via.placeholder.com/280x160/1e2134/8b5cf6?text=' . urlencode($game->nom) }}" alt="{{ $game->nom }}">
                    <div class="card-info">
                        <h4>{{ Str::limit($game->nom, 22) }}</h4>
                        <div class="card-price">
                            <span class="price">{{ number_format($game->prix, 2, ',', ' ') }} &euro;</span>
                            @if($game->prix_original)
                                <span class="old-price">{{ number_format($game->prix_original, 2, ',', ' ') }} &euro;</span>
                                <span class="card-discount">-{{ $game->reduction }}%</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== CATEGORIES BAR ===== --}}
<div class="categories-bar">
    <div class="categories-inner">
        <a href="{{ route('games.index') }}" class="cat-chip active">
            <i class="fas fa-fire"></i> Tous les jeux
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('games.index', ['categorie' => $cat->slug]) }}" class="cat-chip">
                {{ $cat->nom }}
                <span class="count">{{ $cat->produits_count }}</span>
            </a>
        @endforeach
    </div>
</div>

{{-- ===== TRENDING SECTION ===== --}}
<section class="section-trending">
    <div class="section-header">
        <h2><span class="section-icon"><i class="fas fa-fire"></i></span>TENDANCES</h2>
        <a href="{{ route('games.index') }}" class="see-more">
            Voir tout le catalogue <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    <div class="games-grid">
        @forelse($tendances as $produit)
            <div class="game-card">
                <div class="game-card-image">
                    @if($produit->badge)
                        <span class="game-card-badge badge-new">{{ $produit->badge }}</span>
                    @endif
                    @if($produit->reduction > 0)
                        <span class="game-card-badge badge-promo" style="left: auto; right: 0.8rem;">-{{ $produit->reduction }}%</span>
                    @endif
                    <img src="{{ $produit->image ?? 'https://via.placeholder.com/460x215/1e2134/8b5cf6?text=' . urlencode($produit->nom) }}" alt="{{ $produit->nom }}">
                    <div class="overlay"></div>
                    @if($produit->stock_reel < 1)
                        <div class="game-card-stock">
                            <span><i class="fas fa-ban"></i> Rupture de stock</span>
                        </div>
                    @endif
                </div>
                <div class="game-card-body">
                    <div class="game-card-platform">
                        <i class="fas fa-desktop"></i> {{ $produit->plateforme->nom ?? '' }}
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
                    @if($produit->stock_reel > 0)
                        <form action="{{ route('panier.ajouter') }}" method="POST" class="add-cart-form">
                            @csrf
                            <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                            <input type="hidden" name="quantite" value="1">
                            <button type="submit" class="game-card-btn">
                                <i class="fas fa-shopping-cart"></i> Ajouter au panier
                            </button>
                        </form>
                    @else
                        <button class="game-card-btn game-card-btn-disabled" disabled>
                            <i class="fas fa-ban"></i> Indisponible
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 5rem; color: #64748b;">
                <i class="fas fa-gamepad" style="font-size: 4rem; margin-bottom: 1rem; display: block; color: #8b5cf6;"></i>
                <p style="font-size: 1.1rem;">Aucun jeu disponible pour le moment.</p>
                <p style="margin-top: 0.5rem;">Revenez bientot, notre catalogue s'enrichit chaque jour !</p>
            </div>
        @endforelse
    </div>
</section>

{{-- ===== WHY CHOOSE US ===== --}}
<section class="section-why">
    <div class="section-header" style="margin: 0 auto 3.5rem; padding: 0;">
        <div>
            <h2><span class="section-icon"><i class="fas fa-shield-alt"></i></span>POURQUOI KEYZONE ?</h2>
            <p style="color: #94a3b8; margin-top: 0.5rem; font-size: 1rem;">La marketplace de confiance pour vos cles de jeux video</p>
        </div>
    </div>
    <div class="why-grid">
        <div class="why-card">
            <div class="why-icon"><i class="fas fa-bolt"></i></div>
            <h3>Livraison instantanee</h3>
            <p>Recevez votre cle d'activation en quelques secondes, directement par email et dans votre espace client.</p>
        </div>
        <div class="why-card">
            <div class="why-icon"><i class="fas fa-tags"></i></div>
            <h3>Meilleurs prix garantis</h3>
            <p>Nos prix sont parmi les plus bas du marche. Economisez jusqu'a 90% sur vos jeux preferes.</p>
        </div>
        <div class="why-card">
            <div class="why-icon"><i class="fas fa-lock"></i></div>
            <h3>Paiement 100% securise</h3>
            <p>Transactions protegees par Stripe, le leader mondial du paiement en ligne securise.</p>
        </div>
        <div class="why-card">
            <div class="why-icon"><i class="fas fa-headset"></i></div>
            <h3>Support reactif</h3>
            <p>Notre equipe est disponible pour repondre a toutes vos questions et vous accompagner.</p>
        </div>
    </div>
</section>

{{-- ===== TESTIMONIALS INFINITE SCROLL ===== --}}
<section class="section-testimonials">
    <div class="section-header">
        <div>
            <h2><span class="section-icon"><i class="fas fa-star"></i></span>ILS NOUS FONT CONFIANCE</h2>
            <p style="color: #94a3b8; margin-top: 0.5rem;">Des milliers de joueurs satisfaits a travers le monde</p>
        </div>
    </div>

    @php
        $avis = [
            ['name' => 'Axelle T.', 'initials' => 'AT', 'text' => 'Achat effectue en moins de 2 minutes, la cle a fonctionne du premier coup sur Steam. Prix tres competitif !', 'stars' => 5, 'tag' => 'Joueuse PC'],
            ['name' => 'Hugo B.', 'initials' => 'HB', 'text' => 'J\'etais un peu mefiant au depart, mais tout s\'est deroule parfaitement. Paiement securise et cle valide.', 'stars' => 5, 'tag' => 'Joueur Xbox'],
            ['name' => 'Claude P.', 'initials' => 'CP', 'text' => 'J\'ai economise presque 40% par rapport aux plateformes classiques. Aucun probleme a l\'activation !', 'stars' => 5, 'tag' => 'Joueur PC'],
            ['name' => 'Marie L.', 'initials' => 'ML', 'text' => 'Service client au top ! J\'avais une question sur ma commande, reponse en moins de 30 minutes.', 'stars' => 5, 'tag' => 'Joueuse Switch'],
            ['name' => 'Thomas D.', 'initials' => 'TD', 'text' => 'Meilleur site pour acheter des cles de jeux. Les prix sont imbattables et la livraison est instantanee.', 'stars' => 5, 'tag' => 'Joueur PS5'],
            ['name' => 'Sophie R.', 'initials' => 'SR', 'text' => 'Premiere commande et deja conquise. Interface claire, paiement rapide, cle recue dans la minute !', 'stars' => 5, 'tag' => 'Joueuse PC'],
            ['name' => 'Lucas M.', 'initials' => 'LM', 'text' => 'Ca fait 6 mois que j\'achete mes jeux ici. Jamais eu le moindre souci. Je recommande a 100%.', 'stars' => 5, 'tag' => 'Joueur PC'],
            ['name' => 'Emma V.', 'initials' => 'EV', 'text' => 'Le code promo a marche parfaitement. J\'ai eu mon jeu presque gratuit pour le Black Friday !', 'stars' => 5, 'tag' => 'Joueuse Xbox'],
            ['name' => 'Nathan G.', 'initials' => 'NG', 'text' => 'Rapide, fiable, pas cher. Que demander de plus ? Mon nouveau site prefere pour acheter des jeux.', 'stars' => 4, 'tag' => 'Joueur PS5'],
            ['name' => 'Julie K.', 'initials' => 'JK', 'text' => 'Site tres bien fait, on trouve facilement ce qu\'on cherche. Les filtres par plateforme sont super pratiques.', 'stars' => 5, 'tag' => 'Joueuse Switch'],
        ];
        $row1 = array_slice($avis, 0, 5);
        $row2 = array_slice($avis, 5, 5);
    @endphp

    <div class="testimonial-marquee-container">
        {{-- Row 1: Left to right --}}
        <div class="testimonial-track" id="testimonial-track-1">
            @foreach(array_merge($row1, $row1) as $t)
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        @for($i = 0; $i < $t['stars']; $i++) &#9733; @endfor
                    </div>
                    <p class="testimonial-text">"{{ $t['text'] }}"</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">{{ $t['initials'] }}</div>
                        <div>
                            <div class="testimonial-author-name">{{ $t['name'] }}</div>
                            <div class="testimonial-author-tag">{{ $t['tag'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Row 2: Right to left --}}
        <div class="testimonial-track testimonial-track-reverse" id="testimonial-track-2">
            @foreach(array_merge($row2, $row2) as $t)
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        @for($i = 0; $i < $t['stars']; $i++) &#9733; @endfor
                    </div>
                    <p class="testimonial-text">"{{ $t['text'] }}"</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">{{ $t['initials'] }}</div>
                        <div>
                            <div class="testimonial-author-name">{{ $t['name'] }}</div>
                            <div class="testimonial-author-tag">{{ $t['tag'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== HOW IT WORKS ===== --}}
<section class="section-steps" id="how-it-works">
    <div class="section-header" style="max-width: 1100px; margin: 0 auto 4rem; text-align: center; display: block;">
        <h2 style="font-size: 2.2rem;"><span class="section-icon"><i class="fas fa-magic"></i></span>COMMENT CA MARCHE ?</h2>
        <p style="color: #94a3b8; margin-top: 0.8rem; font-size: 1.05rem;">Obtenez vos jeux en 3 etapes simples</p>
    </div>
    <div class="steps-grid">
        <div class="step-card">
            <div class="step-number">1</div>
            <h3>Choisissez votre jeu</h3>
            <p>Parcourez notre catalogue et trouvez le jeu qui vous fait envie au meilleur prix.</p>
        </div>
        <div class="step-card">
            <div class="step-number">2</div>
            <h3>Payez en securite</h3>
            <p>Finalisez votre achat en toute confiance avec notre systeme de paiement securise Stripe.</p>
        </div>
        <div class="step-card">
            <div class="step-number">3</div>
            <h3>Recevez votre cle</h3>
            <p>Votre cle d'activation est livree instantanement par email et dans votre espace client.</p>
        </div>
    </div>
</section>

{{-- ===== CTA SECTION ===== --}}
<section class="section-cta">
    <div class="cta-box">
        <h2>Pret a jouer ?</h2>
        <p>Rejoignez des milliers de gamers qui font confiance a KEYZONE pour leurs achats de jeux video.</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('games.index') }}" class="hero-btn-primary" style="font-size: 1rem;">
                <i class="fas fa-gamepad"></i> Voir les jeux
            </a>
            @guest
                <a href="{{ route('register') }}" class="hero-btn-secondary" style="font-size: 1rem;">
                    <i class="fas fa-user-plus"></i> Creer un compte gratuit
                </a>
            @endguest
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// ===== COUNT-UP ANIMATION =====
(function() {
    const counters = document.querySelectorAll('.hero-stat-number[data-count]');
    const speed = 60;

    function animateCounter(el) {
        const target = +el.dataset.count;
        const suffix = el.textContent.replace(/[0-9]/g, '');
        let current = 0;
        const increment = Math.ceil(target / speed);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            el.textContent = current.toLocaleString('fr-FR') + suffix;
        }, 30);
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(c => observer.observe(c));
})();

// ===== SCROLL REVEAL ANIMATIONS =====
(function() {
    const elements = document.querySelectorAll('.game-card, .why-card, .step-card, .cta-box');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    elements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        observer.observe(el);
    });
})();

// ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// ===== CART AJAX =====
document.querySelectorAll('.add-cart-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        @guest
            return true;
        @endguest
        e.preventDefault();
        const btn = this.querySelector('button');
        const origHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Ajout...';
        btn.disabled = true;

        fetch(this.action, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': window.csrfToken, 'Accept': 'application/json' },
            body: new FormData(this),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                btn.innerHTML = '<i class="fas fa-check"></i> Ajoute !';
                btn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                btn.style.color = '#fff';
                btn.style.borderColor = 'transparent';
                const badge = document.querySelector('.nav-cart .badge');
                if (badge) {
                    badge.textContent = data.count;
                } else {
                    const cart = document.querySelector('.nav-cart');
                    if (cart) cart.innerHTML += '<span class="badge">' + data.count + '</span>';
                }
                setTimeout(() => {
                    btn.innerHTML = origHTML;
                    btn.disabled = false;
                    btn.style.background = '';
                    btn.style.color = '';
                    btn.style.borderColor = '';
                }, 2000);
            } else {
                btn.innerHTML = origHTML;
                btn.disabled = false;
                alert(data.message || 'Erreur');
            }
        })
        .catch(() => { btn.innerHTML = origHTML; btn.disabled = false; this.submit(); });
    });
});
</script>
@endpush
