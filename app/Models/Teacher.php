<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // OPTIONAL: If your table is not named "teachers", uncomment this line
     protected $table = 'teachers';

    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'age',
        'email',
        'subject',
    ];

    public function students()
{
    return $this->hasMany(Student::class);
}

}
