<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    // User::factory()->create([
    //   'name' => 'Test User',
    //   'email' => 'test@example.com',
    // ]);

    $this->call(AdminUserSeeder::class);
    $this->call(MuscleSeeder::class);
    $this->call(WorkoutSeeder::class);
    $this->call(WorkoutCategorySeeder::class);
    $this->call(EquipmentSeeder::class);
    $this->call(EquipmentWorkoutSeeder::class);
    $this->call(WorkoutContextsSeeder::class);
    $this->call(WorkoutInstructionSeeder::class);
    $this->call(MuscleWorkoutSeeder::class);
    $this->call(WorkoutContextWorkoutSeeder::class);
  }
}
