<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    public $table = 'files';
    protected $guarded = ['id','created_at','updated_at'];
    protected $casts = [
        'ocr_response' => 'array',
        'payload_content' => 'array'
    ];
}
