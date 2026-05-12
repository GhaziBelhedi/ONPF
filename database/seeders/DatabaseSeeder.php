<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Magasinier de test
        \App\Models\User::factory()->create([
            'name' => 'Magasinier Test',
            'email' => 'magasinier@onpf.dz',
            'password' => bcrypt('password'),
            'role' => 'magasinier',
        ]);

        // Service Administratif de test
        \App\Models\User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@onpf.dz',
            'password' => bcrypt('password'),
            'role' => 'administratif',
        ]);

        // Direction Centrale de test
        \App\Models\User::factory()->create([
            'name' => 'Direction Centrale',
            'email' => 'direction@onpf.dz',
            'password' => bcrypt('password'),
            'role' => 'direction_centrale',
        ]);

        // Articles de base
        \App\Models\Article::create(['nom' => 'Papier A4', 'quantite' => 100, 'seuil_minimum' => 20]);
        \App\Models\Article::create(['nom' => 'Stylos Bleus', 'quantite' => 5, 'seuil_minimum' => 10]);
        \App\Models\Article::create(['nom' => 'Agrafeuse', 'quantite' => 15, 'seuil_minimum' => 5]);
    }
}
