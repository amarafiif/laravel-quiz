<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $member = \App\Models\User::create([
            'name' => 'Muhammad Ammar',
            'username' => 'member',
            'email' => 'member@example.com',
            'password' => bcrypt('password'),
            'role' => 'member',
        ]);

        foreach ([$admin, $member] as $user) {
            $this->command->info("User {$user->role} CREATED: {$user->name}  ({$user->email})");
        }
    }
}
