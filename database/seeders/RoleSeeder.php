<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Models\User::create([
            'name' => 'Bagus Hary',
            'email' => 'bagus@banget.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);

        $role = Models\Role::create([
            'name' => 'admin'
        ]);

        $user->roles()->attach($role->id);
    }
}
