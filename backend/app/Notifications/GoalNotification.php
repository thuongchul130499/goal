<?php

namespace App\Notifications;
use Illuminate\Support\Str;
use App\Goal;
use App\Task;

class GoalNotification extends BaseNotification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $object;
    public function __construct($object, $data = [])
    {
        parent::__construct();
        $this->object = $object;
        $this->data = $data;
    }

    
    public function toDatabase($notifiable)
    {
        if ($this->object instanceof Goal) {
            $data = [
                'status' => 'new-goal',
                'slug' => Str::slug('Bạn vừa tạo mục tiêu mới', '-'),
                'title' => 'Bạn vừa tạo mục tiêu mới',
                'content' => $this->object->title
            ];
        } else if ($this->object instanceof Task) {
            $data = [
                'status' => 'change-progress',
                'slug' => Str::slug('Thay đổi tiến độ', '-'),
                'title' => 'Bạn vừa thay đổi tiến độ của' . $this->object->title,
                'content' => $this->object->title . ' Đã được thay đổi từ '. $this->data['currentPgs'] . '% lên ' . $this->object->progress . '%'
            ];
        }
        return $data;
    }
}
