<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Model\Index\UserModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class BackController extends Controller
{
    public function back(){
        return view('back.pwd');
    }

    public function backs(){
        $email = request()->input('email');
        $if_email = UserModel::where(['user_email'=>$email])->first();
        $email=$if_email['user_email'];
        if(!empty($if_email)){
            $token = Str::random(32);

            $data = [
                'url'   => env('APP_URL'). '/back/resetpass?token='.$token
            ];
            Mail::send('email.findpass',$data,function($message){
                $to = [
                    '918903531@qq.com'
                ];
                $message->to($to)->subject('密码重置');
            });
            header("refresh:2;url=/login");
            echo "密码重置链接已发送至 " . $if_email->user_email;

        }
    }
    public function resetpass(){
        return view('back.resetpass');
    }
    public function reset(){
        $email = request()->input('email');
        $pwd=request()->input('passord');
        if(!empty($email)){
            $new_pwd=password_hash($pwd,PASSWORD_DEFAULT);
            $user_upda=UserModel::where(['user_email'=>$email])->update(['user_pwd'=>$new_pwd]);
            if($user_upda){
                echo "修改成功";
                header("refresh:2;url=/login");
            }
        }
    }







}
