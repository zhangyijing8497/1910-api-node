<?php
    $config = [
        'host' => '120.27.245.195',
        'dbusername' => 'root',
        'dbpassword' => 'root',
        'dbname' => 'shop'
    ];

    $link = mysqli_connect($config['host'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

//    $sql = "select * from test where name='{$_POST['name']}' and pwd ='{$_POST['pwd']}'";
    $sql = "SELECT * FROM test WHERE name=? AND pwd=?";
    $stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($stmt, "ss", $_POST['name'],$_POST['pwd']);

    /* 执行查询 */
    $res = mysqli_stmt_execute($stmt);

    /* 将查询结果绑定到变量 */
    mysqli_stmt_bind_result($stmt, $district);

    /* 获取查询结果值 */
    ;
    var_dump(mysqli_stmt_fetch($stmt));die;
//    echo 111;
















?>
