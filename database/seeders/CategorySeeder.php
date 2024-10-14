<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Esport', 'icon' => 'esport'],
            ['name' => 'Event', 'icon' => 'event'],
            ['name' => 'Jeux', 'icon' => 'jeux'],
            ['name' => 'Action', 'icon' => 'action'],
            ['name' => 'Aventure', 'icon' => 'adventure'],
            ['name' => 'Jeu de rôle (RPG)', 'icon' => 'rpg'],
            ['name' => 'Stratégie', 'icon' => 'strategy'],
            ['name' => 'Simulation', 'icon' => 'simulation'],
            ['name' => 'Sports', 'icon' => 'sports'],
            ['name' => 'Course', 'icon' => 'racing'],
            ['name' => 'Combat', 'icon' => 'fighting'],
            ['name' => 'Puzzle', 'icon' => 'puzzle'],
            ['name' => 'Horreur', 'icon' => 'horror'],
            ['name' => 'Monde ouvert', 'icon' => 'open-world'],
            ['name' => 'MMORPG', 'icon' => 'mmorpg'],
            ['name' => 'Plateforme', 'icon' => 'platformer'],
            ['name' => 'Furtivité', 'icon' => 'stealth'],
            ['name' => 'Tireur (Shooter)', 'icon' => 'shooter'],
            ['name' => 'Survie', 'icon' => 'survival'],
            ['name' => 'Tour par tour', 'icon' => 'turn'],
            ['name' => 'Science-fiction', 'icon' => 'sf'],
            ['name' => 'Fantasy', 'icon' => 'fantasy'],
            ['name' => 'Historique', 'icon' => 'historical'],
        ];
        
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'icon' => $category['icon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
