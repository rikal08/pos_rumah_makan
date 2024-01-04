<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Prima',
            'email' => 'prima@gmail.com',
            'password' => Hash::make('123'),
            'level'=>1
        ]);

        \App\Models\User::factory()->create([
            'name' => 'RM. Yuanda Jaya',
            'email' => 'yuandajaya@gmail.com',
            'password' => Hash::make('123'),
            'level'=>2
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Putri',
            'email' => 'putri@gmail.com',
            'password' => Hash::make('123'),
            'level'=>3
        ]);

        
    }
}
