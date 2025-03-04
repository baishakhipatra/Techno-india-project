<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admission_forms extends Model
{
    use HasFactory;
    protected $table = 'admission_forms';

    protected $fillable = [
        'name',
        'dob',
        'class',
        'parent_name',
        'country_code',
        'mobile',
        'email',
        'pincode',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
    ];
}
