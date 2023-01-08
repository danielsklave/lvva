<?php

namespace App\Http\Controllers;

use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['destroy']);
    }

    public function index()
    {
        $comments = Comment::filterFromRequest()
            ->with(['user', 'post'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('comments', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        if(auth()->user()->is_admin || auth()->id() === $comment->user->id)
            $comment->delete();

        return back();
    }
}
