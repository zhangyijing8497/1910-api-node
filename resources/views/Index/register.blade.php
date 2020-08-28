@extends('layouts.app')
@section('title', '前台')
@section('content')
    <!-- register -->
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>注册</h3>
            </div>
            <div class="register">
                <div class="row">
                    <form action="{{url('/register')}}" method="post">
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="账号" required name="user_autner">
                        </div>
                        <div class="input-field">
                            <input type="email" placeholder="邮箱" class="validate" required name="user_email">
                        </div>
                        <button class="btn button-default verify">获取验证码</button>
                        <div class="input-field">
                            <input type="password" placeholder="输入验证码" class="validate" required name="verify_code">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="密码" class="validate" required name="user_passwd">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="确认密码" class="validate" required name="user_passwd1">
                        </div>
                        <button class="btn button-default " type="submit">注册</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end register -->
    <script type="text/javascript">
        $(function(){

            //点击获取验证码
            $(".verify").click(function(){
                //获取上一个兄弟节点中input的邮箱
                var email = $(this).prev().children('input').val();
                var user = $('.validate').val();

                $.ajax({
                    url:"{{url('/verify_code')}}",
                    type:'POST',
                    data:{'email':email,'user':user},
                    dataType:"json",
                    success:function(result){
                        if(result.code=='2'){
                            alert(result.msg);
                        }else{
                            disabledButton();
                        }
                    }
                });
                // disabledButton();
            });

            //按钮禁用60秒防刷邮箱验证码
            function disabledButton(){
                $(".verify").attr({"disabled":"disabled"});     //控制按钮为禁用
                var second = 60;
                var intervalObj = setInterval(function () {
                    $(".verify").text("重新操作" + "(" + second + ")");
                    if(second == 0){
                        $(".verify").text("获取验证码");
                        $(".verify").removeAttr("disabled");//将按钮可用
                        /* 清除已设置的setInterval对象 */
                        clearInterval(intervalObj);
                    }
                    second--;
            }, 1000 );
}





        });
    </script>
@endsection
