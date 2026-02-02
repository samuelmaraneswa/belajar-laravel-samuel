<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
  protected $fillable = [
    'user_id',
    'title',
    'goal',
    'context',
    'gender',
    'age',
    'height',
    'weight',
    'target_weight',
    'level',
  ];

  public function days()
  {
    return $this->hasMany(ProgramDay::class);
  }
}
