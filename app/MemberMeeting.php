<?php

namespace App;

use App\Abilities\HasParentModel;

class MemberMeeting extends Post
{
    use HasParentModel;

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->category = 'member_meeting';
        });

        static::addGlobalScope(function ($query) {
            $query->where('category', 'member_meeting');
        });
    }

    public function path()
    {
        return url("/member_meetings");
    }

}
