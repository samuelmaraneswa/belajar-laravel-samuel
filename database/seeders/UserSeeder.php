<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    $users = [
      [
        'id' => 1,
        'name' => 'Admin',
        'email' => 'admin@gymweb.test',
        'email_verified_at' => '2026-01-30 09:16:14',
        'password' => '$2y$12$DTNqJSuVAnfNwaVDt8Ugk.iGbwDOio6tn1GTcrhhX7jVBXLdP8jPC',
        'role' => 'admin',
        'created_at' => '2026-01-14 09:33:15',
        'updated_at' => '2026-01-14 09:33:15',
      ],
      [
        'id' => 3,
        'name' => 'sam',
        'email' => 'samuelmaraneswa60@gmail.com',
        'email_verified_at' => '2026-01-30 09:16:14',
        'password' => '$2y$12$g3maH0OScLh6Mp5Redq/Ue2Z6386GJlfycWh176Ct1c02ZuwTIrTS',
        'role' => 'user',
        'created_at' => '2026-01-30 09:13:25',
        'updated_at' => '2026-01-30 09:16:14',
      ],
      [
        'id' => 4,
        'name' => 'test',
        'email' => 'test@gmail.com',
        'email_verified_at' => null,
        'password' => '$2y$12$6UQujdr15BqfKiLNio9XNecwtDIr8n8r96ynjdscwunR0ZYtQR20i',
        'role' => 'user',
        'created_at' => '2026-01-30 22:36:40',
        'updated_at' => '2026-01-30 22:36:40',
      ],
      [
        'id' => 6,
        'name' => 'samuel',
        'email' => 'samuelmaraneswa120@gmail.com',
        'email_verified_at' => '2026-01-30 23:32:39',
        'password' => '$2y$12$TfCvsiw2q19i5l9AgBqdXuep3Gg3OJ3NnZIutEl7iKoKcbaJqJjfG',
        'role' => 'user',
        'created_at' => '2026-01-30 23:20:14',
        'updated_at' => '2026-01-30 23:32:39',
      ],
    ];

    foreach ($users as $user) {
      User::updateOrCreate(
        ['id' => $user['id']],
        $user
      );
    }
  }
}
