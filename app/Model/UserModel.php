<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $guarded = []; 
    protected $primaryKey = "id";
    public $timestamps = false;
}

?>