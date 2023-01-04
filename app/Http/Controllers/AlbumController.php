<?php

namespace App\Http\Controllers;

use App\Album;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        $albums = Album::filterFromRequest()
            ->withCount(['files', 'comments'])
            ->orderBy('created_at', 'desc')
            ->published()
            ->paginate(10)
            ->withQueryString();

        return view('albums', compact('albums'));
    }

    public function show(Album $album)
    {
        if(!$album->userCanView)
            return to_route('home');

        return view('posts.show', ['post' => $album]);
    }

    public function create()
    {
        return view('posts.edit', ['post' => new Album()]);
    }

    public function store()
    {
        $album = Album::createFromRequest();

        return to_route('albums.show', $album);
    }
    
    public function edit(Album $album)
    {
        return view('posts.edit', ['post' => $album]);
    }

    public function update(Album $album)
    {
        $album->updateFromRequest();

        return to_route('albums.show', $album);
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return to_route('posts.index');
    }
}
