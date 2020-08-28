<?php

    $sk = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    socket_connect($sk, '127.0.0.1', 23456);

    while( true )
    {
        echo "请输入： ";
        $data=fread(STDIN,10);
        echo "用户输入: ". $data;echo "\n";
        socket_write($sk, $data);
    }
