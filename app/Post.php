<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category',
        'cover_image',
        'is_published',
        'is_pinned',
        'created_at'
    ];

    public static $validation = [
        'title'       => 'required|string|max:191',
        'cover_image' => 'nullable|image|max:4096',
        'body'        => 'nullable|string',
        'files.*'     => 'nullable|image|max:4096',
        'created_at'  => 'required|date_format:d.m.Y|after:01.01.1970',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->user_id = $query->user_id ?? auth()->id();
        });

        static::deleting(function($model) {
            if($model->cover_image)
                unlink('storage/files/'.$model->cover_image);
        });
    }

    public static function createFromRequest()
    {
        request()->validate(static::$validation);

        // Create cover image file
        if(request('cover_image'))
        {
            $cover = request('cover_image');
            $filename = time().$cover->getClientOriginalName();
            $cover->move('storage/files/', $filename);
        }

        // Create database entry
        $post = static::create([
            'title'         => request('title'),
            'body'          => request('body'),
            'is_published'  => (bool) request('is_published'),
            'is_pinned'     => (bool) request('is_pinned'),
            'created_at'    => request('created_at'),
            'cover_image'   => $filename ?? null,
        ]);

        // Create post files
        foreach(request()->files ?? [] as $index => $file)
        {
            $filename = time().$file->getClientOriginalName();
            $post->files()->create([
                'file_name' => $filename,
                'order' => $index
            ]);
            $file->move('storage/files/', $filename);
        }

        return $post;
    }

    public function updateFromRequest()
    {
        request()->validate(static::$validation);

        // Update cover image file
        if(request('cover_image')) 
        {
            if(request('cover_image')->getClientOriginalName() == $this->cover_image)
            {
                $filename = $this->cover_image;
            }
            else
            {
                if($this->cover_image) unlink('storage/files/'.$this->cover_image);
                $cover = request('cover_image');
                $filename = time().$cover->getClientOriginalName();
                $cover->move('storage/files/', $filename);
            }
        } 
        else
        {
            if($this->cover_image) unlink('storage/files/'.$this->cover_image);
        }

        // Update database entry
        $this->update([
            'title'         => request('title'),
            'body'          => request('body'),
            'is_published'  => (bool) request('is_published'),
            'is_pinned'     => (bool) request('is_pinned'),
            'created_at'    => request('created_at'),
            'cover_image'   => $filename ?? null,
        ]);

        // Update post files

        $filesIds = $this->files->pluck('id')->toArray();

        $newFilesIds = [];
        foreach(request()->file('files') ?? [] as $index => $file)
        {
            $oldFile = $this->files->where('file_name', $file->getClientOriginalName())->first();

            // Only uodate order if file has no changed
            if($oldFile) $newFile = $oldFile;
            else
            {
                // If new file added, save it in the file system
                $filename = time().$file->getClientOriginalName();
                $newFile = $this->files()->create(['file_name' => $filename]);
                $file->move('storage/files/', $filename);
            }

            $newFile->update(['order' => $index]);
            $newFilesIds[] = $newFile->id;
        }

        // Delete removed files
        $filesToDelete = array_diff($filesIds, $newFilesIds);

        foreach($this->files()->whereIn('id', $filesToDelete)->get() as $file) 
        {
            $file->delete();
        }

        return $this;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function files()
    {
        return $this->hasMany(File::class)->orderBy('order', 'asc');
    }

    public function scopeFilterFromRequest($query)
    {
        if (request('search'))
            $query->where('title', 'like', '%'.request('search').'%');

        if (request('date_from'))
            $query->where('created_at', '>=', date('Y-m-d', strtotime(request('date_from'))));

        if (request('date_to'))
            $query->where('created_at', '<=', date('Y-m-d', strtotime(request('date_to'))));

        if (request('category'))
            $query->where('category', request('category'));

        if (request('is_published'))
            $query->where('is_published', request('is_published') === 'yes');

        if (request('is_pinned'))
            $query->where('is_pinned', request('is_pinned') === 'yes');

        return $query;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

    public function scopeNotPinned($query)
    {
        return $query->where('is_pinned', false);
    }

    public function getPublishedAttribute()
    {
        return ($this->is_published) ? 'Jā' : 'Nē';
    }

    public function getUserCanViewAttribute()
    {
        return $this->is_published || (auth()->user() && auth()->user()->is_admin);
    }
}
