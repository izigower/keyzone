<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = [
            'title' => 'Hollow Knight',
            'price' => '14,99',
            'rating' => 5.0,
            'reviews' => 8,
            'age_rating' => 7,
            'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/367520/header.jpg',
            'editions' => ['Standard', 'Voidheart'],
            'platforms' => [
                ['name' => 'PC', 'icon' => 'fab fa-windows'],
                ['name' => 'XBOX', 'icon' => 'fab fa-xbox'],
                ['name' => 'SWITCH', 'icon' => 'fas fa-gamepad'],
                ['name' => 'PLAY', 'icon' => 'fab fa-playstation'],
            ],
            'dlcs' => [
                ['name' => 'Godmaster', 'price' => '3,99', 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/637020/header.jpg'],
                ['name' => 'Lifeblood', 'price' => '6,99', 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/713690/header.jpg'],
                ['name' => 'The Grimm Troupe', 'price' => '6,99', 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/666680/header.jpg'],
                ['name' => 'Hidden Dreams', 'price' => '5,99', 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/613190/header.jpg'],
            ]
        ];

        return view('products.show', compact('product', 'slug'));
    }
}