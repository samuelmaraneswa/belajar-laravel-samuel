<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      User::updateOrCreate(
        ['email' => 'info@maskworkout.site'],
        [
          'name' => 'Admin',
          'password' => Hash::make('samueltob1995'),
          'role' => 'admin'
        ]
        );
    }
}
