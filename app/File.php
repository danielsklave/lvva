<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;
    
    protected $table = 'files';

    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'order',
        'file_name'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($model) {
            unlink('storage/files/'.$model->file_name);
        });
    }
}
