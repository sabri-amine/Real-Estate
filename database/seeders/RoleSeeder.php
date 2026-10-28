<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les rôles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $agentRole = Role::firstOrCreate(['name' => 'agent']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Créer l'utilisateur Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
            ]
        );
        $admin->roles()->sync([$adminRole->id]);

        // Créer l'utilisateur Agent
        $agent = User::firstOrCreate(
            ['email' => 'agent@test.com'],
            [
                'name' => 'Agent User',
                'password' => Hash::make('password123'),
            ]
        );
        $agent->roles()->sync([$agentRole->id]);

        // Créer l'utilisateur User
        $user = User::firstOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password123'),
            ]
        );
        $user->roles()->sync([$userRole->id]);

        $this->command->info('Rôles et utilisateurs de test créés avec succès !');
    }
}
