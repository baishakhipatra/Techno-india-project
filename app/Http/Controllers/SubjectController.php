<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function sublist(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Subject::query();
    
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
    
                $query->where('title', 'like', '%' . $keyword . '%');
            });
        }
        $subject = $query->latest('id')
                      ->paginate(25)
                      ->appends(request()->query());
    
        // $subject = Subject::all();
         return view('subject.sub_list',compact('subject'));
    }

    public function createSub()
    {
        return view('subject.create_sub');
    } 
    public function storeSub(Request $request)
    {
      $request->validate([
        'title'=>'required|string|max:255|unique:subject,title',
      ]);
        Subject::create([
            'title'=>$request->title,
        ]);
     return redirect()->route('sub.list')->with('success','subject added successfully');
    }

        public function editSub($id)
    {
        $sub = Subject::findOrFail($id);
        return view('subject.edit_sub', compact('sub'));
    }
        public function storeEdit(Request $request, $id)
    {
        $request->validate([
            // 'title' => 'required|string|max:255',
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subject', 'title')->ignore($id),
            ],
        ]);

        $subject = Subject::findOrFail($id); 
        $subject->update([
            'title' => $request->title,
        ]);

        return redirect()->route('sub.list')->with('success', 'Edited successfully');
    }


    public function deleteSub($id)
    {
        $subject= Subject::Findorfail($id);
        $subject->delete();
        return redirect()->route('sub.list')->with('success','deleted successfully');
    }
    public function toggleStatus(Request $request) {
        $status = (int) $request->status == 1 ? 0 : 1;
        Subject::where('id', $request->id)->update([
        'status' => $status,
        ]);
        return json_encode(['message' => 'Post status updated sucessfully']);
        }
}
