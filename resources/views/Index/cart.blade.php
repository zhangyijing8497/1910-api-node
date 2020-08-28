@extends('layouts.app')
@section('title', '前台')
@section('content')
    <!-- cart -->
    <div class="cart section">
        <div class="container">
            <div class="pages-head">
                <h3>CART</h3>
            </div>
            <div class="content">
            @foreach($goods as $k=>$v)
                <div class="cart-1">
                    <div class="row">
                        <div class="col s5">
                            <h5><input type="checkbox">图片</h5>
                        </div>
                        <div class="col s7">
                            <img src="/storage/{{$v['goods_img']}}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>名称</h5>
                        </div>
                        <div class="col s7">
                            <h5><a href="">{{$v['goods_name']}}</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>数量</h5>
                        </div>
                        <div class="col s7">
                            <input value="{{$v['num']}}" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>价钱</h5>
                        </div>
                        <div class="col s7">
                            <h5>$<span id="price">{{$v['shop_price']}}</span></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>操作</h5>
                        </div>
                        <div class="col s7">
                            <h5><i class="fa fa-trash"></i></h5>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
            @endforeach
            </div>
            <div class="total">


                <div class="row">
                    <div class="col s7">
                        <h6>总价</h6>
                    </div>
                    <div class="col s5">
                        <h6>￥<span id="total">{{$total}}</span></h6>
                    </div>
                </div>
            </div>
            <button class="btn button-default" user_id="{{$user_id}}" goods_ids="{{$goods_ids}}">提交订单</button>
        </div>
    </div>
    <!-- end cart -->
    <script scr="/Index/js/jquery.min.js"></script>
    <script>
        $(function(){
            $(document).on('click','.button-default',function (){
                var _this=$(this);
                var total=parseInt($('#total').text());
                var goods_ids=_this.attr('goods_ids');
                var user_id=_this.attr('user_id');
                if(user_id==""){
                    alert('请登录');
                    location.href="/login";
                    return false;
                }
                    location.href="/order/queren?goods_id="+goods_ids;
            });
        })
    </script>

@endsection
