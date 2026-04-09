<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Client;
use App\Models\Utilisateur;
use App\Models\CategorieTicket;
use App\Models\Adresse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        $adminRole = Role::where('code', 'admin')->first();
        $agentRole = Role::where('code', 'agent')->first();
        $clientRole = Role::where('code', 'client')->first();

        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role_id' => $adminRole->id,
            ]);
        }

        if (!User::where('email', 'agent@example.com')->exists()) {
            User::create([
                'name' => 'Agent',
                'email' => 'agent@example.com',
                'password' => bcrypt('password'),
                'role_id' => $agentRole->id,
            ]);
        }

        if (!User::where('email', 'client@example.com')->exists()) {
            User::create([
                'name' => 'Client',
                'email' => 'client@example.com',
                'password' => bcrypt('password'),
                'role_id' => $clientRole->id,
            ]);
        }

        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        if (!Adresse::exists()) {
            $adresse = Adresse::create([
                'rue' => '123 Rue Principale',
                'ville' => 'Paris',
                'code_postal' => '75001',
                'pays' => 'France',
            ]);
        } else {
            $adresse = Adresse::first();
        }

        if (!Client::where('code', 'CLI-001')->exists()) {
            Client::create([
                'code' => 'CLI-001',
                'nom' => 'Entreprise Test',
                'email' => 'contact@entreprise-test.fr',
                'telephone' => '0123456789',
                'adresse_id' => $adresse->id,
            ]);
        }

        if (!Utilisateur::where('email', 'jean.dupont@example.com')->exists()) {
            Utilisateur::create([
                'uuid' => \Illuminate\Support\Str::uuid(),
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'email' => 'jean.dupont@example.com',
                'telephone' => '0612345678',
                'mot_de_passe' => bcrypt('password'),
                'etat' => 'actif',
            ]);
        }

        if (CategorieTicket::count() === 0) {
            CategorieTicket::create(['code' => 'TECH', 'libelle' => 'Technique', 'sla_heures' => 24]);
            CategorieTicket::create(['code' => 'FACT', 'libelle' => 'Facturation', 'sla_heures' => 48]);
            CategorieTicket::create(['code' => 'SUPP', 'libelle' => 'Support', 'sla_heures' => 4]);
            CategorieTicket::create(['code' => 'AUTRE', 'libelle' => 'Autre', 'sla_heures' => 24]);
        }

        if (Client::count() < 5) {
            Client::create(['code' => 'CLI-002', 'nom' => 'Client B', 'email' => 'clientb@test.com', 'telephone' => '0123456780', 'adresse_id' => $adresse->id]);
            Client::create(['code' => 'CLI-003', 'nom' => 'Client C', 'email' => 'clientc@test.com', 'telephone' => '0123456781', 'adresse_id' => $adresse->id]);
            Client::create(['code' => 'CLI-004', 'nom' => 'Client D', 'email' => 'clientd@test.com', 'telephone' => '0123456782', 'adresse_id' => $adresse->id]);
            Client::create(['code' => 'CLI-005', 'nom' => 'Client E', 'email' => 'cliente@test.com', 'telephone' => '0123456783', 'adresse_id' => $adresse->id]);
        }

        if (Utilisateur::count() < 5) {
            Utilisateur::create(['uuid' => \Illuminate\Support\Str::uuid(), 'nom' => 'Martin', 'prenom' => 'Sophie', 'email' => 'sophie.martin@example.com', 'telephone' => '0612345679', 'mot_de_passe' => bcrypt('password'), 'etat' => 'actif']);
            Utilisateur::create(['uuid' => \Illuminate\Support\Str::uuid(), 'nom' => 'Bernard', 'prenom' => 'Luc', 'email' => 'luc.bernard@example.com', 'telephone' => '0612345680', 'mot_de_passe' => bcrypt('password'), 'etat' => 'actif']);
        }
    }
}
