<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ])->assignRole('admin');

        \App\Models\User::factory()->create([
            'name' => 'manger User',
            'email' => 'manger@example.com',
            'password' => 'password'
        ])->assignRole('manager');
    }
}