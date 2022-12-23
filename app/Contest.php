<?php

namespace App;

use App\Abilities\HasParentModel;

class Contest extends Post
{
    use HasParentModel;

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->category = 'contest';
        });

        static::addGlobalScope(function ($query) {
            $query->where('category', 'contest');
        });
    }

    public function path()
    {
        return url("/contests");
    }

}
