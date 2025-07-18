<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $fillable = [
    'roll_number',
    'name',
    'email',
    'age',
    'bengali',
    'english',
    'math',
    'teacher_id'
];

public function teacher()
{
    return $this->belongsTo(\App\Models\Teacher::class);
}


}


