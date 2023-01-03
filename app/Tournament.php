<?php

namespace App;

use App\Abilities\HasParentModel;

class Tournament extends Post
{
    use HasParentModel;

    protected $attributes = [
        'category' => 'tournament',
        'is_published' => true
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('category', 'tournament');
        });
    }
}
