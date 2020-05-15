<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title', 'content', 'status', 'finished_date', 'notification', 'user_id',
    ];

    protected $dates = [
        'finished_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
