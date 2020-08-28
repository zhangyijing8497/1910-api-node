<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\GoodsModel;


class ApiController extends Controller
{
    public function index()
    {
        $list = GoodsModel::select("goods_id","goods_name","goods_img","shop_price",)->orderBy("goods_id","desc")->limit(9)->get();
        $response = [
            'errno' => 0,
            'msg'   => 'ok',
            'data'  => [
                'list'  => $list
            ]
        ];
        return $response;
    }
}
