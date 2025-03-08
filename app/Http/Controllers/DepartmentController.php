<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\View;
use Illuminate\Validation\Rule;
use App\Models\WhyChooseUs;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;

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
            if ($request->hasFile('image')) {
                $file1 = $request->file('image');
                $fileImageName = time() . rand(10000, 99999) . '.' . $file1->getClientOriginalExtension();
                $file1->move(public_path('uploads/choose_us'), $fileImageName);
                $data->image =  'uploads/choose_us/' . $fileImageName;
            }
            $data->save();
            DB::commit();
            return redirect()->route('choose_us.list.all')->with('success', 'New data created');
        } catch (\Exception $e) {
            DB::rollback();
            // \Log::error($e);
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
                $file1->move(public_path('uploads/choose_us'), $fileImageName);
                $data->image = 'uploads/choose_us/' . $fileImageName;
            }             
            $data->save();
            DB::commit();
            return redirect()->route('choose_us.list.all')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            // \Log::error($e);
            return redirect()->back()->with('failure', 'Failed to update data. Please try again.');
        }
    }
    public function ChooseUsStatus($id)
    {
        DB::beginTransaction();
        try{
        $data = WhyChooseUs::findOrFail($id);
        $data->status = $data->status == "1" ? "0" : "1";
        $data->save();
        DB::commit();
        return response()->json([
            'status' => 200,
            'message' => 'Status updated',
        ]);
        } 
        catch(\Exception $e){
           DB::rollBack();
           return response()->json([
            'status' => 400,
            'message' => 'Status failed',
        ]);
        }
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

    public function galleryIndex()
    {
        $data = Gallery::latest()->get();
        return view('gallery.index',compact('data'));
    }

    public function galleryCreate()
    {
        return view('gallery.create');
    }

    public function galleryStore(Request $request)
    {
        if($request->type == "image" && !$request->hasFile('file'))
        {
            Session::flash('key', 'Please choose an image');
            return redirect()->route('gallery.create');
        }
        if ($request->type == "video" && !$request->video_path) {
            Session::flash('key', 'Please enter valid video URL path');
            return redirect()->route('gallery.create');
        }

        $data = new Gallery;
        if($request->type=="image"){
            $file = $request->file('file');
            $fileName = time() . rand(10000, 99999) . '.' . $file->getClientOriginalExtension(); 
            $filePath = 'uploads/gallery/' . $fileName; 
            $file->move(public_path('uploads/gallery/'), $fileName);
            $data->image = $filePath;
        }else{
            $data->video = $request->video_path;
        }
        $data->save();
        return redirect()->route('gallery.list.all')->with('success', 'New data created');
    }

    public function galleryEdit($id)
    {
        $data = Gallery::findOrFail($id);
        return view('gallery.edit', compact('data'));
    }

    public function galleryUpdate(Request $request){
        if ($request->type == "image" && !$request->hasFile('file')) {
            Session::flash('key', 'Please choose an image');
            return redirect()->back();
        }
        if ($request->type == "video" && !$request->video_path) {
            Session::flash('key', 'Please enter valid video URL path');
            return redirect()->back();
        }
        $data = Gallery::findOrFail($request->id);
        if($request->type=="image"){
            $file = $request->file('file');
            $fileName = time() . rand(10000, 99999) . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/gallery/' . $fileName;
            $file->move(public_path('uploads/gallery/'), $fileName);
            $data->image = $filePath;
            $data->video = null;
        }else{
            $data->video = $request->video_path;
            $data->image = null;
        }
        $data->save();
        return redirect()->route('gallery.list.all')->with('success', 'New data created');
    }
    public function galleryDelete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = Gallery::findOrFail($request->id);
            $data->delete();
            DB::commit();
            return redirect()->route('gallery.list.all')->with('success', 'data deleted');
        } catch (\Exception $e) {
            DB::rollback();
            // \Log::error($e);
            return redirect()->back()->with('failure', 'Failed to delete data. Please try again.');
        }
    }

    public function settings(Request $request)
    {
         $data = Setting::get();
        return view('settings.content',compact('data'));
    }

    public function settingUpdate(Request $request)
    {
        
        $request->validate([
            'official_phone1' => 'required|integer|digits:10',
            'official_phone2' => 'nullable|integer|digits:10',
            'official_email' => 'required|email|min:5|max:255',
            'website_link' => 'required|min:5|max:255',
            'full_company_name' => 'required|string|min:1|max:255',
            'pretty_company_name' => 'required|string|min:1|max:255',
            'company_short_desc' => 'required|string|min:5|max:1000',
            'company_full_address' => 'required|string|min:5|max:1000',
            'google_map_address_link' => 'required|string|min:5',
        ]);

        Setting::where('title', 'official_phone1')->update([
            'content' => $request->official_phone1
        ]);
        Setting::where('title', 'website_link')->update([
            'content' => $request->website_link
        ]);
        Setting::where('title', 'official_phone2')->update([
            'content' => $request->official_phone2
        ]);
        Setting::where('title', 'official_email')->update([
            'content' => $request->official_email
        ]);
        Setting::where('title', 'full_company_name')->update([
            'content' => $request->full_company_name
        ]);
        Setting::where('title', 'pretty_company_name')->update([
            'content' => $request->pretty_company_name
        ]);
        Setting::where('title', 'company_short_desc')->update([
            'content' => $request->company_short_desc
        ]);
        Setting::where('title', 'company_full_address')->update([
            'content' => $request->company_full_address
        ]);
        Setting::where('title', 'google_map_address_link')->update([
            'content' => $request->google_map_address_link
        ]);

        return redirect()->back()->with('success', 'Content updated');
    }
}
