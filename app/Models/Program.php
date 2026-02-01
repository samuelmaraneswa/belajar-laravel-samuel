<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
  protected $fillable = [
    'user_id',
    'goal',
    'context',
    'gender',
    'age',
    'height',
    'weight',
    'level',
  ];

  public function days()
  {
    return $this->hasMany(ProgramDay::class);
  }
}
