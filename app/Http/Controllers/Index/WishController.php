<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class WishController extends Controller
{
    public function wishlist(){

      // Redis::zrange("zlist",0,-1);










      //return view('Index.wishlist');


    }
}
