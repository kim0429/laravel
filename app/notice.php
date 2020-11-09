<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class notice extends Model
{
    use commentable;
    use HasFactory;
    protected $table = 'notice';
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
