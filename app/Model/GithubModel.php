<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GithubModel extends Model
{
    protected $table = 'user_github';
    protected $guarded = []; 
    protected $primaryKey = "id";
    public $timestamps = false;
}
