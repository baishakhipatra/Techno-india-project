<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;

class CareerController extends Controller
{
    public function postList(Request $request)
    {
    $keyword = $request->input('keyword');
    $query = Post::query();
    if ($keyword) {
        $query->where(function($query) use ($keyword) {
            $query->where('title', 'like', '%'.$keyword.'%');
        });
    }
    $posts = $query->latest('id')
                   ->paginate(25)
                   ->appends(request()->query());

    return view('career.post_list', compact('posts'));
    }

    

    public function createForm(){
        return view('career.create_list');
        }

    public function storeList(Request $request){
        $request->validate([
            'title' => 'required|string|max:255|unique:post,title',
            ]);

            Post::create([
            'title'=>$request->title,
            ]);
            return redirect()->route('post.list')->with('success','post added successfully');
        }

    public function formEdit($id){
        $post = Post::findOrFail($id);
        return view('career.edit_list', compact('post'));
    }

    public function updateEdit(Request $request, $id){
        $request->validate([
            // 'title' => 'required|string|max:255',
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('post', 'title')->ignore($id),
            ],
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
        ]);

        return redirect()->route('post.list')->with('success', 'Post updated successfully');
    }
    public function deleteEdit($id){
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('post.list')->with('success', 'Post deleted successfully');
    }
    public function changePostStatus(Request $request) {
        $status = (int) $request->status == 1 ? 0 : 1;
        Post::where('id', $request->id)->update([
        'status' => $status,
        ]);
        return json_encode(['message' => 'Post status updated sucessfully']);
        }
}
