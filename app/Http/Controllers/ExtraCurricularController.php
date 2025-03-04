<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\extracurriculars;
use Illuminate\Validation\Rule;

class extraCurricularController extends Controller
{
    public function curricularList(Request $request)
    {
        $keyword = $request->input('keyword');
        if($keyword)
        {
            $data = extracurriculars::where('title', 'LIKE', "%$keyword%")->get();
        }else{
            $data = extracurriculars::all();
         }
        return view('curricular.curricular_list',compact('data'));
    }

    public function curricularCreate()
    {
        return view('curricular.create_curricular');
    }

    public function curricularStore(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'title'=>'required|string|max:255|unique:extracurriculars,title',
            'image'=>'required|mimes:jpg,jpeg,png,svg,gif,webp|max:1000',
            'description'=>'required|string',
        ]);
        try{
            $data = new extracurriculars();
            $data->title = $request->title;
           if($request->hasFile('image')){
              $file1 = $request->file('image');
              $fileImageName = time() . rand(10000, 99999) . '.' . $file1->getClientOriginalExtension();
              $file1->move(public_path('uploads/curricular'), $fileImageName);
              $data->image = 'uploads/curricular/'. $fileImageName;
           }
            $data->description = $request->description;
            $data->save();
            DB::commit();
            return redirect()->back()->with('success','curricular added');
        }catch(\Exception $e){
            DB::rollback();
            // dd($e->getMessage());
             return redirect()->back()->with('failure','try again');
        }
    }

    public function curricularEdit($id)
    {
        $data = extracurriculars::findOrFail($id);
        return view('curricular.edit_curricular', compact('data'));
    }

    public function curricularstoreEdit(Request $request,$id)
    {
        DB::beginTransaction();
        $request->validate([
            // 'title' => [
            //     'required',
            //     'string',
            //     'max:255',
            //     Rule::unique('extracurriculars')->ignore($id),
            // ],
             'title'=>'required|string|max:255|unique:extracurriculars,title,'.$id,
            'image'=>'nullable|mimes:jpg,jpeg,png,svg,gif,webp|max:1000',
            'description'=>'required|string',
        ]);
        try{
            $data = extracurriculars::findOrFail($id);
            $data->title = $request->title;
            if($request->hasFile('image')){
                if ($data->image && file_exists(public_path($data->image))) {
                    unlink(public_path($data->image));
                }
                $file1 = $request->file('image');
                $fileImageName = time() . rand(10000, 99999) . '.' . $file1->getClientOriginalExtension();
                $file1->move(public_path('uploads/curricular'), $fileImageName);
                $data->image = 'uploads/curricular/'. $fileImageName;
            }
            $data->description = $request->description;
            $data->save();
            DB::commit();
            return redirect()->route('extracurricular.list')->with('success','curricular updated');
        }catch(\Exception $e){
            DB::rollback();
            // dd($e->getMessage());
            return redirect()->back()->with('failure','try again');
        }
    }


    public function curricularDelete($id)
    {
      DB::beginTransaction();
    //   dd($request->all());
      try{
        $data = extracurriculars::findorfail($id);
        $data->delete();
        DB::commit();
        return redirect()->back()->with('success','curricular deleted');
      }catch(\Exception $e)
      {
        DB::rollback();
        // dd($e->getMessage());
        return redirect()->back()->with('failure','failed to delete,try again');
      }

    }
}