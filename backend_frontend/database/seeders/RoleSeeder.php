<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'code' => 'admin',
                'libelle' => 'Administrateur',
                'description' => 'Accès complet au système',
            ],
            [
                'code' => 'agent',
                'libelle' => 'Agent de Support',
                'description' => 'Peut gérer les tickets et réclamations',
            ],
            [
                'code' => 'client',
                'libelle' => 'Client',
                'description' => 'Peut créer des tickets et réclamations',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['code' => $role['code']],
                $role
            );
        }
    }
}
