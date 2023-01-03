<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'body',
        'user_id',
        'post_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->user_id = $query->user_id ?? auth()->id();
        });
    }
    
    public function scopeFilterFromRequest($query)
    {
        if (request('author'))
            $query->whereRelation('user', 'name', 'like', '%'.request('author').'%');

        if (request('search'))
            $query->where('body', 'like', '%'.request('search').'%');

        if (request('date_from'))
            $query->where('created_at', '>=', date('Y-m-d', strtotime(request('date_from'))));

        if (request('date_to'))
            $query->where('created_at', '<=', date('Y-m-d', strtotime(request('date_to'))));

        return $query;
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}