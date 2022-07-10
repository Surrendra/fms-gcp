<?php

namespace App\Http\Controllers\api;

use App\Services\FileService;
use App\Services\GcpService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $FileService;
    protected $GcpService;
    function __construct(
        FileService $FileService,
        GcpService $GcpService
    ) {
        $this->FileService = $FileService;
        $this->GcpService = $GcpService;
    }

    public function create(Request $request)
    {
        $request->validate([
            'file' => 'required|file'   
        ]);
        $this->FileService->create($request->file);
        return $this->responseSuccess(null);
    }

    public function gcpHandleCallback(Request $request)
    {
        $res = $this->GcpService->handleCallback($request->filename,$request->ocrResult);
        return $this->responseSuccess($res['data'],$res['message']);
    }
}
