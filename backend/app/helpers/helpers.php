<?php

use Illuminate\Support\Facades\Auth;

function getNotifications()
{
    $notiObj = app('App\Repositories\Contracts\UserRepository');
    return collect($notiObj->getNotifications(Auth::id()));
}

function translate($data)
{
    switch($data['status'])
    {
        case 'logined': 
            return (object)[
                'title' => 'Cảnh báo đăng nhập',
                'content' => "Tài khoản của bạn đang được đăng nhập tại {$data['ipAddress']} đó có phải là bạn ?",
            ];
        break;
    }
}

function getLang()
{
    return currentLocale() == 'vi' ? 'uk.svg' : 'vn.png';
}

function getNameLang()
{
    return currentLocale() == 'vi' ? 'English' : 'Tiếng Việt';
}

function currentLocale()
{
    return app()->getLocale();
}

function existRef($user, $typ) {
    $arr = explode(',', $user->notification_preference);
    return in_array($typ, $arr);
}

function isFollowing($user, $following_ids) {
    return in_array($user->id, $following_ids);
}