<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const PUBLIC = 0;
    const PRIVATE = 1;
    const FOLLOW = 2;

    protected $appends = ['created'];
    protected $fillable = [
        'id', 'user_id', 'content', 'mode'
    ];

    protected $with = [
        'medias'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medias()
    {
        return $this->morphMany('App\Media', 'mediable');
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
