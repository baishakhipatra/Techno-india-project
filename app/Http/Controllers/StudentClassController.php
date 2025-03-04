<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_class;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class StudentClassController extends Controller
{
    public function classList(Request $request){
        $keyword = $request->input('keyword');
        if ($keyword) {
            $data = Student_class::where('name', 'LIKE', "%$keyword%")->get();
        } else {
            $data = Student_class::all();
        }
        return view('student_class.class_list',compact('data'));
    }

    public function classCreate(){
        return view('student_class.class_create');
    }
    public function classStore(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'name'=>'required|string|max:255|unique:student_class,name',
        ]);

        try{
            $data = new Student_class();
            $data->name = $request->name;
            $data->save();
            DB::commit();
            return redirect()->route('class.list')->with('success','new class created');
        }catch(\Exception $e){
            DB::rollback();
            // dd($e->getMessage());
            // \Log::error($e);
            return redirect()->back()->with('failure','failed to create class, try again');
        }
    }

    public function classEdit($id)
    {
        $data = Student_class::findOrFail($id);
        return view('student_class.class_edit', compact('data'));
    }

    public function classstoreEdit(Request $request,$id)
    {
        DB::beginTransaction();
        $request->validate([
            'name'=>[
                'required',
                'string',
                'max:255',
                Rule::unique('student_class', 'name')->ignore($id),
            ],
        ]);

        try{

            $data = Student_class::findorfail($id);
            $data->name = $request->name;
            $data->save();
            DB::commit();
            return redirect()->route('class.list')->with('success','updated');
        }catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with('failure','try again');
        }
    }
    public function classDelete($id)
    {
        DB::beginTransaction();

        try {
            $data = Student_class::findOrFail($id);
            $data->delete();
            DB::commit();
            return redirect()->route('class.list')->with('success', 'Class deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('failure', 'Failed to delete class, try again');
        }
    }
}
