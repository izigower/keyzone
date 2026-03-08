<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter la colonne username
            $table->string('username')->unique()->after('id');
            
            // Optionnel : supprimer l'ancienne colonne 'name' si elle existe
            // $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};