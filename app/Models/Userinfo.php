<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    protected $filleable=['uname','upass','email','phone','state','auth','status','token'];
    //设置模型表明
    public $table = 'users_info';
}
