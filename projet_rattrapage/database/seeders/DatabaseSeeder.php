<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Address; // N'oubliez pas d'importer le modèle Address !

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $catEnv = Category::create(['name' => 'Environnement']);
        $catSolidarite = Category::create(['name' => 'Solidarité']);
        $catSante = Category::create(['name' => 'Santé']);

        
        $admin = User::create([
            'username' => 'Super Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $volunteer1 = User::create([
            'username' => 'Ammar Kasimi', 
            'email' => 'ammar@test.com',
            'password' => Hash::make('password'),
            'role' => 'volunteer',
        ]);

        $volunteer2 = User::create([
            'username' => 'Marie Dupont',
            'email' => 'marie@test.com',
            'password' => Hash::make('password'),
            'role' => 'volunteer',
        ]);

        $address1 = Address::create([
            'location' => 'Plage de Témara',
            'city' => 'Témara',
            'postal_code' => '12000',
            'country' => 'Maroc',
        ]);

       
        $address2 = Address::create([
            'location' => 'Centre-ville, Place Bab el Had',
            'city' => 'Rabat',
            'postal_code' => '10000',
            'country' => 'Maroc',
        ]);

       
        $event1 = Event::create([
            'title' => 'Grand nettoyage de la plage',
            'desc' => "Rejoignez-nous pour ramasser les déchets plastiques sur la côte.\nMatériel fourni sur place.",
            'date' => '2026-08-15',
            'max_volunteers' => 10,
            'category_id' => $catEnv->id,
            'address_id' => $address1->id,
        ]);

        $event2 = Event::create([
            'title' => 'Distribution de repas chauds',
            'desc' => "Aide à la distribution de repas pour les personnes en situation de précarité au centre-ville.",
            'date' => '2026-08-20',
            'max_volunteers' => 2,
            'category_id' => $catSolidarite->id,
            'address_id' => $address2->id,
        ]);

        
        $event1->volunteers()->attach([$volunteer1->id, $volunteer2->id]);
        $event2->volunteers()->attach($volunteer1->id);
    }
}