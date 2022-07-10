<?php 

namespace App\Services;

use App\Models\File;

class FileService extends Service
{
    public function create($file)
    {
        $data = $this->uploadFile($this->path(),$file);
        return File::create($data);
    }

    public function path($filename = null)
    {
        if (empty($filename)) {
            return 'file';
        }
        return 'file/'.$filename;
    }

    public function update($id,$data = [])
    {
        $file = File::find($id);
        $file->update($data);
        return $file;
    }
}
