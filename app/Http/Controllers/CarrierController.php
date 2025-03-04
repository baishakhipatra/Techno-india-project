<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Jobvacancy;
use App\Models\Subject;
use App\Models\Unit;
use App\Models\Post;
use App\Models\Career_experiences;
use App\Models\CarrerHigherStudies;
use App\Models\Career;

class CarrierController extends Controller
{
    public function career(Request $request){

        $jobs = Jobvacancy::latest()->where('status',1)->where('deleted_at', 1);

        if ($request->location)
        {
            $jobs->where('location',$request->location);
        }
        if ($request->category)
        {
            $jobs->where('category',$request->category);
        }
        $data = $jobs->latest()->get();

        $uniqueCategories = Jobvacancy::select('category')
        ->where('status', 1)
        ->where('deleted_at', 1)
        ->groupBy('category')
        ->pluck('category');

        $uniqueLocations = Jobvacancy::select('location')->where('deleted_at', 1)
        ->where('status', 1)
        ->groupBy('location')
        ->pluck('location');
    
        return view('front.career.index',compact('data','uniqueCategories','uniqueLocations'));
    }

    public function confirmation(){
        return view ('front.career.career-confirmation');
    }

    public function careerApplicationForm($slug)
    {
        $subject = Subject::latest()->where('status',1)->get();
        $unit = Unit::latest()->where('status',1)->get();
        $post = Post::latest()->where('status',1)->get();
        $data = Jobvacancy::where('slug',$slug)->first();
        // dd($data);
        if ($data)
        {
            return view('front.career.application_form',compact('data','subject','unit','post'));
        }else{
            return redirect()->back()->with('failure','try again');
        }  
    }

    public function ApplicationformSubmit(Request $request)
    {
       DB::beginTransaction();
       $career = Career::latest()->first();
       try{
        // if ($career) {
        //     $lastRegistrationid = $career->registration_id;
        //     $position = strpos($lastRegistrationid, '-');
        
        //     if ($position !== false) {
        //         $lastSerial = (int) substr($lastRegistrationid, $position + 1);
        //     } else {
        //         $lastSerial = 0; 
        //     }
        
        //     $nextSerial = $lastSerial + 1;
        //     $newRegistrationId = 'TIGWS-' . str_pad($nextSerial, 5, '0', STR_PAD_LEFT);
        // } else {
        //     $newRegistrationId = 'TIGWS-00001';
        // }
        if ($career) {
            $lastRegistrationid = $career->registration_id;
            $position = strpos($lastRegistrationid, '-');
    
            if ($position !== false) {
                $lastSerial = (int) substr($lastRegistrationid, $position + 1);
            } else {
                $lastSerial = 0; 
            }
    
            $nextSerial = $lastSerial + 1;
            $newRegistrationId = 'TIGWS-' . str_pad($nextSerial, 5, '0', STR_PAD_LEFT);
        } else {
            $newRegistrationId = 'TIGWS-00001';
        }
    
        // Save to database
        $career = new Career();
        $career->registration_id = $newRegistrationId;
        $career->save();
    
        // Store in session
        session(['registration_id' => $newRegistrationId]);
    
        return response()->json([
            'status' => 200,
            'message' => 'Application submitted successfully!',
            'data' => $newRegistrationId,
        ]);
        
    
    
    
        $career = New Career();
        $career->name = $request->name;
        $career->email = $request->email;
        $career->job_id = $request->job_id;
        $career->registration_id = $newRegistrationId;
        $career->father_name = $request->father_name;
        $career->phone = $request->phone;
        $career->date_of_birth = $request->date_of_birth;
        $career->gender = $request->gender;
        $career->merital_status = $request->merital_status;
        $career->address = $request->address;
        $career->landmark = $request->landmark;
        $career->pincode = $request->pincode;
        $career->city = $request->city;
        $career->pincode = $request->pincode;
        $career->dist = $request->dist;
        $career->state = $request->state;
        $career->country = $request->country;
        $career->x_school_name = $request->x_school_name;
        $career->x_board_name = $request->x_board_name;
        $career->x_percentage = $request->x_percentage;
        $career->x_passing_year = $request->x_passing_year;
        $career->xii_school_name = $request->xii_school_name;
        $career->xii_board_name = $request->xii_board_name;
        $career->xii_percentage = $request->xii_percentage;
        $career->xii_passing_year = $request->xii_passing_year;
        $career->present_salary = $request->present_salary;
        $career->expected_salary = $request->expected_salary;
        $career->join_time = $request->join_time;
        $career->know_anyone_at_tigs = $request->knowanyone;
        $career->referrence_details = $request->knowanyone == "yes" ? $request->referrence_details : "";
        $career->applied_post = $request->applied_post;
        $career->unit_name = $request->unit_name;
        $career->subject =  $request->subject;

        $career->save();

        $imageFields = [
            'aadhar_card_file',
            'pan_card_file',
            'signature',
            'x_admit_card',
            'resume_file',
            'image_file',
        ];

        $uploadpath = 'uploads/form';
        foreach ($imageFields as $field)
        if($request->hasFile($field))
        {
            $file = $request->file($field);
            $randomnumber = mt_rand(10000000 , 99999999);
            $localTime = now()->format('Ymdhis');
            $uniquename = $localTime . $randomnumber;
            $extension = $file->getClientOriginalExtension();
            $fileName = $uniquename . '.' .$extension;
            $filePath = $file->move($uploadpath , $fileName);
            $career->$field = $filePath;
        }

        $career->save();

        if($request->has('experience_type') && $request->has('experience_duration'))
        {
            $experienceTypes = $request->experience_type;
            $experienceDurations = $request->experience_duration;
            foreach($experienceTypes as $key => $type)
            {
                $career_experience = new Career_experiences;
                $career_experience->career_id = $career->id;
                $career_experience->experience_type = $type;
                $career_experience->experience_duration = $experienceDurations[$key];
                $career_experience->save();
            }
        }

        if($request->has('after_xii_qualification'))
        //dd($request->all());
        {
            $after_xii_qualifications = $request->after_xii_qualification;
            $after_xii_institute_names = $request->after_xii_institute_name;
            $after_xii_institute_boards = $request->after_xii_institute_board;
            $after_xii_institute_streams = $request->after_xii_institute_stream;
            $after_xii_institute_percentages = $request->after_xii_institute_percentage;
            $after_xii_institute_passing_years = $request->after_xii_institute_passing_year;
        }

        foreach($after_xii_qualifications as $key => $qualification)
        {
            $carrerHigherStudies = new carrerHigherStudies;
            $carrerHigherStudies->career_id = $career->id;
            $carrerHigherStudies->after_xii_qualification = $qualification;
            $carrerHigherStudies->after_xii_institute_name = $after_xii_institute_names[$key];
            $carrerHigherStudies->after_xii_institute_board = $after_xii_institute_boards[$key];
            $carrerHigherStudies->after_xii_institute_stream = $after_xii_institute_streams[$key];
            $carrerHigherStudies->after_xii_institute_percentage = $after_xii_institute_percentages[$key];
            $carrerHigherStudies->after_xii_institute_passing_year = $after_xii_institute_passing_years[$key];
            $carrerHigherStudies->save(); 
        }

        DB::commit();
        return response()->json(['status'=>200, 'message'=>'Data inserted successfully']);
       }catch(\Exception $e)
       {
        DB::rollback();
        return response()->json(['error' => $e->getMessage()],500);
       }     
    }
}
