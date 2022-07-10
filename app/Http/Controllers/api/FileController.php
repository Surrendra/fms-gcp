<?php

namespace App\Http\Controllers\api;

use App\Services\FileService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $FileService;
    function __construct(
        FileService $FileService
    ) {
        $this->FileService = $FileService;
    }
    public function create(Request $request)
    {
        $request->validate([
            'file' => 'required|file'   
        ]);
        $this->FileService->create($request->file);
        return $this->responseSuccess(null);
    }
}
