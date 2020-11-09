<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreVisitor extends Model
{
    protected $table = "visitor";
    public $timestamps = false;
    use HasFactory;
}
