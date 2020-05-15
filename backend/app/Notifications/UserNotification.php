<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends BaseNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    public function toDatabase($notifiable)
    {
        return [
            'status' => 'follow', 
            'slug' => 'follow',
            'title' => '<b>' . $this->follower->fullname . '</b> đã theo dõi bạn',
            'content' => 'Bạn có một lượt theo dõi mới từ <b>' . $this->follower->fullname . '</b>',
            'sender' => $this->follower->fullname
        ];
    }
}
