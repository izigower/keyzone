<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('code_promos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['pourcentage', 'fixe'])->default('pourcentage');
            $table->decimal('valeur', 10, 2);
            $table->integer('utilisations_max')->nullable();
            $table->integer('utilisations_count')->default(0);
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('code_promos');
    }
};
