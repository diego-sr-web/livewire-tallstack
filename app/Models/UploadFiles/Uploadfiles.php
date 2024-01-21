<?php

namespace App\Models\UploadFiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadfiles extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'company_id', 'thumb_file', 'title', 'file', 'status'];
    
}
