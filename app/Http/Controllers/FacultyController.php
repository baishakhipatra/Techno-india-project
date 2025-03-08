<?php

namespace App\Http\Controllers;

use App\Models\Student_class;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FacultyController extends Controller
{
    public function facultyIndex(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Faculty::query();
    
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }
        $data = $query->latest('id')
                      ->paginate(25)
                      ->appends(request()->query());
        return view('faculty.index', compact('data'));
    }

    public function facultyCreate()
    {
        $studentClass = Student_class::where('status',1)->where('deleted_at',1)->get();
        return view('faculty.create',compact('studentClass'));
    }

    public function facultyStore(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255|unique:faculties,name',
            'designation' => 'required|string|max:255',
            'description' => 'required|string',
            'class_name' => 'required|string',
            'pic' => 'required|mimes:jpg,jpeg,png,gif,svg,webp|max:1000'

        ]);
        $file = $request->file('pic');
        $fileName = time() . rand(10000, 99999) . '.' . $file->getClientOriginalExtension(); 
        $filePath = 'uploads/faculty/' . $fileName; 
        $file->move(public_path('uploads/faculty/'), $fileName); 
        DB::beginTransaction();
        // dd($request->all());
        try {
            $data = new Faculty;
            $data->name = $request->name;
            $data->class_name = $request->class_name;
            $data->designation = $request->designation;
            $data->desc = $request->description;
            $data->facebook_link = $request->facebook_link;
            $data->twitter_link = $request->twitter_link;
            $data->instagram_link = $request->instagram_link;
            $data->image = $filePath;
            $data->save();
            DB::commit();
            return redirect()->route('faculty.list.all')->with('success', 'New faculty created');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            // \Log::error($e);
            return redirect()->back()->with('failure', 'Failed to create faculty. Please try again.');
        }
    }
    public function facultyEdit($id)
    {
        $studentClass = Student_class::where('status',1)->where('deleted_at',1)->get();
        $data = Faculty::findorFail($id);
        return view('faculty.edit',compact('studentClass','data'));
    }

    public function facultyUpdate(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('faculties','name')->ignore($request->id),
            ],'designation' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],
            'class_name' => [
                'required',
                'string',
            ],
            
            'pic' => [
                'mimes:jpg,jpeg,png,gif,svg',
                'max:1000',
            ],

        ],[
            'pic.max' => 'The image must not be greater than 1MB.'
        ]);

        try {
            $data = Faculty::findOrFail($request->id);
            $data->name = $request->name;
            $data->class_name = $request->class_name;
            $data->designation = $request->designation;
            $data->desc = $request->description;
            $data->facebook_link = $request->facebook_link;
            $data->twitter_link = $request->twitter_link;
            $data->instagram_link = $request->instagram_link;
            if($request->pic){
                $file = $request->file('pic');
               
                $fileName = time() . rand(10000, 99999) . '.' . $file->getClientOriginalExtension();
                $filePath = 'uploads/faculty/' . $fileName; 
                $file->move(public_path('uploads/faculty/'), $fileName); 

            $data->image = $filePath;    
            }else{
            $data->image = $request->old_faculty_img;    
            }
            $data->save();
            DB::commit();
            return redirect()->route('faculty.list.all')->with('success', 'Faculty updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            // $e->getMessage();
            // \Log::error($e);
            return redirect()->back()->with('failure', 'Failed to update faculty. Please try again.');
        }
    }

    public function facultyStatus($id)
    {
        DB::beginTransaction();
        try{
            $data = Faculty::findorFail($id);
            $data->status = ($data->status == 1) ? 0 : 1;
            $data->update();
            return response()->json([
                'status' => 200,
                'message' => 'status updated',
            ]);
        }catch(\Exception $e)
        {
            DB::rollBack();
           return response()->json([
            'status' => 400,
            'message' => 'Status failed',
        ]);
        }
    }

    public function facultyDelete($id)
    {
        DB::beginTransaction();
        try{
            $data = Faculty::findorFail($id);
            $data->delete();
            DB::commit();
            return redirect()->route('faculty.list.all')->with('success', 'data deleted');
        } catch (\Exception $e) {
            DB::rollback();
            // \Log::error($e);
            return redirect()->back()->with('failure', 'Failed to delete data. Please try again.');
        }
    }
}
