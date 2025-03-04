<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\TeachingProcess;

use Illuminate\Validation\Rule;

class TeachingController extends Controller
{
    public function teachingList()
    {
        $data = TeachingProcess::latest()->get();
        return view('teaching_process.teacherlist',compact('data'));
    }
    public function teachingCreate()
    {
        return view('teaching_process.create');
    }
    public function teachingStore(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'title' => 'required|string|max:255|unique:teaching_process,title',
            'description' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png,gif,svg,webp|max:1000',
        ]);
        
        try {
            $data = new TeachingProcess;
            $data->title = $request->title;
            $data->desc = $request->description;
            if ($request->hasFile('image')) {
                $file1 = $request->file('image');
                $fileImageName = time() . rand(10000, 99999) . '.' . $file1->getClientOriginalExtension();
                $file1->move(public_path('uploads/teaching'), $fileImageName);
                $data->image =  'uploads/teaching/' . $fileImageName;
            }
            $data->save();
            DB::commit();
            return redirect()->route('teaching.list')->with('success', 'New process created');
        } catch (\Exception $e) {
            DB::rollback();
            // \Log::error($e);
            return redirect()->back()->with('failure', 'Failed to create process. Please try again.');
        } 
    }

    public function teachingEdit($id)
    {
        $data = TeachingProcess::findorFail($id);
        return view('teaching_process.teaching_edit',compact('data'));
    }

    public function teachingEditStore(Request $request, $id)
    {
        DB::beginTransaction();
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('teaching_process','title')->ignore($request->id),
            ],
            'description' => [
                'required',
                'string',
            ],
            'image' => [
                'mimes:jpg,jpeg,png,gif,svg,webp',
                'max:1000'
            ],
        ]);

        try{

            $data = TeachingProcess::findorFail($id);
            $data->title = $request->title;
            $data->desc = $request->description;

            if($request->hasFile('image')){
               $file1 = $request->file('image');
               $fileImageName = time(). rand(10000,99999) . '.' .$file1->getClientOriginalExtension();
               $file1->move(public_path('uploads/teaching'), $fileImageName);

               $data ->image = '/uploads/teaching/'.$fileImageName;
            }
            $data->save();
            DB::commit();
            return redirect()->route('teaching_process.teachinglist')->with('success','updated successfully');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('failure','try again');
        }
    }

    public function teachingDelete($id)
    {

        DB::beginTransaction();
        try{
            $data = TeachingProcess::findorFail($id);
            $data->delete();
            DB::commit();
            return redirect()->route('teaching_process.teachinglist')->with('success','deleted successfully');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('failure','failed to delete');
        }
    }
    public function TeachingStatus($id)
    {
        DB::beginTransaction();
    
        try {
            $teaching = TeachingProcess::findOrFail($id);
            $teaching->status = $teaching->status == "1" ? "0" : "1"; 
            $teaching->save();
            DB::commit();
            return response()->json([
            'status' => 200,
            'message' => 'Status updated',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            //dd($e->getMessage());
            return response()->json([
            'status' => 400,
            'message' => 'Failed to update status, try again',
            ]);
        }
    }

}
