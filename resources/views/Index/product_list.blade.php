@extends('layouts.app')
@section('title', '商品展示')
@section('content')
    <!-- product_list -->
    <div class="section product product-list">
        <div class="container">
            <div class="pages-head">
                <h3>商品展示</h3>
            </div>
            <div class="input">
                <form action="{{url('/product_list')}}" method="get">
                    <input type="text" name="s" value="{{@$_GET['s']}}" placeholder="搜索/商品/商品关键字">
                </form>
            </div>
            <div class="row">
                @foreach($data as $v)

                    <div class="col s6">
                        <div class="content">
                            <img src="/storage/{{$v['goods_img']}}" alt="">
                            <h6><a href="">{{$v['goods_name']}}</a></h6>
                            <div class="price">
                                {{$v['shop_price']}} <span>$28</span>
                            </div>
                            <a href="{{url('/index/addcart/'.$v['goods_id'])}}"><button type="button" class="btn button-default">加入购物车</button></a>
                        </div>
                        <div class="row"></div>
                    </div>
                @endforeach

            </div>


            {{ @$data->appends(['s'=>$_GET['s']])->links() }}

        </div>
    </div>
    <!-- end product_list -->
@endsection
