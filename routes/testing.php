<?php

use App\Models\File;
use App\Services\GcpService;

Route::get('/process_file_ocr', function () {
    $GcpService = new GcpService;
    $file = File::query()->find(1);
    $res =  $GcpService->postOcrPdf($file);
    dd($res);
});