<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function dashboard()
    {
        $posts      = Post::count();
        $comments   = Comment::count();

        return view('user.dashboard', get_defined_vars());
    }
}
