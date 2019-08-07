<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web extends Model
{
    //
    // protected $file
    protected $fillable = ['title', 'description', 'logo','isopen','cright','keyword','created_at','updated_at'];
}



