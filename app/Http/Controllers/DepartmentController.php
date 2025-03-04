<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Container\Attributes\DB;
use App\Models\WhyChooseUs;

class DepartmentController extends Controller
{
    public function ChooseUsIndex(Request $request){
        $data = WhyChooseUs::latest()->get();
        return view('choose_us.index', compact('data'));
    }

    public function ChooseUsCreate(Request $request){
        return view('choose_us.create');
    }
    public function ChooseUsStore(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'title' => 'required|string|max:255|unique:why_chhose_us,title',
            'description' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png,gif,svg,webp|max:1000',
        ]);
        
        try {
            $data = new WhyChooseUs;
            $data->title = $request->title;
            $data->desc = $request->description;
            // Faculty image
            if ($request->hasFile('image')) {
                $file1 = $request->file('image');
                $fileImageName = time() . rand(10000, 99999) . '.' . $file1->getClientOriginalExtension();
                $file1->move(public_path('uploads/teaching'), $fileImageName);
                // Store the full path of the uploaded file
                $data->image =  'uploads/teaching/' . $fileImageName;
            }
            $data->save();
            // Commit the transaction if everything is successful
            DB::commit();
            return redirect()->route('choose_us.list.all')->with('success', 'New data created');
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollback();
            // You can log the exception if needed
            \Log::error($e);
            // Redirect back with an error message
            return redirect()->back()->with('failure', 'Failed to create data. Please try again.');
        }
    }
    public function ChooseUsEdit($id)
    {
        $data = WhyChooseUs::findOrFail($id);
        return view('choose_us.edit', compact('data'));
    }
    public function ChooseUsUpdate(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('why_chhose_us', 'title')->ignore($request->id),
            ],
            'description'=>[
                'required',
                'string',
            ],
            'image'=>[
                'mimes:jpg,jpeg,png,gif,svg,webp',
                'max:1000'
            ],
        ]);

        try {
            $data = WhyChooseUs::findOrFail($request->id);
            $data->title = $request->title;
            $data->desc = $request->description;
            if ($request->hasFile('image')) {
                $file1 = $request->file('image');
                $fileImageName = time() . rand(10000, 99999) . '.' . $file1->getClientOriginalExtension();
                $file1->move(public_path('uploads/teaching'), $fileImageName);
                $data->image = 'uploads/teaching/' . $fileImageName;
            }             
            $data->save();
            DB::commit();
            return redirect()->route('choose_us.list.all')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return redirect()->back()->with('failure', 'Failed to update data. Please try again.');
        }
    }
    public function ChooseUsStatus(Request $request, $id)
    {
        $data = WhyChooseUs::findOrFail($request->id);
        $data->status = ($data->status == 1) ? 0 : 1;
        $data->update();
        return response()->json([
            'status' => 200,
            'message' => 'Status updated',
        ]);
    }

    public function ChooseUsDelete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = WhyChooseUs::findOrFail($id);
            $data->delete();
            DB::commit();
            return redirect()->route('choose_us.list.all')->with('success', 'data deleted');
        } catch (\Exception $e) {
            DB::rollback();
            // \Log::error($e);
            return redirect()->back()->with('failure', 'Failed to delete data. Please try again.');
        }
    }
}
