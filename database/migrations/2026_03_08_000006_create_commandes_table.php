<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_commande')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('montant_total', 10, 2);
            $table->decimal('montant_reduit', 10, 2)->nullable();
            $table->foreignId('code_promo_id')->nullable()->constrained('code_promos')->onDelete('set null');
            $table->string('adresse_livraison')->nullable();
            $table->string('adresse_facturation')->nullable();
            $table->enum('statut', ['en_attente', 'payee', 'expediee', 'livree', 'annulee'])->default('en_attente');
            $table->string('stripe_session_id')->nullable();
            $table->timestamps();
        });

        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade');
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');
            $table->integer('quantite')->default(1);
            $table->decimal('prix_unitaire', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ligne_commandes');
        Schema::dropIfExists('commandes');
    }
};
