<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pens.ac.id'],
            [
                'nama' => 'admin Perpustakaan',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas1@pens.ac.id'],
            [
                'nama' => 'petugas 1',
                'password' => Hash::make('password'),
                'role' => 'petugas',
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas2@pens.ac.id'],
            [
                'nama' => 'petugas 2',
                'password' => Hash::make('password'),
                'role' => 'petugas',
            ]
        );
    }
}
