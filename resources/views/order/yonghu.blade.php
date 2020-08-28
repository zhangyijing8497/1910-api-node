@extends('layouts.app')
@section('title', '前台')
@section('content')
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h1><a href="/">回首页</a></h1>
            </div>
            <div class="register">
                <div class="row">
                    <form class="col s12" action="/back/pwds" method="post">
                        <div class="input-field">
                            <h3 align="center">您的订单号为：{{$order_on}}</h3>
                        </div>
                        <p></p>
                        <div class="input-field">
                            <h3 align="center">祝您本次购物愉快</h3>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
