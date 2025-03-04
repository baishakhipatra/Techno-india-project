<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Admission_forms;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function addmissionform()
    {
        return view('admin.admission_form');
    }

    public function formsubmit(Request $request)
    {
        // dd($request->all());
         $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'class' => 'required|min:1|max:12',
            'parent_name' => 'required|string',
            'country_code' => 'required|digits_beetween:1,5',
            'mobile' => 'required|digits:10',
            'email' => 'required|email|max:255',
            'pincode' => 'required|digits:6',
            'utm_source' => 'required|string',
            'utm_medium' => 'required|string',
            'utm_campaign' => 'required|string',
            'utm_term' => 'required|string',
            'utm_content' => 'required|string',
        ]);

        Admission_forms::create
        ([
            'name' => $request->name,
            'dob' => $request->dob,
            'class' => $request->class,
            'parent_name' => $request->parent_name,
            'country_code' => $request->country_code,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'pincode' => $request->pincode,
            'utm_source' => $request->utm_source,
            'utm_medium' => $request->utm_medium,
            'utm_campaign' => $request->utm_campaign,
            'utm_term' => $request->utm_term,
            'utm_content' => $request->utm_content,
        ]);
        return redirect()->route('admission.form')->with('success', 'Form submitted successfully!');
    }

    public function admissionlist()
    {
        $admissions= Admission_forms::all();
        return view('admin.view_form', compact('admissions'));
    }

    public function editForm($id)
        {
            $admission = Admission_forms::findOrFail($id);
            return view('admin.edit_form', compact('admission'));
        }
        public function updateForm(Request $request, $id)
        { 
            // dd($request,$id);
            $request->validate([
                'name' => 'required|string|max:255',
                'dob' => 'required|date|before:today',
                'class' => 'required|min:1|max:12',
                'parent_name' => 'required|string',
                'country_code' => 'required|digits_between:1,5',
                'mobile' => 'required|digits:10',
                'email' => 'required|email|max:255',
                'pincode' => 'required|digits:6',
            ]);

            $admission = Admission_forms::findOrFail($id);
            if(!$admission)
            {
                return back()->with('error', 'Records not found');
            }
            $admission->update([
                'name' => $request->name,
                'dob' => $request->dob,
                'class' => $request->class,
                'parent_name' => $request->parent_name,
                'country_code' => $request->country_code,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'pincode' => $request->pincode,
            ]);
            return redirect()->route('admission_list')->with('success', 'Form updated successfully!');
        }
        public function deleteForm($id)
        {
            $admission = Admission_forms::findOrFail($id);
            if(!$admission)
            {
                return back()->with('error', 'Record not found');
            }
            $admission->delete();
            return redirect()->route('admission_list')->with('success', 'Form deleted successfully!');
        }
}

