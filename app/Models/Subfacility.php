<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Subfacility extends Model
{
    use HasFactory;
    protected $table = 'subfacility';

    protected $fillable = 
        [
        'facility_id', 
        'title', 
        'description'
       ];
}
