<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $comments = Comment::with(['user', 'post'])->paginate(10);

        return view('comments.index', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        if($comment->user_id != auth()->user()->id && auth()->user()->isNotAdmin()) {;
            return redirect()
                ->route('comments.index')
                ->withMessage("You can't delete other peoples comment.");;
        }

        $comment->delete();

        return redirect()
            ->route('comments.index')
            ->withMessage('Comment deleted successfully.');
    }
}
