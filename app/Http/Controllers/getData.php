<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\getMovie;

class getData extends Controller
{
    //
    function getMovie(){
        $data = getMovie::all();
        return view('movie',['data'=>$data]);
    }
}
