<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\Index\GoodsModel;
use App\Model\Index\CartModel;
class CartController extends Controller
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
//        dd($cart_goods);
        //获取商品个数
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
//        print_r($goods);die;
        $total=0;
        $goods_ids=[];
        foreach ($goods as $key => $value) {
            //总价
            $total += $goods[$key]['shop_price'] * $value['num'];
//            goods_id
            $goods_id[] = $goods[$key]['id'].',';

        }

        $goods_ids=implode($goods_id);
        $goods_ids=trim($goods_ids);
        $goods_ids = substr($goods_ids,0,strlen($goods_ids)-1);


//     echo '<pre>';print_r($goods);echo '</pre>';die;
        $user_id=session('user.user_id');
        $data = [
            'goods' => $goods,
            'total'=> $total,
            'goods_ids' => $goods_ids,
            'user_id' => $user_id
        ];
//
        return  view('Index.cart',$data);
    }

    public function  addcart(Request $request)
    {
        $goods_id = intval($request->get('id'));        //商品ID
        $num = intval($request->get('num',1));  //购买商品个数

        //判断是否有此商品
        $g = GoodsModel::find($goods_id);
        if($g == NULL)      //商品不存在
        {
            return [
                'errno' => 40004,
                'msg'   => '商品不存在'
            ];
        }

        // TODO 判断商品是否下架 已删除


        $uuid = $_COOKIE['uuid'];           //获取客户端标识
        $redis_cart_ss1 = 'ss:cart:goods:'.$uuid;     //商品
        $redis_cart_ss2 = 'ss:cart:goods_num:'.$uuid;   //商品个数

        //获取商品信息
        if(Redis::zScore($redis_cart_ss1,$goods_id) == false){
            //echo "第一次添加到购物车";echo '</br>';
            Redis::zAdd($redis_cart_ss1,$this->now,$goods_id);
        }
        $num = Redis::zIncrBy($redis_cart_ss2,$num,$goods_id);    //增加购物车商品数量
        $response = [
            'errno' => 0,
            'msg'   => 'ok'
        ];

        return $response;
    }

    public function goodsInfo($good_id){
        return  GoodsModel::find($good_id)->toArray();
    }

     /**
     * 加入购物车 -- mysql
     */

    // public function addcart(Request $request)
    // {
    //     $user_id=session('user')['user_id'];
    //     // print_r($user_id);die;
    //     $good_id = $request->input('good_id');
    //     $num = $request->input('num');
    //     $goods_num = GoodsModel::where('goods_id',$good_id)->value('goods_number');
    //     $data = [
    //         'goods_id'=>$good_id,
    //         'uid'=>$user_id,
    //         'is_del'=>0
    //     ];
    //     if(!$user_id){
    //         return $data=['msg'=>'请先登录!','error'=>100001];
    //     }else{
    //         $cartInfo = CartModel::where($data)->first();
    //         if($cartInfo){
    //             // 检测库存
    //             $buy_num=$cartInfo['goods_count'] + $num;
    //             if($buy_num > $goods_num){
    //                 $buy_num = $goods_num;
    //                 CartModel::where($data)->update(['goods_count'=>$buy_num]);
    //                 return $data=['msg'=>'购买数量超过库存!','error'=>100002];
    //             }else if($buy_num < $goods_num){
    //                 // 累加
    //                 CartModel::where($data)->update(['goods_count'=>$buy_num]);
    //                 return $data=['msg'=>'加入购物车成功!','error'=>0];
    //             }
    //         }else{
    //             // 检测库存
    //             $buy_num=$cartInfo['goods_count'] + $num;
    //             if($buy_num > $goods_num){
    //                 $buy_num = $goods_num;
    //                 CartModel::where($data)->update(['goods_count'=>$buy_num]);
    //                 return $data=['msg'=>'购买数量超过库存!','error'=>100002];
    //             }else if($buy_num < $goods_num){
    //                 // 添加商品到购物车
    //                 $goodsInfo = [
    //                     'uid'   => $user_id,
    //                     'goods_id'  => $good_id,
    //                     'goods_count'   => $num
    //                 ];
    //                 $cartData = CartModel::insertGetId($goodsInfo);
    //                 return $data=['msg'=>'加入购物车成功!','error'=>0];
    //             }
    //         }
    //     }
    // }

}
