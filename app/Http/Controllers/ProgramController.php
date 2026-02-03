<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramDay;
use App\Models\ProgramDayWorkout;
use App\Models\ProgramDayWorkoutSet;
use App\Models\Workout;
use Illuminate\Http\Request;
use App\Services\ProgramGeneratorService;
use App\Services\ProgramTemplates;
use App\Services\WorkoutCalculator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
  use AuthorizesRequests;

  public function index()
  {
    $programs = Program::where('user_id', Auth::id())
      ->latest()
      ->get();

    return view('programs.index', compact('programs'));
  }

  public function create()
  {
    return view('programs.generate');
  }

  public function store(Request $request, ProgramGeneratorService $generator)
  {
    $profile = $request->validate([
      'goal'          => 'required|string',
      'context'       => 'required|string',
      'gender'        => 'required|in:male,female',
      'age'           => 'required|integer|min:13|max:70',
      'height'        => 'required|integer|min:120|max:220',
      'weight'        => 'required|integer|min:30|max:200',
      'target_weight' => 'required|integer|min:30|max:200',
      'level'         => 'required|in:beginner,intermediate,advanced',
    ]);

    $template = ProgramTemplates::resolve($profile);

    if (!$template) {
      return back()->with('error', 'Program belum tersedia untuk pilihan ini.');
    }

    // ===== PROGRAM TITLE =====
    $goalLabel = Str::title(str_replace('_', ' ', $profile['goal']));
    $programTitle = "{$goalLabel} ({$profile['weight']} → {$profile['target_weight']} kg)";

    // ===== CREATE PROGRAM =====
    $program = Program::create([
      'user_id'       => Auth::id(),
      'title'         => $programTitle,
      'goal'          => $profile['goal'],
      'context'       => $profile['context'],
      'gender'        => $profile['gender'],
      'age'           => $profile['age'],
      'height'        => $profile['height'],
      'weight'        => $profile['weight'],
      'target_weight' => $profile['target_weight'],
      'level'         => $profile['level'],
    ]);

    // ===== CREATE PROGRAM DAYS & WORKOUTS =====
    foreach ($template as $day => $data) {

      $dayTitle = $data['title'] ?? null;
      $workoutSlugs = $data['workouts'] ?? [];

      $programDay = ProgramDay::create([
        'program_id' => $program->id,
        'day'        => $day,
        'title'      => $dayTitle,
        'is_rest'    => empty($workoutSlugs),
      ]);

      if (empty($workoutSlugs)) continue;

      $order = 1;

      foreach ($workoutSlugs as $slug) {
        $workout = Workout::where('slug', $slug)->first();
        if (!$workout) continue;

        $calc = WorkoutCalculator::calculate($profile, $workout);
        $plan = $calc[$profile['level']] ?? reset($calc);

        ProgramDayWorkout::create([
          'program_day_id' => $programDay->id,
          'workout_id'     => $workout->id,
          'sets'           => $plan['sets'] ?? null,
          'reps'           => $plan['reps'] ?? null,
          'weight'         => $plan['weight'] ?? null,
          'duration'       => $plan['duration'] ?? null,
          'calories'       => $plan['calories'] ?? null,
          'order'          => $order++,
        ]);
      }
    }

    return redirect()->route('programs.show', $program);
  }

  public function show(Program $program)
  {
    $this->authorize('view', $program);

    $program->load('days.workouts.workout');

    $completedSets = ProgramDayWorkoutSet::where('user_id', Auth::id())
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

    // ⬇️ HITUNG SETELAH LOOP
    $totalDays = $program->days->count();

    $completedDays = collect($dayProgress)
      ->filter(fn($p) => $p >= 100)
      ->count();

    $programProgress = $totalDays > 0
      ? round(($completedDays / $totalDays) * 100)
      : 0;

    return view('programs.result', [
      'program'         => $program,
      'dayProgress'     => $dayProgress,
      'programProgress' => $programProgress,
    ]);
  }

  public function showDay(Program $program, int $day)
  {
    $day = $program->days()
      ->with(['workouts.workout'])
      ->where('day', $day)
      ->firstOrFail();

    $completedSets = ProgramDayWorkoutSet::where('user_id', Auth::id())
      ->whereIn('program_day_workout_id', $day->workouts->pluck('id'))
      ->get();

    return view('programs.day-show', [
      'program'       => $program,
      'day'           => $day,
      'completedSets' => $completedSets,
    ]);
  }
}
