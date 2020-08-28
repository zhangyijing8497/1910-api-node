<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\TestModel;
use App\Model\Index\UserModel;
use Illuminate\Support\Str;
//引入邮件类
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class IndexController extends Controller
{

    //获取验证码
    public function verify_code(Request $request) {
        $user = $request->post('user');
        $email = $request->post('email');
        $res = UserModel::where('user_email',$email)->first('user_email');
        if($res){
            return [ 'code' => '2' ,'msg' => '邮箱已被绑定.'];
        }else{
            if(!session()->has('verify')){
                $vcode = $this->GetRandStr(6);
                $verify = [
                    'email' => $email,
                    'code' => $vcode,
                    'end_time'=>time()
                ];
                session(['verify' => $verify]);
            }elseif($email==session('verify')['email'] && (time()-session('verify')['end_time']>300)){
                $vcode = session('verify')['code'];
            }else{
                session()->flush();
                $vcode = $this->GetRandStr(6);
                $verify = [
                    'email' => $email,
                    'code' => $vcode,
                    'end_time'=>time()
                ];
                session(['verify' => $verify]);
            }
            return $this->send($email,$user,$vcode);
        }



    }


    //注册逻辑
    public function register(Request $request){
        $user_autner = $request->post('user_autner');
        if(empty($user_autner)){
            echo $this->location_href('账号为空...');exit;

        }else{
            $res = UserModel::where('user_autner',$user_autner)->first('user_autner');
            if ($res){
                echo $this->location_href('账号已被注册...');exit;
            }
        }
        $user_email = $request->post('user_email');
        if (empty($user_email)){
            echo $this->location_href('邮箱为空...');exit;

        }else{
            $res = UserModel::where('user_email',$user_email)->first('user_email');
            if ($res){
                echo $this->location_href('邮箱已被绑定...'); exit;
            }
        }
        $verify_code  = $request->post('verify_code');

        if (empty($verify_code)) {
            echo $this->location_href('验证码为空...');exit;
        }elseif($user_email==session('verify')['email'] && (time()-session('verify')['end_time']<300)){
            if($verify_code !=session('verify')['code']){
                echo $this->location_href('验证码有误...'); exit;
            }
        }
        $user_passwd = $request->post('user_passwd');
        $user_passwd1 = $request->post('user_passwd1');
        if (empty($user_passwd)){
            echo $this->location_href('密码为空...');

        }else{
            if (empty($user_passwd1)){
                echo $this->location_href('确认密码为空...');

            }else{
                if ($user_passwd==$user_passwd1){
                    $user_pwd = password_hash($user_passwd,PASSWORD_DEFAULT);
                    $data = [
                        'user_autner' => $user_autner,
                        'user_email'=> $user_email,
                        'user_pwd'  => $user_pwd,
                    ];
                    $id = UserModel::insertGetId($data);
                    if ($id){
                        echo $this->location_href('注册成功',url('/login'));

                    }else{
                        echo $this->location_href('网络错误稍后再试...');

                    }
                }else{
                    echo $this->location_href('两次密码不一致...');

                }
            }
        }

    }

    /**
     * [send description]
     * @param  [type] $email [description]
     * @param  [type] $user  [description]
     * @param  [type] $vcode [description]
     * @return [type]        [description]
     */
    public function send($email,$user,$vcode){
        $mail = new PHPMailer(true);
        try {
            /*
             * 【一】服务器配置
             */
            $mail->CharSet ="UTF-8";                                         //设定邮件编码
            $mail->SMTPDebug = 0;                                            //调试模式输出：0 不输出，2 输出
            $mail->isSMTP();                                                 //使用SMTP
            $mail->Host = 'smtp.163.com';                                     // SMTP服务器：以QQ为例
            $mail->SMTPAuth = true;                                          // 允许 SMTP 认证
            $mail->Username = "e200105062512@163.com";                     // SMTP用户名: 即发送方的邮箱
            $mail->Password = "TUKHNWIEZFLHBESU";               // SMTP授权码: 即发送方的邮箱授权码
            $mail->SMTPSecure = 'ssl';                                       // 允许 TLS 或者ssl协议
            $mail->Port = 587;                                               // 服务器端口： 25 或者465 或者587 具体要看邮箱服务器支持

            /*
             * 【二】收件人
             */
            $mail->setFrom("e200105062512@163.com", "Mstore商城");              //发件人：邮箱与用户名
            $mail->addAddress($email, $user);     //收件人1：可添加多个收件人
            //$mail->addAddress("收件人2的邮箱", '收件人2的用户名');                  //收件人2：可添加多个收件人

            //$mail->addReplyTo('xxxx@163.com', 'info');                          //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                                     //抄送人
            //$mail->addBCC('bcc@example.com');                                   //密送人

            /*
             * 【三】发送附件
             */
             // $mail->addAttachment('王庆国.mp4');           // 添加附件
             //$mail->addAttachment('fzs.png', 'haha.png');     // 发送附件并且重命名

            /*
             * 【四】发送内容
             */
            $mail->isHTML(true);    //2143  发送后客户端可直接显示对应HTML内容
            $mail->Subject = '注册验证码';   //邮件标题
            $mail->Body    = '<pre>注册验证码：<span style="font-size: 20px;color:red;">'.$vcode.'</span>,有效时间为5分钟，请尽快验证。</pre>';      //邮件内容
            // $mail->AltBody = '注册验证码：'.$vcode.',3分钟后失效。';      //邮件内容：如果邮件客户端不支持HTML则显示此内容

            /*
             * 【五】发送请求
             */
            $mail->send();
            return [ 'code' => '0' ,'msg' => '邮件发送成功'];
        } catch (Exception $e) {
            return [ 'code' => '1' ,'msg' => '邮件发送失败：'.$mail->ErrorInfo];
        }

    }

    //获取随机字符串
    public function GetRandStr($length){
        $str='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len=strlen($str)-1;
        $randstr='';
        for($i=0;$i<$length;$i++){
            $num=mt_rand(0,$len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }

    //登录逻辑
    public function login(Request $request){

        $user_autner = $request->post('user_autner');
        $user_pwd = $request->post('user_pwd');
        if (empty($user_autner)){
            echo $this->location_href('账号不能为空...');
            exit;
        }else{
            $res = UserModel::where('user_autner',$user_autner)->first();
            if ($res){
                $session = [
                    'user_id' =>$res->user_id,
                    'user_autner' =>$res->user_autner,
                    'user_name' =>$res->user_name,
                ];
                if (password_verify($user_pwd,$res->user_pwd)){
                    session(['user' =>$session]);
                    return redirect(url('/'));
                }else{
                    echo  $this->location_href('账号或密码错误...');
                }
            }else{
                echo $this->location_href('账号或密码错误...');
            }
        }

    }

    //退出
    public function quit(){
        session()->flush('user');
        echo $this->location_href('退出成功，跳转至登录',url('/login'));

    }

    /**
     * 跳转提示
     * @param $alert
     * @param string $path
     * @return string
     */
    public function location_href($alert,$path=''){
        if ($path == ''){
            $path = url()->previous();
        }
        return  "<script>"."alert('".$alert."')".",location.href='".$path."'</script>";
    }

    //测试session
    public function test(Request $request){
        //$session = $request->session()->get('key');
        $s = session()->all();

        var_dump($s);
    }
}
