<?php

namespace App;

use App\Abilities\HasParentModel;

class News extends Post
{
    use HasParentModel;

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->category = 'new';
        });

        static::addGlobalScope(function ($query) {
            $query->where('category', 'new');
        });
    }

    public function path()
    {
        return url("/news/{$this->id}");
    }
}
