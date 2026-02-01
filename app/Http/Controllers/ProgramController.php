<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramDay;
use App\Models\ProgramDayWorkout;
use App\Models\Workout;
use Illuminate\Http\Request;
use App\Services\ProgramGeneratorService;
use App\Services\ProgramTemplates;
use App\Services\WorkoutCalculator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

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
      'goal'    => 'required|string',
      'context' => 'required|string',
      'gender'  => 'required|in:male,female',
      'age'     => 'required|integer|min:13|max:70',
      'height'  => 'required|integer|min:120|max:220',
      'weight'  => 'required|integer|min:30|max:200',
      'level'   => 'required|in:beginner,intermediate,advanced',
    ]);

    $template = ProgramTemplates::resolve($profile);

    if (!$template) {
      return back()->with('error', 'Program belum tersedia untuk pilihan ini.');
    }

    // 🔥 SIMPAN PROGRAM
    $program = Program::create([
      'user_id' => Auth::id(),
      'goal'    => $profile['goal'],
      'context' => $profile['context'],
      'gender'  => $profile['gender'],
      'age'     => $profile['age'],
      'height'  => $profile['height'],
      'weight'  => $profile['weight'],
      'level'   => $profile['level'],
    ]);

    // 🔥 SATU LOOP SAJA
    foreach ($template as $day => $workoutSlugs) {

      // buat day
      $programDay = ProgramDay::create([
        'program_id' => $program->id,
        'day'        => $day,
        'is_rest'    => empty($workoutSlugs),
      ]);

      // rest day → lanjut
      if (empty($workoutSlugs)) {
        continue;
      }

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
    $this->authorize('view', $program); // optional tapi bagus

    return view('programs.result', [
      'program' => $program->load('days.workouts.workout')
    ]);
  }
}
