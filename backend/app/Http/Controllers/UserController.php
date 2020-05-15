<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Repositories\Contracts\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    static public $defaultWith = [
        'followers',
        'followings',
        'goals',
        'profile',
    ];

    public function __construct(UserRepository $user)
    {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Access-Control-Allow-Origin: *');
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->show($id, self::$defaultWith);
        $followers_ids = Auth::user()->followings()->pluck('following_id')->toArray();
        $followers_ids[] = Auth::id();
        $usersRand = User::whereNotIn('id', $followers_ids)->inRandomOrder()->limit(5)->get();
        $data = [
            'user' => $user,
            'users' => $usersRand,
            'isFollow' => in_array($user->id, $followers_ids)
        ];

        if (request()->ajax()) return $this->jsonSuccess($data);

        return view('user.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($request->ajax()) {
            $validator = Validator::make($data, [
                'bio' => 'max:500',
                'address' => 'max:200',
            ]);

            if ($validator->fails()) {
                $message = implode(',', $validator->errors()->all());

                return $this->jsonError(422, $message);
            }
            $user = $this->user->update($id, $request, self::$defaultWith);
            try {
                DB::beginTransaction();

                return $this->jsonSuccess([
                    'user' => $user
                ]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->jsonError(500, $e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $data = $request->all();
        $data['notification_preference'] = implode(',', $data['notification_preference']);
        $data['password'] = Hash::make($data['password']);
        if (Auth::user()->update($data)) {
            return redirect()->route('profile');
        };
    }

    public function upload(Request $req)
    {
        if ($req->has('file')) {
            $valid = $req->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        }

        if ($req->has('background')) {
            $valid = $req->validate([
                'background' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        }
        try {
            $currentUser = User::find(Auth::id());
            if ($req->all()['file']) {
                $path = $req->all()['file']->store('public/avatars');
                $currentImg = $currentUser->avatar;
                Storage::delete($currentImg);
                $currentUser->update(['avatar' => $path]);
            } else {
                $path = $req->file('background')->store('public/avatars');
                $currentImg = $currentUser->background;
                Storage::delete($currentImg);
                $currentUser->update(['background' => $path]);
            }

            return $this->jsonSuccess([
                'msg' => 'Cập nhật ảnh bìa thành công',
                'path' => Storage::url($currentImg),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonError(500, $e->getMessage());
        }
    }

    public function markAsRead(Request $request)
    {
        try {
            Auth::user()->unreadNotifications()->update(['read_at' => now()]);

            return $this->jsonSuccess([
                'msg' => 'success',
            ]);
        } catch (\Exception $e) {
            return $this->jsonError(500, $e->getMessage());
        }
    }

    public function follow(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'user_id' => 'required|numeric'
        ]);

        try {
            $user = $this->user->handleFollow($request);
            $following_ids = Auth::user()->followings()->pluck('following_id')->toArray();
            $followers_ids = Auth::user()->followers()->pluck('follower_id')->toArray();

            return view('user._user_single', compact(['user', 'following_ids', 'followers_ids']));
        } catch (\Exception $e) {
            return $this->jsonError(500, $e->getMessage());
        }
    }
}
