<?php

namespace App\Http\Controllers\UploadFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function index ()
    {
        return view('livewire.upload-file.index');
    }
}
