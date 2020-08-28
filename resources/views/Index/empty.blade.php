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
                <h3>您的购物车是空的,赶快去添加商品吧!</h3>
            </div>
            <div class="total">


                <div class="row">
                    <div class="col s7">
                        <h6>Total</h6>
                    </div>
                    <div class="col s5">
                        <h6>$0</h6>
                    </div>
                </div>
            </div>
            <button class="btn button-default">Process to Checkout</button>
        </div>
    </div>
    <!-- end cart -->
@endsection
