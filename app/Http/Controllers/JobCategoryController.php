<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Jobcategories;

class JobCategoryController extends Controller
{
    public function jobList(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Jobcategories::query();
    
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
    
                $query->where('title', 'like', '%' . $keyword . '%');
            });
        }
        $job = $query->latest('id')
                      ->paginate(25)
                      ->appends(request()->query());
        // $job = Jobcategories::all();
         return view('jobcategory.job_list',compact('job'));
    } 
     public function jobCreate()
     {
        return view('jobcategory.create_job');
     }

     public function jobStore(Request $request)
     {
        $request->validate([
            'title' => 'required|string|max:255|unique:jobcategories,title',
        ]);
        Jobcategories::create([
            'title'=>$request->title,
        ]);
        return redirect()->route('job.list')->with('success','job added successfully');
     }

     public function jobEdit($id)
     {
        $job = Jobcategories::Findorfail($id);
        return view('jobcategory.job_edit',compact('job'));
     }

     public function jobstoreEdit(Request $request,$id)
     {
        $request->validate([
            // 'title' => 'required|string|max:255|unique:unit,title,' . $id
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('jobcategories','title')->ignore($id),
            ],
        ]);
        $job=Jobcategories::Findorfail($id);
        $job->update([
            'title'=>$request->title,
        ]);
        return redirect()->route('job.list')->with('success','job category edited successfully');
     }

     public function jobDelete($id)
     {
        $job=Jobcategories::Findorfail($id);
        $job->delete();
        return redirect()->route('job.list')->with('success','deleted successfully');
     }

     public function toggleStatus(Request $request) {
        $status = (int) $request->status == 1 ? 0 : 1;
        Subject::where('id', $request->id)->update([
        'status' => $status,
        ]);
        return json_encode(['message' => 'Post status updated sucessfully']);
        }
}
