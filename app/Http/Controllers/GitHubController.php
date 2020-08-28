<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\GithubModel;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;



class GitHubController extends Controller
{
    /**
     * github 登录页面
     */
    public function index()
    {
        return view('github/index');
    }

    /**
     * github 回调
     */
    public function callback()
    {
        $client = new Client();
        
        $code = $_GET['code'];
        // print_r($code);

        $uri = "https://github.com/login/oauth/access_token";
        $res = $client->request("POST",$uri,[
            //携带HTTP headers
            'headers'    => [
                'Accept'  => 'application/json'
            ],

            'form_params'=>[
                'client_id'         =>env('GITHUB_CLIENT_ID'),
                'client_secret'    =>env('GITHUB_CLIENT_SECRET'),
                'code'              =>$code
            ]
        ]);

         //access_token 在响应的数据中
         $body = $res->getBody();
         $info = json_decode($body,true);
         $access_token = $info['access_token'];
         
         //使用access_token获取用户信息
         $uri = "https://api.github.com/user";
         $arr = $client->request("GET",$uri,[
           'headers'=>[
               'Authorization'  =>'token '.$access_token
            ]
         ]);
         $res1 = $arr->getBody();
         $userinfo = json_decode($res1,true);
         
          //判断用户是否存在  不存在入库
        $u = GithubModel::where(['github_id'=>$userinfo['id']])->first();
        // print_r($u);
        if($u)
        {
            // echo "欢迎回来";echo "<br>";
        }else{
            //写入用户主表
            $u_info = [
                'email' => $userinfo['email'],
            ];    
            // print_r($u_info);die;    
            $uid = UserModel::insertGetId($u_info);
            
            //在github表中记录用户信息
            // echo "欢迎新用户";echo "<br>";
            $user_data = [
                'uid'       => $uid,
                'github_id' => $userinfo['id'],
                'location'  => $userinfo['location'],
                'email'     => $userinfo['email'],
            ];
            $gid = GithubModel::insertGetId($user_data);
            if($gid > 0){

            }else{
                
            }
        }

         //生成token标识
         $token = str::random(16);
         Cookie::queue('token',$token,60);
 
         //将token保存到redis
         $redis_token = "token:".$token;
         $tokeninfo = [
             'uid' => $u->uid
         ];
 
         Redis::hMset($redis_token,$tokeninfo);
         Redis::expire($redis_token,60*60);
 
         header("refresh:3,url=/");
         echo "登陆成功,正在跳转至首页...";
 


    }
}
