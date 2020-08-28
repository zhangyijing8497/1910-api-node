<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function chat()
    {
        // echo '<pre>';print_r($_SERVER);echo '</pre>';die;
        if($_SERVER['uid']==0){
            $url = env('PASSPORT_HOST')."login/?redirect=".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            echo "<script>alert('请先登录')</script>";
            header("refresh:2;url=".$url);die;
        }
        return view('chat.index');
    }
}
