<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Facility;
use App\Models\Subfacility;

class FacilityController extends Controller
{
    public function facilityList(Request $request)
    {
        $keyword = $request->input('keyword');
        if($keyword)
        {
            $data = Facility::where('deleted_at',1)->where('title', 'LIKE', "%$keyword%")->get();
        }else{
            $data = Facility::where('deleted_at',1)->get();
        }
        return view('facility.facility_list',compact('data'));
    }

    public function facilityCreate()
    {
        return view('facility.create_facility');
    }

    public function facilityStore(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'title'=>'required|string|max:255|unique:facility,title',
            'logo'=>'required|mimes:jpg,jpeg,png,svg,gif,webp|max:1000',
            'image'=>'required|mimes:jpg,jpeg,png,svg,gif,webp|max:1000',
            'description'=>'required|string',
        ]);
        try{
            $data = new facility();
            $data->title = $request->title;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileLogoName = time() . rand(10000, 99999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/facility'), $fileLogoName);
                $data->logo = 'uploads/facility/' . $fileLogoName;
            }
           if($request->hasFile('image')){
              $file1 = $request->file('image');
              $fileImageName = time() . rand(10000, 99999) . '.' . $file1->getClientOriginalExtension();
              $file1->move(public_path('uploads/facility'), $fileImageName);
              $data->image = 'uploads/facility/'. $fileImageName;
           }
            $data->description = $request->description;
            $data->save();
            DB::commit();
            return redirect()->route('facility.list')->with('success','facility added');
        }catch(\Exception $e){
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('failure','try again');
        }
    }

    public function facilityEdit($id)
    {
        $data = Facility::findorfail($id);
        return view('facility.facility_edit',compact('data'));
    }

    public function facilitystoreEdit(Request $request,$id)
    {
        DB::beginTransaction();
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('facility')->ignore($id),
            ],
            'logo' => 'nullable|mimes:jpg,jpeg,png,svg,gif,webp|max:1000',
            'image' => 'nullable|mimes:jpg,jpeg,png,svg,gif,webp|max:1000',
            'description' => 'required|string',
        ]);

        try {
            $data = Facility::findOrFail($id);
            $data->title = $request->title;

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileLogoName = time() . rand(10000, 99999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/facility'), $fileLogoName);
                $data->logo = 'uploads/facility/' . $fileLogoName;
            }

            if ($request->hasFile('image')) {
                $file1 = $request->file('image');
                $fileImageName = time() . rand(10000, 99999) . '.' . $file1->getClientOriginalExtension();
                $file1->move(public_path('uploads/facility'), $fileImageName);
                $data->image = 'uploads/facility/' . $fileImageName;
            }

            $data->description = $request->description;
            $data->save();

            DB::commit();
            return redirect()->route('facility.list')->with('success', 'Facility updated');
        } catch (\Exception $e) {
            DB::rollback();
            // dd($e->getMessage());
            return redirect()->back()->with('failure', 'Try again');
        }
    }

    public function facilityDelete($id)
    {
        DB::beginTransaction();
        // dd($id);
        try {
            $data = Facility::findOrFail($id);
            $data->deleted_at = 0;
            $data->save();
            // $data->delete();
            DB::commit();
            return redirect()->route('facility.list')->with('success', 'facility deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            // dd($e->getMessage());
            return redirect()->back()->with('failure', 'Failed to delete facility, try again');
        }
    }

    public function facilityStatus($id)
    {
        DB::beginTransaction();

        try {
            $data = Facility::findOrFail($id);
            $data->status = !$data->status;
            $data->save();
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Status updated',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 400,
                'message' => 'Failed to delete facility, try again',
            ]);
        }
    }

    public function subfacilityList(Request $request,$id)
    {
        $keyword = $request->input('keyword');
        if($keyword)
        {
            $data = Subfacility::where('title', 'LIKE', "%$keyword%")->get();
        }else{
            $data = Subfacility::all();
        }
        return view('facility.subfacility_view',compact('data','id'));
    }

    public function subfacilityCreate($id){
        return view('subfacility.create',compact('id'));
    }

    public function subfacilityStore(Request $request)
    {
        DB::beginTransaction();
        // dd($request->all());
        $request->validate([
        'facility_id' => 'required|exists:facility,id',
        'title' => 'required|string|max:255|unique:subfacility,title',
        'description' => 'required|string',
        ]);

        try {
        $data = new Subfacility();
        $data->facility_id = $request->facility_id;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();

        DB::commit();
        return redirect()->route('subfacility.list')->with('success', 'Subfacility added');
        } catch (\Exception $e) {
        DB::rollback();
        // dd($e->getMessage());
        return redirect()->back()->with('failure', 'Try again');
         }
    }

    
    public function subfacilityEdit($id)
    {
        $data = Subfacility::findOrFail($id);
        return response()->json($data);
    }

    public function subfacilitystoreEdit(Request $request, $id)
    {
        DB::beginTransaction();
        // dd($request->all());
        $request->validate([
            'title'=>[
                'required',
                'string',
                'max:255',
                Rule::unique('subfacility', 'title')->ignore($id),
            ],
            'description' => 'required|string',
        ]);

        try {
            $data = Subfacility::findOrFail($id);
            $data->title = $request->title;
            $data->description = $request->description;
            $data->save();

            DB::commit();
            return redirect()->route('subfacility.list' ,$id)->with('success', 'Subfacility updated');
        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e->getMessage());
            return redirect()->back()->with('failure', 'Try again');
        }
    }


    public function subfacilityDelete($id)
    {
      DB::beginTransaction();
    //   dd($request->all());
      try{
        $data = Subfacility::findorfail($id);
        $data->delete();
        DB::commit();
        return redirect()->back()->with('success','subfacility deleted');
      }catch(\Exception $e)
      {
        DB::rollback();
        // dd($e->getMessage());
        return redirect()->back()->with('failure','failed to delete,try again');
      }

    }

    public function subfacilityStatus($id)
    {
        DB::beginTransaction();

        try {
            $data = Subfacility::findOrFail($id);
            $data->status = !$data->status;
            $data->save();
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Status updated',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 400,
                'message' => 'Failed to delete facility, try again',
            ]);
        }
    }
}
