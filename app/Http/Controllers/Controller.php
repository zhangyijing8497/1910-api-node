<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redis;
use App\Model\Index\GoodsModel;

class Controller extends BaseController
{
    public $now;
    public function __construct()
    {
        $this->now = time();

    }
    public function cartList()
    {
        $redis_cart_ss1 = 'ss:cart:goods:'.$_COOKIE['uuid'];         //商品
        $redis_cart_ss2 = 'ss:cart:goods_num:'.$_COOKIE['uuid'];     //商品个数

        $cart_goods = Redis::zrevRange($redis_cart_ss1,0,-1,true);      //按添加购物车顺序显示商品

        if(empty($cart_goods))      //空购物车
        {
            return view('Index.empty');
        }
        foreach($cart_goods as $k=>$v)
        {
            $g[$k]['id'] = $k;
            $g[$k]['num'] = Redis::zScore($redis_cart_ss2,$k);
//            var_dump($g);
            //获取商品信息
            $g_info = GoodsModel::detail($k);
//            dd($g_info);
            $goods[] = array_merge($g[$k],$g_info);
        }
//
        return $goods;
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
