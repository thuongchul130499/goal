<?php

namespace App\Repositories\Eloquents;

use App\FollowUser;
use App\Notifications\UserNotification;
use App\Profile;
use App\Repositories\Contracts\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserEloquentRepository extends AbstractEloquentRepository implements UserRepository
{
    public function model()
    {
        return new User;
    }

    public function getData($with = [], $data = [], $dataSelect = ['*'])
    {
        return $this->model()
            // ->where('id', '!=', Auth::id())
            ->select($dataSelect)
            ->with($with)
            ->paginate(5);
    }

    public function getStatistical()
    {
        $from = Carbon::today()->subDays(6)->toDateString();
        $to = Carbon::today()->toDateString();
        $range = [$from, $to];

        $data = [
            'follower' => $this->getStatisticalFollow($range),
            'user' => $this->getStatisticalUser($range)
        ];

        return $data;
    }

    public function update($id, $request, $with = [])
    {
        try {
            $user = $this->model()->with($with)->findOrFail($id);
            $user->update(['bio' => $request->get('bio')]);
            $user->profile()->updateOrCreate(['user_id' => $user->id], $request->get('profile'))->save();

            return $user->refresh();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function show($uid, $with = [])
    {
        return $this->model()->with($with)->findOrFail($uid);
    }

    public function getNotifications($uid, $page = 1)
    {
        $notifications = $this->show($uid)->notifications;

        $notis = [];

        foreach ($notifications as $key => $notification) {
            switch ($notification->data['status']) {
                case 'logined':
                    $type = $notification->data['status'];
                    $image = 'security';
                    $title = 'Cảnh báo đăng nhập';
                    $content = 'Tài khoản của bạn được đăng nhập tại một máy tính khác, có phải là bạn ?';
                    break;
                case 'new-goal':
                    $type = $notification->data['content'];
                    $image = 'adjust';
                    $title = $notification->data['title'];
                    $content = $notification->data['content'];
                    break;
                case 'change-progress':
                    $type = $notification->data['content'];
                    $image = 'checkbox-multiple-marked-circle-outline';
                    $title = $notification->data['title'];
                    $content = $notification->data['content'];
                    break;
                case 'follow':
                    $type = $notification->data['content'];
                    $image = 'account-plus';
                    $title = $notification->data['title'];
                    $content = $notification->data['content'];
                    break;
            }
            $notis[] = [
                'id' => $notification->id,
                'slug' => $notification->data['slug'],
                'type' => $type,
                'image' => $image,
                'title' => $title,
                'content' => $content,
                'time' => Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans(),
                'read' => empty($notification->read_at) ? false : true
            ];
        }

        return $notis;
    }

    public function handleFollow(Request $request)
    {
        $query = Auth::user()->followings();
        $userFollowed = $this->show($request->user_id);
        if ($request->input('type') === 'follow') {
            if ($this->checkExist($query, 'following_id', $request->user_id)) goto end;
            $query->attach($request->user_id);
            $userFollowed->notify(new UserNotification(Auth::user()));
        } else {
            if ($this->checkExist($query, 'follower_id', $request->user_id)) goto end;
            $userFollowed->notifications()->whereJsonContains(
                'data->sender',
                Auth::user()->fullname
            )->delete();
            $query->detach($request->user_id);
        }

        end: return $userFollowed;
    }

    private function checkExist($query, $column, $user_id)
    {
        return $query->where($column, $user_id)->count() > 0;
    }

     private function generateInitDataDay()
    {
        for ($i = 7; $i >= 0; $i--) {
            $initData[] = [
                'date' => Carbon::today()->subDays($i)->format('Y-m-d'),
                'followers' => 0
            ];
        }

        return $initData;
    }

    private function getStatisticalFollow(array $rangeDate) :array
    {
        $followerCount = FollowUser::where('following_id', Auth::id())
            ->whereBetween(DB::raw('DATE(created_at)'), $rangeDate)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as followers'))
            ->groupBy('date')
            ->get();
        $follower = $this->generateInitDataDay();

        foreach ($followerCount as $item) {
            foreach ($this->generateInitDataDay() as $key => $val) {
                if ($item->date === $val['date']) {
                    $follower[$key]['followers'] += $item->followers;
                }
            }
        }

        return $follower;
    }

    private function getStatisticalUser($range)
    {
        return $user = $this->model()
            ->whereBetween(DB::raw('DATE(created_at)'), $range)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as user'))
            ->groupBy('date')
            ->get();
    }
}
