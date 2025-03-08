<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\extracurriculars;
use App\Models\Gallery;
use App\Models\TeachingProcess;
use App\Models\WhyChooseUs;
use App\Models\Faculty;

class IndexController extends Controller
{
    public function extra_curricular()
    {
        $ExtraCurricular = extracurriculars::latest()->get();
        return view('front.curricular',compact('ExtraCurricular'));
    }

    public function teaching_process()
    {
        $TeachingProcess = TeachingProcess::latest()->get();
        return view('front.teaching',compact('TeachingProcess'));
    }

    public function why_choose_us()
    {
        $WhyChooseUs = WhyChooseUs::latest()->get();
        $gallery = Gallery::latest()->get();
        return view('front.whychooseus',compact('WhyChooseUs','gallery'));
    }

    public function faculty()
    {
        $class_name = Faculty::select('class_name')->where('status',1)->where('deleted_at',1)->groupBy('class_name')->get();
        $data = Faculty::latest()->where('status',1)->where('deleted_at',1)->get();
        return view('front.faculty',compact('class_name','data'));
    }
}
