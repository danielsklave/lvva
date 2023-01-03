<?php

namespace App;

use App\Abilities\HasParentModel;

class Contest extends Post
{
    use HasParentModel;

    protected $attributes = [
        'category' => 'contest',
        'is_published' => true
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('category', 'contest');
        });
    }
}
