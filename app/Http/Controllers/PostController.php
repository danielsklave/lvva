<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['comment']);
        $this->middleware('admin')->except(['comment']);
    }
    
    public function index()
    {
        $posts = Post::filterFromRequest()
            ->withCount('comments')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('posts', compact('posts'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
    
    public function comment(Post $post)
    {
        request()->validate(['comment' => 'required|string']);

        $post->comments()->create(['body' => request('comment')]);

        return back();
    }
}
