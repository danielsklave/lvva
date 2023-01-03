<?php

namespace App\Http\Controllers;

use App\News;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }
    
    public function index()
    {
        $news = News::filterFromRequest()
            ->withCount('comments')
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('news', compact('news'));
    }

    public function show(News $news)
    {
        if(!$news->is_published && !(auth()->user() && auth()->user()->is_admin))
            return redirect()->route('home');

        return view('posts.show', ['post' => $news]);
    }

    public function create()
    {
        return view('posts.edit', ['post' => new News()]);
    }

    public function store()
    {
        $news = News::createFromRequest();

        return redirect()->route('news.show', $news);
    }

    public function edit(News $news)
    {
        return view('posts.edit', ['post' => $news]);
    }

    public function update(News $news)
    {
        $news->updateFromRequest();

        return redirect()->route('news.show', $news);
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index');
    }
}
