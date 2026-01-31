<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProgramGeneratorService;

class ProgramController extends Controller
{
  public function create()
  {
    return view('programs.generate');
  }

  public function store(Request $request, ProgramGeneratorService $generator)
  {
    // validasi ringan (wizard sudah membatasi pilihan)
    $profile = $request->validate([
      'goal'   => 'required|string',
      'context' => 'required|string',
      'gender' => 'required|in:male,female',
      'age'    => 'required|integer|min:13|max:70',
      'height' => 'required|integer|min:120|max:220',
      'weight' => 'required|integer|min:30|max:200',
      'level'  => 'required|in:beginner,intermediate,advanced',
    ]);

    // generate 30 days program
    $program = $generator->generate($profile);

    // sementara: tampilkan hasil
    return view('programs.result', [
      'program' => $program,
      'profile' => $profile,
    ]);
  }
}
