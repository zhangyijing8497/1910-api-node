<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/Index/js/jquery.js"></script>
</head>
<body>
<form action="javascript:void(0)" method="post">
    <table>
        <tr>
            <td></td>
            <td>选择支付方式</td>
        </tr>
        <tr>
            <td><input type="radio" id="pagr" checked mode="2" name="www" way="1"></td>
            <td><img src="/zhifubao.png" width="100px" height="100px"  style="border-radius:50%;overflow:hidden;"></td>
        </tr>
        <tr>
            <td><input type="radio" id="pagr" mode="1"  name="www" way="1"></td>
            <td><img src="/weixin.png"  width="100px"  height="100px"  style="border-radius:50%;overflow:hidden;"></td>
        </tr>
        <tr>
            <td></td>
            <td><button class="submit"  goods_ids="{{$goods_ids}}">提交</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>

<script>
    $(function(){
        $(document).on('click','.submit',function (){
            var _this=$(this);
            var goods_ids=_this.attr('goods_ids');
            $.ajax({
                url:"/order/orderSubmit",
                data:{'goods_ids':goods_ids},
                dataType:'json',
                type:'post',
                success:function (res){
                    if(res.error_no==0){
                        alert(res.error_msg);
                        location.href="/alipa/yalipay?order_id="+res.order_id;
                         // header("refresh:2;url=/alipay?total=".$total);

                    }else{
                        alert(res.error_msg);
                    }
                }
            });



        });
    })
</script>
