<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'id','address','website','relationship','from','workplace','date_of_birth','user_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'website' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
