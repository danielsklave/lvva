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
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('news', compact('news'));
    }

    public function show(News $news)
    {
        if(!$news->userCanView)
            return to_route('home');

        return view('posts.show', ['post' => $news]);
    }

    public function create()
    {
        return view('posts.edit', ['post' => new News()]);
    }

    public function store()
    {
        $news = News::createFromRequest();

        return to_route('news.show', $news);
    }

    public function edit(News $news)
    {
        return view('posts.edit', ['post' => $news]);
    }

    public function update(News $news)
    {
        $news->updateFromRequest();

        return to_route('news.show', $news);
    }

    public function destroy(News $news)
    {
        $news->delete();

        return to_route('news.index');
    }
}
