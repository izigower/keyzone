<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CategorieProduit;
use App\Models\Plateforme;
use App\Models\Produit;
use App\Models\CleJeu;
use App\Models\CodePromo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ======== ADMIN USER ========
        $admin = User::create([
            'username' => 'admin',
            'name' => 'Administrateur',
            'email' => 'admin@keyzone.fr',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'date_naissance' => '1995-01-15',
        ]);

        // Test user
        User::create([
            'username' => 'testuser',
            'name' => 'Test User',
            'email' => 'test@keyzone.fr',
            'password' => Hash::make('Test123!'),
            'role' => 'user',
            'email_verified_at' => now(),
            'date_naissance' => '2000-06-20',
        ]);

        // ======== PLATFORMS ========
        $pc = Plateforme::create(['nom' => 'PC', 'slug' => 'pc', 'icone' => 'fab fa-windows']);
        $xbox = Plateforme::create(['nom' => 'Xbox', 'slug' => 'xbox', 'icone' => 'fab fa-xbox']);
        $ps = Plateforme::create(['nom' => 'PlayStation', 'slug' => 'playstation', 'icone' => 'fab fa-playstation']);
        $switch = Plateforme::create(['nom' => 'Switch', 'slug' => 'switch', 'icone' => 'fas fa-gamepad']);

        // ======== CATEGORIES ========
        $default = CategorieProduit::create(['nom' => 'Non catégorisé', 'slug' => 'non-categorise', 'is_default' => true, 'description' => 'Catégorie par défaut']);
        $action = CategorieProduit::create(['nom' => 'Action', 'slug' => 'action', 'description' => 'Jeux d\'action et d\'aventure']);
        $rpg = CategorieProduit::create(['nom' => 'RPG', 'slug' => 'rpg', 'description' => 'Jeux de rôle']);
        $indie = CategorieProduit::create(['nom' => 'Indépendant', 'slug' => 'independant', 'description' => 'Jeux indépendants']);
        $sport = CategorieProduit::create(['nom' => 'Sport', 'slug' => 'sport', 'description' => 'Jeux de sport']);
        $strategie = CategorieProduit::create(['nom' => 'Stratégie', 'slug' => 'strategie', 'description' => 'Jeux de stratégie']);
        $aventure = CategorieProduit::create(['nom' => 'Aventure', 'slug' => 'aventure', 'description' => 'Jeux d\'aventure']);
        $fps = CategorieProduit::create(['nom' => 'FPS', 'slug' => 'fps', 'description' => 'First Person Shooter']);

        // ======== PRODUCTS ========
        $games = [
            ['nom' => 'Hollow Knight', 'prix' => 7.99, 'prix_original' => 14.99, 'categorie' => $indie, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/367520/header.jpg', 'badge' => 'Incontournable', 'description' => 'Forgez votre propre chemin dans Hollow Knight ! Un jeu épique d\'action-aventure en 2D à travers un vaste monde interconnecté.', 'age_rating' => 7],
            ['nom' => 'Bread & Fred', 'prix' => 6.99, 'prix_original' => null, 'categorie' => $indie, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1741870/header.jpg', 'badge' => null, 'description' => 'Un jeu de plateforme coopératif où deux pingouins escaladent une montagne.', 'age_rating' => 3],
            ['nom' => 'Slime Rancher 2', 'prix' => 19.99, 'prix_original' => 29.99, 'categorie' => $aventure, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1657630/header.jpg', 'badge' => 'Nouveau', 'description' => 'Continuez les aventures de Beatrix LeBeau avec de nouveaux slimes.', 'age_rating' => 3],
            ['nom' => 'Elden Ring', 'prix' => 39.99, 'prix_original' => 59.99, 'categorie' => $rpg, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1245620/header.jpg', 'badge' => 'Best-seller', 'description' => 'LE NOUVEAU RPG D\'ACTION FANTASY. Levez-vous, Sans-éclat, et que la grâce vous guide.', 'age_rating' => 16],
            ['nom' => 'The Witcher 3: Wild Hunt', 'prix' => 9.99, 'prix_original' => 29.99, 'categorie' => $rpg, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/292030/header.jpg', 'badge' => 'Classique', 'description' => 'Vous êtes Geralt de Riv, un tueur de monstres professionnel dans un monde fantasy.', 'age_rating' => 18],
            ['nom' => 'Cyberpunk 2077', 'prix' => 29.99, 'prix_original' => 59.99, 'categorie' => $rpg, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1091500/header.jpg', 'badge' => '-50%', 'description' => 'Cyberpunk 2077 est un RPG d\'action-aventure en monde ouvert dans Night City.', 'age_rating' => 18],
            ['nom' => 'FIFA 26', 'prix' => 49.99, 'prix_original' => 69.99, 'categorie' => $sport, 'plateforme' => $ps, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1811260/header.jpg', 'badge' => 'Nouveau', 'description' => 'Le jeu de football le plus populaire au monde.', 'age_rating' => 3],
            ['nom' => 'Call of Duty: Modern Warfare III', 'prix' => 49.99, 'prix_original' => 69.99, 'categorie' => $fps, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/2519060/header.jpg', 'badge' => null, 'description' => 'La suite directe de Modern Warfare II.', 'age_rating' => 18],
            ['nom' => 'Animal Crossing: New Horizons', 'prix' => 39.99, 'prix_original' => 59.99, 'categorie' => $aventure, 'plateforme' => $switch, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1072270/header.jpg', 'badge' => null, 'description' => 'Créez votre petit paradis sur une île déserte.', 'age_rating' => 3],
            ['nom' => 'Halo Infinite', 'prix' => 29.99, 'prix_original' => 59.99, 'categorie' => $fps, 'plateforme' => $xbox, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1240440/header.jpg', 'badge' => null, 'description' => 'Le Master Chief revient dans l\'aventure Halo la plus ambitieuse.', 'age_rating' => 16],
            ['nom' => 'Stardew Valley', 'prix' => 6.99, 'prix_original' => 13.99, 'categorie' => $indie, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/413150/header.jpg', 'badge' => 'Coup de coeur', 'description' => 'Héritez de l\'ancienne ferme de votre grand-père dans Stardew Valley.', 'age_rating' => 3],
            ['nom' => 'Civilization VI', 'prix' => 14.99, 'prix_original' => 59.99, 'categorie' => $strategie, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/289070/header.jpg', 'badge' => '-75%', 'description' => 'Créez un empire résistant à l\'épreuve du temps dans Sid Meier\'s Civilization VI.', 'age_rating' => 12],
            ['nom' => 'GTA V', 'prix' => 14.99, 'prix_original' => 29.99, 'categorie' => $action, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/271590/header.jpg', 'badge' => 'Best-seller', 'description' => 'Quand un jeune escroc, un braqueur à la retraite et un psychopathe se retrouvent piégés...', 'age_rating' => 18],
            ['nom' => 'Zelda: Tears of the Kingdom', 'prix' => 49.99, 'prix_original' => 69.99, 'categorie' => $aventure, 'plateforme' => $switch, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1599340/header.jpg', 'badge' => 'Incontournable', 'description' => 'La suite de Breath of the Wild. Explorez le ciel d\'Hyrule.', 'age_rating' => 12],
            ['nom' => 'Red Dead Redemption 2', 'prix' => 19.99, 'prix_original' => 59.99, 'categorie' => $action, 'plateforme' => $pc, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1174180/header.jpg', 'badge' => 'Chef-d\'oeuvre', 'description' => 'Arthur Morgan et le gang Van der Linde fuient à travers l\'Amérique.', 'age_rating' => 18],
            ['nom' => 'Forza Horizon 5', 'prix' => 29.99, 'prix_original' => 59.99, 'categorie' => $sport, 'plateforme' => $xbox, 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1551360/header.jpg', 'badge' => null, 'description' => 'Le monde ouvert ultime du jeu de course au Mexique.', 'age_rating' => 3],
        ];

        foreach ($games as $game) {
            $produit = Produit::create([
                'nom' => $game['nom'],
                'slug' => Str::slug($game['nom']),
                'prix' => $game['prix'],
                'prix_original' => $game['prix_original'],
                'categorie_id' => $game['categorie']->id,
                'plateforme_id' => $game['plateforme']->id,
                'image' => $game['image'],
                'badge' => $game['badge'],
                'description' => $game['description'],
                'age_rating' => $game['age_rating'],
                'is_active' => true,
                'stock' => 10,
            ]);

            // Generate game keys for each product
            for ($i = 0; $i < 10; $i++) {
                CleJeu::create([
                    'produit_id' => $produit->id,
                    'cle' => strtoupper(Str::random(5) . '-' . Str::random(5) . '-' . Str::random(5)),
                    'statut' => 'disponible',
                ]);
            }
        }

        // ======== PROMO CODES ========
        // Demo code for presentation
        CodePromo::create([
            'code' => 'DEMO2026',
            'type' => 'pourcentage',
            'valeur' => 100,
            'utilisations_max' => 50,
            'date_debut' => now(),
            'date_fin' => now()->addYear(),
            'is_active' => true,
        ]);

        CodePromo::create([
            'code' => 'KEYZONE20',
            'type' => 'pourcentage',
            'valeur' => 20,
            'utilisations_max' => 100,
            'date_debut' => now(),
            'date_fin' => now()->addMonths(6),
            'is_active' => true,
        ]);

        CodePromo::create([
            'code' => 'BIENVENUE',
            'type' => 'fixe',
            'valeur' => 5,
            'utilisations_max' => null,
            'date_debut' => now(),
            'date_fin' => now()->addYear(),
            'is_active' => true,
        ]);

        echo "Seeding terminé ! \n";
        echo "Admin: admin@keyzone.fr / Admin123!\n";
        echo "User: test@keyzone.fr / Test123!\n";
        echo "Code promo démo (100%): DEMO2026\n";
        echo "Code promo 20%: KEYZONE20\n";
        echo "Code promo 5EUR: BIENVENUE\n";
    }
}
