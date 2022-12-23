<?php

namespace App;

use App\Abilities\HasParentModel;

class Tournament extends Post
{
    use HasParentModel;

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->category = 'tournament';
        });

        static::addGlobalScope(function ($query) {
            $query->where('category', 'tournament');
        });
    }

    public function path()
    {
        return url("/tournaments");
    }

}
