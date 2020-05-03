<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
        //
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
        //
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
        return view('user.profile', compact('user'));
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
        $valid = $req->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $path = $req->file('file')->store('public/avatars');
            $currentUser = User::find(Auth::id());
            $currentImg = $currentUser->avatar;
            Storage::delete($currentImg);
            $currentUser->update(['avatar' => $path]);

            return $this->jsonSuccess([
                'msg' => 'Cập nhật ảnh bìa thành công',
                'path' => Storage::url($currentImg),
            ]);
            
        } catch (\Exception $e) {
            return $this->jsonError(500, $e->getMessage());
        }
    }
}
