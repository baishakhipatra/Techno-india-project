<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\CarrerHigherStudies;
use App\Models\Career_experiences;

class JobApplicationController extends Controller
{
    public function applicationList(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $query = Career::query();

        $query->when($keyword, function($query) use ($keyword) {
            $query->where('name','like', '%'. $keyword .'%')
            ->orWhere('registration_id','like', '%'. $keyword .'%')
            ->orWhere('email','like', '%'. $keyword .'%')
            ->orWhere('phone','like', '%'. $keyword .'%')
            ->orWhere('pincode','like', '%'. $keyword .'%');
        });
        $data = $query->latest('id')->where('deleted_at',1)->paginate(25);
       return view('jobapplication.list',compact('data')); 
    }

    public function viewApplication($id){ 
        $data = Career::findOrFail($id);
        $higherStudies = CarrerHigherStudies::where('career_id',$id)->get();
        $experience = Career_experiences::where('career_id', $id)->get();

        return view('jobapplication.view',compact('data','higherStudies','experience'));
    }
}
