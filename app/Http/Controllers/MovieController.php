<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Image;
use File;

class MovieController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }
    function upload(Request $req){
        
        //crawler

	    function movie_claw($mv_id){
		// global $key;
		$movie = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/$mv_id?api_key=747547c57e94335897f87f35ff19faa6&language=ko-KR"), true);
		$genre_info = json_decode(file_get_contents("storage/genre_api.json"), true);
		$genre = "";
		$mv_title = $movie['title'];
		foreach($movie['genres'] as $value){
			$tot = count($genre_info['genres']);
			for($i=0;$i<$tot;$i++){
				if($value['name'] == $genre_info['genres'][$i]['name']){
					// $genre .= "<span>".$genre_info['genres'][$i]['name']."</span>"; //but when saving to database, using array number
                    $genre .= $genre_info['genres'][$i]['name'].",";
                    
                }

            }
            // $genre = $movie['genres'];
		}
		return array(
			"genres"=>substr($genre,0, -1),
			"tagline"=>$movie['tagline'],
			"overview"=>$movie['overview'],
			"released_date"=>substr($movie['release_date'],0,4),
            "poster"=>$movie['poster_path'],
            "title"=>$movie['title']
            );
        }
        //endcralwer
        
        $req->validate([
            'id'=>['required'],
            'link'=>['required'],
        ]);
         
         $mv_info = movie_claw($req->id);
         //save poster first 
         $ext = pathinfo($mv_info['poster'], PATHINFO_EXTENSION);
         $poster_name = time().rand(pow(10, 5-1), pow(10, 5)-1).'.'.$ext;
         Image::make('https://image.tmdb.org/t/p/w500//'.$mv_info['poster'])->resize(null,400,function($constraint){$constraint->aspectRatio();$constraint->upsize();})->save(public_path('/movie_poster/'.$poster_name));
       
         $mv = new Movie;
        $mv->title = $mv_info['title'];
        $mv->date = $mv_info['released_date'];
        $mv->genre = $mv_info['genres'];
        $mv->tagline = $mv_info['tagline'];
        $mv->overview = $mv_info['overview'];
        $mv->poster = $poster_name;
        $mv->movie_link = $req->link;
        $mv->save();
        
        return redirect()->back();
    }
    
}
