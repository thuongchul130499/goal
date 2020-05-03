<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password', 
        'first_name', 
        'last_name', 
        'avatar', 
        'ip_address', 
        'notification_preference', 
        'bio', 
        'phone', 
        'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAvaAttribute()
    {
        if ($this->avatar_original) {
            return $this->avatar_original;
        }

        return \Storage::url($this->avatar);
    }

    public function jobs(){
        return $this->hasMany(Post::class);
    }
}
