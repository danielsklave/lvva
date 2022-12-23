<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $posts = Post::withCount('comments')
                    ->published()
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function search()
    {
        request()->validate(['query' => 'required']);

        $query = request()->get('query');

        $posts = Post::where('title', 'like', "%{$query}%")
            ->orWhere('body', 'like', "%{$query}%")
            ->withCount('comments')
            ->published()
            ->paginate(5);

        return view('post.search', compact('posts'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
