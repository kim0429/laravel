<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\getMovie;

class WatchController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    public function watchMovie(getMovie $id){
        $movie_data =$id;
        return view('watch',compact('movie_data'));
        // if ($id->id) {
        //     $movie_data =$id;
        //     return view('watch',compact('movie_data'));
        // }else{
        //      echo "not availb";
        //  }
        
    }
}
