<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class Service
{
    public function uploadFile($path,$file)
    {
        $path = Storage::disk('local')->put($path, $file);
        return [
            'filename' => basename($path),
            'original_filename' => $file->getClientOriginalName(),
            'extension' => $file->getClientOriginalExtension(),
        ];
    }
}
