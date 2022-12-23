<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumController extends Controller
{
    private $validation = [
        'title'      => 'required|max:250',
        'body'       => 'required',
        'created_at' => 'required',
    ];

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $albums = Album::withCount('files')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('albums.index', compact('albums'));
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function create()
    {
        return view('albums.edit', ['album' => new Album()]);
    }

    public function store()
    {
        request()->validate($this->validation);

        $cover = request()->cover_image;
        $filename = time().$cover->getClientOriginalName();
        $cover->move('storage/files/', $filename);

        $album = Album::create([
            'user_id'       => auth()->id(),
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at,
            'cover_image'   => $filename,
        ]);

        return redirect()->route('albums.show', $album);
    }
    
    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Album $album)
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
        
        $album->update([
            'title'         => request()->title,
            'body'          => request()->body,
            'is_published'  => request()->has('is_published'),
            'is_pinned'     => request()->has('is_pinned'),
            'created_at'    => request()->created_at,
            'cover_image'   => $filename,
        ]);

        $photosIds = $album->files->pluck('id')->toArray();

        $newPhotosIds = [];

        foreach(request()->images ?? [] as $index => $photo)
        {
            $oldImage = $album->files->where('file_name', $photo->getClientOriginalName())->first();

            if($oldImage) $newPhoto = $oldImage;
            else
            {
                $filename = time().$photo->getClientOriginalName();
                $newPhoto = $album->files()->create(['file_name' => $filename]);
                $photo->move('storage/files/', $filename);
            }

            $newPhoto->update(['order' => $index]);
            $newPhotosIds[] = $newPhoto->id;
        }

        $photosToDelete = array_diff($photosIds, $newPhotosIds);

        foreach($album->files()->whereIn('id', $photosToDelete)->get() as $photo) 
        {
            unlink('storage/files/'.$photo->file_name);
            $photo->delete();
        }

        return redirect()->route('albums.show', $album);
    }

    public function delete(Album $album)
    {
        $album->delete();

        return redirect()->route('posts.index');
    }
}
