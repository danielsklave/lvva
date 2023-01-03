<?php

namespace App;

use App\Abilities\HasParentModel;

class News extends Post
{
    use HasParentModel;

    protected $attributes = [
        'category' => 'new',
        'is_published' => true
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('category', 'new');
        });
    }
}
