<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $validation = [
        'title'      => 'required|max:250',
        'body'       => 'required',
        'created_at' => 'required',
    ];

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'search', 'show']);
    }
    
    public function index()
    {
        $news = News::withCount('comments')
                    ->published()
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);

        return view('news.index', compact('news'));
    }

    public function search()
    {
        request()->validate(['query' => 'required']);

        $query = request()->get('query');

        $news = News::where('title', 'like', "%{$query}%")
                    ->orWhere('body', 'like', "%{$query}%")
                    ->withCount('comments')
                    ->published()
                    ->paginate(5);

        return view('news.search', compact('news'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function comment(News $new)
    {
        request()->validate(['body' => 'required']);

        $new->comments()->create([
            'user_id'   => auth()->id(),
            'body'      => request()->body           
        ]);

        return redirect()->route('news.show', $new);
    }

    public function create()
    {
        return view('news.edit', ['news' => new News()]);
    }

    public function store()
    {
        request()->validate($this->validation);

        $cover = request()->cover_image;
        $filename = time().$cover->getClientOriginalName();
        $cover->move('storage/files/', $filename);

        $news = News::create([
            'user_id'       => auth()->id(),
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at,
            'cover_image'   => $filename,
        ]);

        session()->flash('message', 'News created successfully.');

        return redirect()->route('news.show', $news);
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(News $news)
    {
        request()->validate($this->validation);

        if(request()->cover_image->getClientOriginalName() == $album->cover_image)
        {
            $filename = $album->cover_image;
        }
        else
        {
            unlink('storage/files/'.$album->cover_image);
            $cover = request()->cover_image;
            $filename = time().$cover->getClientOriginalName();
            $cover->move('storage/files/', $filename);
        }

        $news->update([
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at,
            'cover_image'   => $filename,
        ]);

        return redirect()->route('news.show', $news);
    }

    public function destroy(News $new)
    {
        $new->delete();

        return redirect()->route('posts.index');
    }
}
