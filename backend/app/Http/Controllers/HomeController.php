<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Auth;
use App\Facades\GoldFacade;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $following_ids = Auth::user()->followings()->pluck('following_id')->toArray();
        $followers_ids = Auth::user()->followers()->pluck('follower_id')->toArray();

        $users = $this->user->getData([
            'followers', 'followings'
        ]);

        if (request()->isMethod('post')) {
            return response()->json([
                'view' => view('user._user', compact('users', 'following_ids'))->render(),
                'links' => $users->withPath('users')->appends(['pos' => 'user-table'])->links()->render()
            ]);
        }

        $ratesGold = GoldFacade::getExchangeRate();

        return view('home', compact('ratesGold', 'users', 'following_ids'));
    }
}
