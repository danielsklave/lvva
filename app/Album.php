<?php

namespace App;

use App\Abilities\HasParentModel;

class Album extends Post
{
    use HasParentModel;

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->category = 'album';
        });

        static::addGlobalScope(function ($query) {
            $query->where('category', 'album');
        });
    }

    public function path()
    {
        return url("/albums/{$this->id}");
    }

}
