<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PaiementController;


// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Jeux
Route::get('/jeux', [GameController::class, 'index'])->name('games.index');
Route::get('/jeux/{slug}', [ProductController::class, 'show'])->name('products.show');

// Panier
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter')->middleware('auth');
Route::delete('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer')->middleware('auth');
Route::post('/panier/mettre-a-jour/{id}', [PanierController::class, 'mettreAJour'])->name('panier.mettreAJour')->middleware('auth');
Route::post('/panier/vider', [PanierController::class, 'vider'])->name('panier.vider')->middleware('auth');

// Paiement
Route::get('/checkout', [PaiementController::class, 'checkout'])->name('paiement.checkout')->middleware('auth');
Route::post('/paiement', [PaiementController::class, 'payer'])->name('paiement.payer')->middleware('auth');
Route::get('/paiement/stripe/{id_commande}', [PaiementController::class, 'stripe'])->name('paiement.stripe')->middleware('auth');
Route::get('/paiement/succes/{id_commande}', [PaiementController::class, 'succes'])->name('paiement.succes')->middleware('auth');
Route::get('/paiement/annule', [PaiementController::class, 'annule'])->name('paiement.annule')->middleware('auth');