<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Goal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'image',
        'description',
        'progress',
        'user_id',
        'due_to',
        'started_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'started_at', 'due_to'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getDayLeftAttribute()
    {

        if ($this->due_to) {
            $remaining_days = Carbon::now()->diffInDays(Carbon::parse($this->due_to));
        } else {
            $remaining_days = 0;
        }
        return $remaining_days . ' more days left!';
    }

    public function pgrStatus()
    {
        $progress = $this->progress;
        if ($progress <= 25) {
            $status = 'danger';
            $text = 'At Risk';
        } else if($progress > 25 && $progress <= 50){
            $status = 'warning';
            $text = 'Behind';
        } else if($progress > 50 && $progress <= 75){
            $status = 'success';
            $text = 'On Track';
        } else{
            $status = 'info';
            $text = 'Excellent';
        }

        return self::getTask($status, $text);
    }

    static public function getTask($status, $text)
    {
        return '<span id="mainStatus" class="badge rounded-pill mt-auto badge-' . $status .'">'. $text .'</span>';
    }
}
