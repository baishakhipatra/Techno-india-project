<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Unit;


class UnitController extends Controller
{
    public function unitList(Request $request)
    {
    $keyword = $request->input('keyword');
    $query = Unit::query();

    if ($keyword) {
        $query->where(function ($query) use ($keyword) {

            $query->where('title', 'like', '%' . $keyword . '%');
        });
    }
    $unit = $query->latest('id')
                  ->paginate(25)
                  ->appends(request()->query());

    return view('unit.unit_list', compact('unit'));
    }
    public function createUnit()
    {
        return view('unit.create_unit');
    }

    public function storeUnit(Request $request)
    {
        $request->validate([
                'title'=>'required|string|max:255|unique:unit,title',
            ]);
        Unit::create([
            'title'=>$request->title,
        ]);
        return redirect()->route('unit.list')->with('success','unit added successfully');
    }

    public function editUnit($id)
    {
      $unit = Unit::Findorfail($id);
      return view('unit.unit_edit',compact('unit'));
    }

    public function editStore(Request $request,$id)
    { 

        $request->validate([
            // 'title' => 'required|string|max:255|unique:unit,title,' . $id
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('unit', 'title')->ignore($id),
            ],
        ]);
        $unit=Unit::Findorfail($id);
        $unit->update([
            'title'=>$request->title,
        ]);
        return redirect()->route('unit.list')->with('success','unit edited successfully');
    }

    public function deleteUnit($id)
    {
        $unit=Unit::Findorfail($id);
        $unit->delete();
        return redirect()->route('unit.list')->with('success', 'unit deleted successfully');
    }

    public function toggleStatus(Request $request) {
        $status = (int) $request->status == 1 ? 0 : 1;
        Unit::where('id', $request->id)->update([
        'status' => $status,
        ]);
        return json_encode(['message' => 'Post status updated sucessfully']);
        }
}
