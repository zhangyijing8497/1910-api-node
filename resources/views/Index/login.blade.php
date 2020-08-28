@extends('layouts.app')
@section('title', '前台')
@section('content')
    <!-- login -->
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>登录</h3>
            </div>
            <div class="login">
                <div class="row">

                
                    <form class="col s12" method="post" action="{{url('/login')}}">
                        @csrf
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="账号" required name="user_autner">
                        </div>
                        <div class="input-field">
                            <input type="password" class="validate" placeholder="密码" required name="user_pwd">
                        </div>
{{--                        <h4><a href="">忘了密码</a>--}}
                        <a href="/back/pwd">找回密码</a><br></h4>
                        <input type="submit" class="btn button-default" value="登录">
                    </form>
                    <h6>其他方式登录 ↓</h6><br>

                    <a href="{{url('github')}}">
                            <img src="/timg.jfif" width="30px" height="30px" style="border-radius:50%;overflow:hidden;">
                    <a href="">
                        <img src="/1597299090(1).png" width="50px" height="35px" style="border-radius:50%;overflow:hidden;">
                    </a>
                    <a href="">
                        <img src="/1597299518(1).png" width="30px" height="30px" style="border-radius:50%;overflow:hidden;">
                    </a>
                    <a href="">
                        <img src="/1597299625(1).png" width="38px" height="38px" style="border-radius:50%;overflow:hidden;">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end login -->
@endsection
