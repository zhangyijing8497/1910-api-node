<?php

    $host = '127.0.0.1';
    $sk = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

    socket_bind($sk,'127.0.0.1',23456);

    socket_listen($sk);

    $res = socket_accept($sk);

    while(true)
    {
       echo 'listen ';echo "\n";
       echo "收到数据 : ".  socket_read($res,5);echo "\n";
    }

socket_close($sk);
