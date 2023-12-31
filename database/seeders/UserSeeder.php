<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin IT',
            'email' => 'bintangmfhd@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        $user->assignRole('Super Admin');
    }
}