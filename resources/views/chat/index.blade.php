<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>聊天室</title>
</head>
<body>
    <center>
        <h3>WebSocket聊天室</h3>
        <textarea id="rev_cont" cols="100" rows="20" style=" border-radius:10px;"></textarea><br><br>
        <!-- <div id="rev_cont">
        
        </div> -->
        <input type="text" id="msg" style="border-radius:10px;width:500px;height:40px">
        <input type="submit" id="btn" style="width:100px;height:40px;background:#fff;color:redll" value="发送">

        <script src="/Index/js/jquery.min.js"></script>
        <script src="/Index/js/js.cookie-2.2.1.min.js"></script>
        <script>
            var url = 'ws://ws.1910.com';       //websocket 服务器地址
            var ws = new WebSocket(url);
            var user_name = Cookies.get('u');
            console.log(user_name);

            ws.onopen = function(){
                //点击发送
                $("#btn").on('click',function(){
                    ws.send($("#msg").val());
                });
            }
            //接收服务器响应
            ws.onmessage = function(d){
                // console.log(d.data);
                $("#rev_cont").append("[" + user_name + "]: "  +d.data + "\n")
                // $("#rev_cont").append("<p>" + "[" + user_name + "]: "  + d.data + "</p>")
                $("#msg").val("");
            }
        </script>

    </center>
</body>
</html>