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
        $notifications = $this->show($uid)->notifications;

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
                        'read' => empty($notification->read_at) ? false : true
                    ];
                    break;
                case 'new-goal':
                    $notis[] = [
                        'id' => $notification->id,
                        'slug' => $notification->data['slug'],
                        'type' => $notification->data['content'],
                        'image' => 'adjust',
                        'title' => $notification->data['title'],
                        'content' => $notification->data['content'],
                        'time' => Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans(),
                        'read' => empty($notification->read_at) ? false : true
                    ];
                    break;
                case 'change-progress':
                    $notis[] = [
                        'id' => $notification->id,
                        'slug' => $notification->data['slug'],
                        'type' => $notification->data['content'],
                        'image' => 'checkbox-multiple-marked-circle-outline',
                        'title' => $notification->data['title'],
                        'content' => $notification->data['content'],
                        'time' => Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans(),
                        'read' => empty($notification->read_at) ? false : true
                    ];
                    break;
            }
        }

        return $notis;
    }
}