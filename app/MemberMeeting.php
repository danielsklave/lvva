<?php

namespace App;

use App\Abilities\HasParentModel;

class MemberMeeting extends Post
{
    use HasParentModel;

    protected $attributes = [
        'category' => 'member_meeting',
        'is_published' => true
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('category', 'member_meeting');
        });
    }
}
