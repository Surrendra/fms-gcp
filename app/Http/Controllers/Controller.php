<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($object = NULL, $message = 'Success')
    {
        return response()->json([
            'message' => $message,
            'data' => $object,
            'status' => 200,
        ], 200);
    }

    public function responseFailed($error = NULL, $message = 'failed')
    {
        return response()->json([
            'message' => $message,
            'error' => $error,
            'status' => 500,
        ], 500);
    }
}
