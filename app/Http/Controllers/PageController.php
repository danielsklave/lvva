<?php

namespace App\Http\Controllers;

use App\Comment;
use App\News;
use App\Post;
use App\Album;

class PageController extends Controller
{
    public function contacts()
    {
        return view('contacts');
    }

    public function antidoping()
    {
        return view('antidoping');
    }

    public function records()
    {
        return view('records');
    }

    public function home()
    {
        $pins = Post::withCount(['comments', 'files'])
            ->pinned()
            ->published()
            ->orderBy('updated_at', 'desc')
            ->get();

        $postsByCategory = Post::withCount(['comments', 'files'])
            ->published()
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('category')
            ->map(function($categoryPosts) {
                return $categoryPosts->take(3);
            });

        return view('home', compact('postsByCategory', 'pins'));
    }
}
