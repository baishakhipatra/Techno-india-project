<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class extracurriculars extends Model
{
    protected $table = 'extracurriculars';
    protected $fillable = [
        'title',
        'image',
        'description',
        'status',
    ];
}
