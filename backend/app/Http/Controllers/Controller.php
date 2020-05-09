<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function jsonSuccess($data = [])
    {
        $compacts['status'] = 200;
        $compacts['data'] = $data;

        return response()->json($compacts);
    }

    protected function jsonError($status, $message, $response = [])
    {
        $compacts['status'] = $status;
        $compacts['message'] = $message;
        $compacts['response'] = $response;

        return response()->json($compacts, $status);
    }

    protected function currentUser()
    {
        return Auth::user();
    }
}
