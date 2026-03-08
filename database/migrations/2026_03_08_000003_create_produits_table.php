<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('prix', 10, 2);
            $table->decimal('prix_original', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->foreignId('categorie_id')->constrained('categorie_produits')->onDelete('cascade');
            $table->foreignId('plateforme_id')->constrained('plateformes')->onDelete('cascade');
            $table->integer('stock')->default(0);
            $table->string('badge')->nullable();
            $table->integer('age_rating')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
