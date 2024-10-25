<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Track;
use App\Models\Category;

class AssignRandomCategoriesToTracksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupère toutes les catégories
        $categories = Category::all();

        // Récupère toutes les pistes
        $tracks = Track::all();

        foreach ($tracks as $track) {
            // Assigne une catégorie aléatoire
            $randomCategory = $categories->random(); // Sélectionne une catégorie aléatoire
            $track->category()->associate($randomCategory); // Associe la catégorie
            $track->save(); // Sauvegarde les modifications
        }
    }
}
