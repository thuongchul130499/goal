<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\UserRepository;
use App\User;
use Carbon\Carbon;

class UserEloquentRepository extends AbstractEloquentRepository implements UserRepository
{
    public function model()
    {
        return new User;
    }

    public function getData($with = [], $data = [], $dataSelect = ['*'])
    {
        # code...
    }

    public function show($uid)
    {
        return $this->model()->findOrFail($uid);
    }

    public function getNotifications($uid, $page = 1)
    {
        $notifications = $this->show($uid)
                        ->unreadNotifications()
                        ->paginate(5);

        $notis = [];

        foreach ($notifications as $key => $notification) {
            switch ($notification->data['status'])
            {
                case 'logined':
                    $notis[] = [
                        'id' => $notification->id,
                        'slug' => $notification->data['slug'],
                        'type' => $notification->data['status'],
                        'image' => 'security',
                        'title' => 'Cảnh báo đăng nhập',
                        'content' => 'Tài khoản của bạn được đăng nhập tại một máy tính khác, có phải là bạn ?',
                        'time' => Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans(),
                    ];
                    break;
            }
        }

        return $notis;
    }
}