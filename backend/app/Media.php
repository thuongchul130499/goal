<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'data'
    ];

    public function post()
    {
        return $this->morphTo();
    }
}
