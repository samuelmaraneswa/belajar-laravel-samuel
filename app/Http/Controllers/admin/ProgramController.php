<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramDayWorkoutSet;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->search;

    $query = Program::with(['user', 'days.workouts'])
      ->when($search, function ($q) use ($search) {
        $q->where('title', 'like', "%{$search}%");
      })
      ->latest();

    $programs = $query->paginate(10);

    foreach ($programs as $program) {

      $completedSets = ProgramDayWorkoutSet::where('user_id', $program->user_id)
        ->whereIn(
          'program_day_workout_id',
          $program->days->flatMap(fn($d) => $d->workouts->pluck('id'))
        )
        ->get();

      $dayProgress = [];

      foreach ($program->days as $day) {

        $totalSets = $day->workouts->sum('sets');

        $completedCount = $completedSets
          ->whereIn('program_day_workout_id', $day->workouts->pluck('id'))
          ->count();

        $dayProgress[$day->id] = $totalSets > 0
          ? round(($completedCount / $totalSets) * 100)
          : 0;
      }

      $totalDays = $program->days->count();

      $completedDays = collect($dayProgress)
        ->filter(fn($p) => $p >= 100)
        ->count();

      $program->progress = $totalDays > 0
        ? round(($completedDays / $totalDays) * 100)
        : 0;
    }

    // ✅ AJAX RESPONSE
    if ($request->ajax()) {
      return response()->json([
        'html' => view('admin.programs.partials._table', compact('programs'))->render(),
        'pagination' => [
          'page' => $programs->currentPage(),
          'last' => $programs->lastPage(),
        ]
      ]);
    }

    return view('admin.programs.index', compact('programs'));
  }

  public function destroy(Program $program)
  {
    try {

      $program->delete();

      return response()->json([
        'success' => true,
        'message' => 'Program berhasil dihapus.'
      ]);
    } catch (\Throwable $e) {

      return response()->json([
        'success' => false,
        'message' => 'Gagal menghapus program.'
      ], 500);
    }
  }

  public function suggest(Request $request)
  {
    return Program::where('title', 'like', "%{$request->q}%")
      ->limit(20)
      ->pluck('title');
  }
}
