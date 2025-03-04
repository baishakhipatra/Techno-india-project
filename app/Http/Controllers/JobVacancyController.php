<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Jobvacancy;
use App\Models\Jobcategories;

class JobVacancyController extends Controller
{

    public function vacancyList(Request $request){
        $keyword = $request->input('keyword');
        $query = Jobvacancy::query();
           
        $query->when($keyword, function ($query) use ($keyword) {
        $query->where('title', 'like', '%'.$keyword.'%')
        ->orWhere('sub_title', 'like', '%'.$keyword.'%')
        ->orWhere('school', 'like', '%'.$keyword.'%')
        ->orWhere('location', 'like', '%'.$keyword.'%');
        })->get();
        $vacancy = $query->latest('id')->where('deleted_at', 1)->paginate(4);
        return view ('jobvacancy.vacancy_list', compact('vacancy'));
        }
        // $vacancy = Jobvacancy::all();

    public function vacancyCreate(){
        $jobCategory = Jobcategories::all();
       return view('jobvacancy.create_vacancy',compact('jobCategory'));
    }

    public function vacancyStore(Request $request){
        $request->validate([
            'title' => 'required|string|max:500',
            'experience' => 'required|string|max:500',
            'sub_title' => 'required|string|max:500',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'school' => 'required|string|max:500',
            'gender' => 'required',
            'no_of_vacancy' => 'required',
        ]);
        $job = Jobvacancy::create([
            'title'=>$request->title,
            'experience'=>$request->experience,
            'sub_title'=>$request->sub_title,
            'category'=>$request->category,
            'location'=>$request->location,
            'school'=>$request->school,
            'gender'=>$request->gender,
            'no_of_vacancy'=>$request->no_of_vacancy,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        $job->update([
            'slug'=>$job->id . '_' .Str::slug($request->title),
        ]);
        return redirect()->route('vacancy.list')->with('success','vacancy added successfully');
    }

    public function vacancyEdit($id){
        $vacancy = Jobvacancy::findOrFail($id);
        $jobCategory = Jobcategories::all();
        return view('jobvacancy.edit_vacancy', compact('vacancy', 'jobCategory'));
    }
    public function vacancyStoreEdit(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:500',
            'experience' => 'required|string|max:500',
            'sub_title' => 'required|string|max:500',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'school' => 'required|string|max:500',
            'gender' => 'required',
            'no_of_vacancy' => 'required',
        ]);

        $vacancy = Jobvacancy::findOrFail($id);
        $vacancy->update([
            'title' => $request->title,
            'slug'=>$vacancy->id . '_' .Str::slug($request->title),
            'experience' => $request->experience,
            'sub_title' => $request->sub_title,
            'category' => $request->category,
            'location' => $request->location,
            'school' => $request->school,
            'gender' => $request->gender,
            'no_of_vacancy' => $request->no_of_vacancy,
            'updated_at' => now(),
        ]);

        return redirect()->route('vacancy.list')->with('success', 'Vacancy updated successfully');
    }

    public function vacancyDelete($id){
        $vacancy = Jobvacancy::findOrFail($id);
        $vacancy->delete();
        return redirect()->route('vacancy.list')->with('success', 'Vacancy deleted successfully');
    }
    public function toggleStatus(Request $request) {
        $status = (int) $request->status == 1 ? 0 : 1;
        Jobvacancy::where('id', $request->id)->update([
        'status' => $status,
        ]);
        return json_encode(['message' => 'Post status updated sucessfully']);
    }
}

