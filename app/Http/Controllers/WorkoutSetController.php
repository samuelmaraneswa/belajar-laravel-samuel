<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramDayWorkoutSet;
use Illuminate\Support\Facades\Auth;

class WorkoutSetController extends Controller
{
  public function complete(Request $request)
  {
    $data = $request->validate([
      'program_day_workout_id' => 'required|integer',
      'set_number' => 'required|integer|min:1',
    ]);

    ProgramDayWorkoutSet::updateOrCreate(
      [
        'user_id' => Auth::id(),
        'program_day_workout_id' => $data['program_day_workout_id'],
        'set_number' => $data['set_number'],
      ],
      [
        'completed_at' => now(),
      ]
    );

    return response()->json([
      'status' => 'ok',
    ]);
  }
}
