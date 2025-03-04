<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\str;

class Jobvacancy extends Model
{
    use HasFactory;
    protected $table = 'jobvacancy'; 

    protected $fillable = ([
        'title',
        'slug',
        'subtitle',
        'gender',
        'experience',
        'no_of_vacancy',
        'school',
        'category',
        'location',
        'short_description',
        'status',
        'deleted_at',
    ]);
    public $timestamps = false;

        protected static function boot()
        {
            parent::boot();    
            static::creating(function ($job) {
                if (empty($job->slug)) { 
                    $job->slug = generateSlug($job->title, (new self)->getTable()); 
                }
            });
    
            static::updating(function ($job) {
                if (empty($job->slug)) { 
                    $job->slug = generateSlug($job->title, (new self)->getTable()); 
                }
            });
        } 
}
