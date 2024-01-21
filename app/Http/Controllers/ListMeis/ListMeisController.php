<?php

namespace App\Http\Controllers\ListMeis;

use App\Http\Controllers\Controller;
use App\Models\Meis\Mei;
use Illuminate\Http\Request;

class ListMeisController extends Controller
{

    public function index()
    {
        return view('livewire.panel.list-meis.index');
    }

}
