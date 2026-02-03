<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;

  public function run(): void
  {
    // 1️⃣ User & Auth
    $this->call(AdminUserSeeder::class);
    $this->call(UserSeeder::class);

    // 2️⃣ Master Data (tidak punya FK)
    $this->call(MuscleSeeder::class);
    $this->call(WorkoutCategorySeeder::class);
    $this->call(EquipmentSeeder::class);
    $this->call(WorkoutContextsSeeder::class);

    // 3️⃣ Core Entity
    $this->call(WorkoutSeeder::class);
    
    // 5️⃣ Pivot Tables
    $this->call(MuscleWorkoutSeeder::class);
    $this->call(EquipmentWorkoutSeeder::class);
    $this->call(WorkoutContextWorkoutSeeder::class);
    
    // 4️⃣ Dependent (FK ke workout)
    $this->call(WorkoutInstructionSeeder::class);
  }
}
