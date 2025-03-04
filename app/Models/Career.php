<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'job_id',
        'name',
        'email',
        'phone',
        'father_name',
        'date_of_birth',
        'gender',
        'marital_status',
        'address',
        'landmark',
        'pincode',
        'city',
        'dist',
        'state',
        'country',
        'x_school_name',
        'x_board_name',
        'x_percentage',
        'x_passing_year',
        'xii_school_name',
        'xii_board_name',
        'xii_percentage',
        'xii_passing_year',
        'after_xii_qualification',
        'after_xii_institute_name',
        'after_xii_institute_stream',
        'after_xii_institute_percentage',
        'after_xii_institute_passing_year',
        'present_salary',
        'expected_salary',
        'join_time',
        'know_anyone_at_tigs',
        'referrence_details',
        'applied_post',
        'unit_name',
        'subject',
        'aadhar_card_file',
        'pan_card_file',
        'resume_file',
        'signature',
        'x_admit_card',
        'image_file',
    ];

    function Jobs(){
        return $this->belongsTo('App\Models\Jobvacancy', 'job_id', 'id');
    }
}
