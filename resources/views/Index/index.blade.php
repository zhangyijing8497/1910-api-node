@extends('layouts.app')
@section('title', '前台')
@section('content')
<!-- slider -->
<div class="slider">

    <ul class="slides">
        @foreach($is_slideshow as $v)
        <li>
            <img src="/storage/{{$v['goods_img']}}" width="2125px" height="300px" alt="">
            <div class="caption slider-content  center-align">
                <h2>WELCOME TO MSTORE</h2>
                <h2>欢迎来到本商店</h2>
                <!-- <h4>Lorem ipsum dolor sit amet.</h4> -->
                <a href="" class="btn button-default">SHOP NOW</a>
            </div>
        </li>
        @endforeach
    </ul>

</div>
<!-- end slider -->

<!-- features -->
<div class="features section">
    <div class="container">
        <div class="row">
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="/Free_shipping">
                    <h6>Free Shipping</h6>
                    <h6>免费送货</h6>
                    </a>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur</p> -->
                </div>
            </div>
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <a href="fast_refund">
                    <h6>Money Back</h6>
                    <h6>极速退款</h6></a>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur</p> -->
                </div>
            </div>
        </div>
        <div class="row margin-bottom-0">
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                    <a href="Secure_payment">
                    <h6>Secure Payment</h6>
                    <h6>安全支付</h6></a>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur</p> -->
                </div>
            </div>
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-support"></i>
                    </div>
                    <a href="/return">
                    <h6>7 Return</h6>
                    <h6>7天无理由退货</h6></a>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur</p> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end features -->

<!-- quote -->
<div class="section quote">
    <div class="container">
        <h4>FASHION UP TO 50% OFF(时尚高达五折)</h4>
        <!-- <h4></h4> -->
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ducimus illo hic iure eveniet</p>
        <p>爱让你坐着，奉献你的快乐。我的上帝保佑你平安</p>

    </div>
</div>
<!-- end quote -->

<!-- product_new -->
<div class="section product">
    <div class="container">
        <div class="section-head">
            <h5>NEW(新品)</h5>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
        </div>
        <div class="row margin-bottom">
            @foreach($is_now as $v)
            <div class="col s6 row margin-bottom">
                <div class="content">
                    <a href="{{url('/product_details/'.$v['goods_id'])}}">
                        <img src="/storage/{{$v['goods_img']}}" alt="">
                    </a>
                    <h6><a href="{{url('/product_details/'.$v['goods_id'])}}">{{$v['goods_name']}}</a></h6>
                    <div class="price">
                        ${{$v['shop_price']}}
                    </div>
{{--                    <a href="{{url('/cart/index')}}"><button class="btn button-default">加入购物车</button></a>--}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end product_new -->

<!-- promo -->
<div class="promo section">
    <div class="container">
        <div class="content">
            <h4>PRODUCT BUNDLE</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
            <button class="btn button-default">SHOP NOW</button>
        </div>
    </div>
</div>
<!-- end promo -->

<!-- product_hot -->
<div class="section product">
    <div class="container">
        <div class="section-head">
            <h5>HOT(热卖)</h5>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
        </div>

        <div class="row margin-bottom">
            @foreach($is_hot as $v)
            <div class="col s6 row margin-bottom">
                <div class="content">
                    <a href="{{url('/product_details/'.$v['goods_id'])}}">
                        <img src="/storage/{{$v['goods_img']}}" width="50px" height="50px" alt="">
                    </a>
                    <h6><a href="{{url('//product_details/'.$v['goods_id'])}}">{{$v['goods_name']}}</a></h6>
                    <div class="price">
                        ${{$v['shop_price']}}
                    </div>
{{--                    <a href="{{url('/cart/index')}}"><button class="btn button-default">加入购物车</button></a>--}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end product_hot -->
@endsection
