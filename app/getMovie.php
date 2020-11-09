<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class getMovie extends Model
{
    use Commentable;
    //
    protected $table = "movie";
} 
