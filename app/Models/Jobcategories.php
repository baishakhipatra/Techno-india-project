<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobcategories extends Model
{
    protected $table = 'jobcategories';
    protected $fillable =[
        'title',
        'status',
    ];
    public $timestamps = 'false';
}
