<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Student_class extends Model
{
    use HasFactory;
    protected $table = 'student_class';
     
    protected $fillable = ([
        'name',
        'status',
    ]);
}
