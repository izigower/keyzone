<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        // Données temporaires des jeux (plus tard depuis la BDD)
        $games = [
            [
                'id' => 1,
                'title' => 'Hollow Knight',
                'slug' => 'hollow-knight',
                'price' => '14,99',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/367520/header.jpg',
                'badge' => 'Incontournable'
            ],
            [
                'id' => 2,
                'title' => 'Bread & Fred',
                'slug' => 'bread-fred',
                'price' => '6,99',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1234560/header.jpg',
                'badge' => null
            ],
            [
                'id' => 3,
                'title' => 'Slime Rancher 2',
                'slug' => 'slime-rancher-2',
                'price' => '19,99',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1579700/header.jpg',
                'badge' => 'Nouveau'
            ],
            [
                'id' => 4,
                'title' => 'Animal Crossing',
                'slug' => 'animal-crossing',
                'price' => '39,99',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1072270/header.jpg',
                'badge' => null
            ],
            [
                'id' => 5,
                'title' => 'The Witcher 3',
                'slug' => 'the-witcher-3',
                'price' => '29,99',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/292030/header.jpg',
                'badge' => 'Best-seller'
            ],
            [
                'id' => 6,
                'title' => 'Cyberpunk 2077',
                'slug' => 'cyberpunk-2077',
                'price' => '49,99',
                'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1091500/header.jpg',
                'badge' => null
            ],
        ];

        return view('games.index', compact('games'));
    }
}