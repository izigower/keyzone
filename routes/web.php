<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\AdminController;

// ========== PUBLIC ==========
Route::get('/', [HomeController::class, 'index'])->name('home');

// ========== AUTH ==========
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/mot-de-passe-oublie', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
    Route::post('/mot-de-passe-oublie', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ========== EMAIL VERIFICATION ==========
Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware('signed')->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware('throttle:6,1')->name('verification.send');

// ========== GAMES (PUBLIC) ==========
Route::get('/jeux', [GameController::class, 'index'])->name('games.index');
Route::get('/jeux/{slug}', [GameController::class, 'show'])->name('games.show');

// ========== AUTHENTICATED ROUTES ==========
Route::middleware('auth')->group(function () {
    // Panier
    Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    Route::delete('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
    Route::post('/panier/mettre-a-jour/{id}', [PanierController::class, 'mettreAJour'])->name('panier.mettreAJour');
    Route::post('/panier/vider', [PanierController::class, 'vider'])->name('panier.vider');

    // Paiement
    Route::get('/checkout', [PaiementController::class, 'checkout'])->name('paiement.checkout');
    Route::post('/checkout/promo', [PaiementController::class, 'appliquerPromo'])->name('paiement.promo');
    Route::post('/paiement', [PaiementController::class, 'payer'])->name('paiement.payer');
    Route::get('/paiement/succes/{id}', [PaiementController::class, 'succes'])->name('paiement.succes');
    Route::get('/paiement/annule/{id?}', [PaiementController::class, 'annule'])->name('paiement.annule');

    // Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');

    // Commandes
    Route::get('/mes-commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/mes-commandes/{id}', [CommandeController::class, 'show'])->name('commandes.show');

    // Commentaires
    Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
    Route::delete('/commentaires/{id}', [CommentaireController::class, 'destroy'])->name('commentaires.destroy');
});

// ========== ADMIN ==========
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Users
    Route::get('/utilisateurs', [AdminController::class, 'users'])->name('admin.users');
    Route::put('/utilisateurs/{id}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.role');
    Route::put('/utilisateurs/{id}/toggle', [AdminController::class, 'toggleUserActive'])->name('admin.users.toggle');

    // Categories
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

    // Products
    Route::get('/produits', [AdminController::class, 'produits'])->name('admin.produits');
    Route::post('/produits', [AdminController::class, 'storeProduit'])->name('admin.produits.store');
    Route::get('/produits/{id}/edit', [AdminController::class, 'editProduit'])->name('admin.produits.edit');
    Route::put('/produits/{id}', [AdminController::class, 'updateProduit'])->name('admin.produits.update');
    Route::delete('/produits/{id}', [AdminController::class, 'destroyProduit'])->name('admin.produits.destroy');

    // Game Keys
    Route::post('/produits/{id}/cles', [AdminController::class, 'addKeys'])->name('admin.cles.store');

    // Orders
    Route::get('/commandes', [AdminController::class, 'commandes'])->name('admin.commandes');

    // Promo Codes
    Route::get('/promos', [AdminController::class, 'promos'])->name('admin.promos');
    Route::post('/promos', [AdminController::class, 'storePromo'])->name('admin.promos.store');
    Route::delete('/promos/{id}', [AdminController::class, 'destroyPromo'])->name('admin.promos.destroy');
});
