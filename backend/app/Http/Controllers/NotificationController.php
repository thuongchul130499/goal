<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notification.index');        
    }

    public function show(Request $request, $slug)
    {
        $notification = \Auth::user()->notifications()->findOrFail($request->all()['id']);
        return view('notification.show', compact('notification'));
    }
}
