<?php

namespace App;

use App\Abilities\HasParentModel;

class BoardMeeting extends Post
{
    use HasParentModel;

    protected $attributes = [
        'category' => 'board_meeting',
        'is_published' => true
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('category', 'board_meeting');
        });
    }
}
