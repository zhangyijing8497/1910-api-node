<?php

namespace App\Model\Index;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    public $table = 'p_users';
    public $primaryKey = 'user_id';
    public $timestamps = false;
}
