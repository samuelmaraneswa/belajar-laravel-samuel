<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramDayWorkoutSet;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
    $userId = Auth::id();

    $program = Program::where('user_id', $userId)
      ->with('days.workouts')
      ->latest()
      ->first();

    if (!$program) {
      return view('user.dashboard', [
        'activeProgram' => null,
      ]);
    }

    // total days
    $totalDays = $program->days->count();

    // ambil semua set yang sudah completed
    $completedSets = ProgramDayWorkoutSet::where('user_id', $userId)
      ->whereIn(
        'program_day_workout_id',
        $program->days->flatMap(fn($d) => $d->workouts->pluck('id'))
      )
      ->get();

    // cari current day (hari pertama yang belum 100%)
    $currentDay = 1;

    foreach ($program->days as $day) {
      $totalSets = $day->workouts->sum('sets');

      $completedCount = $completedSets
        ->whereIn('program_day_workout_id', $day->workouts->pluck('id'))
        ->count();

      if ($totalSets === 0 || $completedCount < $totalSets) {
        $currentDay = $day->day;
        break;
      }
    }

    return view('user.dashboard', [
      'activeProgram' => $program,
      'currentDay'    => $currentDay,
      'totalDays'     => $totalDays,
    ]);
  }
}
