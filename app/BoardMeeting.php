<?php

namespace App;

use App\Abilities\HasParentModel;

class BoardMeeting extends Post
{
    use HasParentModel;

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->category = 'board_meeting';
        });

        static::addGlobalScope(function ($query) {
            $query->where('category', 'board_meeting');
        });
    }

    public function path()
    {
        return url("/board_meetings");
    }

}
