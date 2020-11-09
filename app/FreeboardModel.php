<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class FreeboardModel extends Model
{
    use commentable;
    use HasFactory;
    protected $table = "freeboard";
    protected $guarded = [];
    public $timestamps = false;
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
