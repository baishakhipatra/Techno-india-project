<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarrerHigherStudies extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'after_xii_qualification',
        'after_xii_institute_name',
        'after_xii_institute_board',
        'after_xii_institute_stream',
        'after_xii_institute_percentage',
        'after_xii_institute_passing_year',
    ];
}
