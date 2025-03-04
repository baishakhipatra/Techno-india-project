<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seo;

class SeoController extends Controller
{
    public function SeoList(Request $request){
        $keyword = $request->keyword ?? '';
        $query = Seo::query();

        $query->when($keyword, function($query) use($keyword)
        {
            $query->where('page','like', '%'.$keyword.'%');
        });
        $data = $query->paginate(25);
        return view('seo.seolist',compact('data'));
    }

    public function seoDetail(Request $request,$id)
    {
        $data = Seo::findorFail($id);
        return view('seo.seodetail',compact('data'));
    } 
    
    public function seoEdit(Request $request,$id)
    {
        $data = seo::findorFail($id);
        return view('seo.seoedit',compact('data'));
    }
    public function SeoUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'page_title' => 'nullable|string|min:1',
            'meta_title' => 'nullable|string|min:1',
            'meta_desc' => 'nullable|string|min:1',
            'meta_keyword' => 'nullable|string|min:1',
        ]);

        $seo = Seo::findorFail($request->id);

        $seo->page_title = $request->page_title ?? '';
        $seo->meta_title = $request->meta_title ?? '';
        $seo->meta_desc = $request->meta_desc ?? '';
        $seo->meta_keyword = $request->meta_keyword ?? '';

        $seo->save();
        return redirect()->route('seo.list')->with('success', 'seo page updated');
    }
}
