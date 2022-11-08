<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Comment;
use App\Post;

class AboutController extends Controller
{
    public function contacts()
    {
        return view('about.contacts');
    }

    public function board()
    {
        return view('about.board');
    }

    public function antidoping()
    {
        return view('antidoping');
    }

    public function home()
    {
        $posts = Post::with('category', 'user')
            ->withCount('comments')
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('home', compact('posts'));
    }
}
