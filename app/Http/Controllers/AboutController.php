<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\News;
use App\Post;
use App\Album;

class AboutController extends Controller
{
    public function contacts()
    {
        return view('about.contacts');
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
        $news = News::withCount('comments')
            ->published()
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $albums = Album::withCount('files')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('home', compact('news', 'albums'));
    }
}
