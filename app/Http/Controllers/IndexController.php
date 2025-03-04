<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\extracurriculars;
use App\Models\TeachingProcess;



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
}
