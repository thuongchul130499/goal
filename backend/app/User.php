<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Goal;
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
        'background',
    ];

    // protected $with = ['profile'];

    protected $appends = ['fullname', 'ava', 'bg'];

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

    public function goals(){
        return $this->hasMany(Goal::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow_users', 'following_id', 'follower_id')
            ->wherePivot('deleted_at', null);
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follow_users', 'follower_id', 'following_id')
            ->wherePivot('deleted_at', null);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAvaAttribute()
    {
        if ($this->avatar_original && !$this->image_origin) {
            return $this->avatar_original;
        }

        return \Storage::url($this->avatar);
    }

    public function getBgAttribute()
    {
        if (!empty($this->background)) {
            return \Storage::url($this->background);
        }

        return 'https://bootdey.com/img/Content/bg1.jpg';
    }
}
