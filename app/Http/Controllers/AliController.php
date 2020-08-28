<?php

namespace App\Http\Controllers;

use App\Model\Index\OrderModel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;

class AliController extends Controller
{
    /**
     * 支付
     */
    public function alipay()
    {
        $order_id=request()->get('order_id');
        $order=OrderModel::where(['order_id'=>$order_id])->first();
//        dd($order['order_on']);
        $client = new Client();
        $url = 'https://openapi.alipaydev.com/gateway.do';      //沙箱环境
        //请求参数
        $common_param = [
            'out_trade_no' => '1910team_'.time().'_'.mt_rand(11111,99999),   //商户订单号  随机
            'product_code' => 'FAST_INSTANT_TRADE_PAY',  //销售产品码
            'total_amount'=>$order['order_morey'],                    //订单的总金额
            'subject' => '测试:'.mt_rand(11111,99999),   //订单名称
        ];
        // print_r($common_param['out_trade_no']);die;

        //公共请求参数
        $pub_param = [
            'app_id' => '2016101300673640',   //appid
            'method' => 'alipay.trade.page.pay',  //接口名称
            'charset' => 'utf-8',   //编码格式
            'sign_type' => 'RSA2',   //算法类型
            'timestamp' => date('Y-m-d H:i:s'),    //请求时间
            'version' => '1.0',     //接口调用版本
            'biz_content' => json_encode($common_param),        //请求参数集合
            'return_url' => '/alipay/yonghu?order_on='.$order['order_on'],
            'notify_url' => 'http://api.test.alipay.net/atinterface/receive_notify.htm'
        ];
        // var_dump($pub_param['biz_content']);die;



        //排序
        $params = array_merge($common_param,$pub_param);
        // var_dump($params);echo "<hr>";
        ksort($params);  //筛选
        // var_dump($params);echo "<hr>";

        $str = '';
        foreach($params as $k=>$v){
            $str .= $k .'=' . $v . '&';
        }
        $str = rtrim($str,'&');
        // echo "带签名字符串:".$str;echo "<hr>";
        $request_url = $url.'?'.$str;

        $keys = file_get_contents(storage_path('keys/priv_ali.key'));
        $res = openssl_get_privatekey($keys);
        openssl_sign($str,$sign,$res,OPENSSL_ALGO_SHA256);
        $sign = base64_encode($sign);
        $request_url2 = $request_url.'&sign='.urlencode($sign);
        // echo $request_url2;die;
        header('Location:'.$request_url2);

    }

    public function yonghu(){
       $order_on=request()->get('order_on');
       OrderModel::where(['order_on'=>$order_on])->update(['status'=>1]);
       return view('order.yonghu',['order_on'=>$order_on]);

    }
}
