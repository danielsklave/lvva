<?php

namespace App;

use App\Abilities\HasParentModel;

class Album extends Post
{
    use HasParentModel;

    protected $attributes = [
        'category' => 'album',
        'is_published' => true
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('category', 'album');
        });
    }
}
