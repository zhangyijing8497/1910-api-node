<?php
$config=[
    'host'=>'192.168.41.220',
    'port'=>'3306',
    'dbname'=>'exam1910',
    'user'=>'root',
    'pass'=>'root'
];

$dbh=new PDO("mysql:host={$config['host']};dbname={$config['dbname']}",$config['user'],$config['pass']);

$name=$_POST['u_name'];
$password=$_POST['u_pwd'];
$passwords=$_POST['u_pwds'];
if($password != $passwords){
    echo "密码图确认密码不一致";
    header("refresh:2,url='/reg.html'");die;
}

$sql="INSERT INTO users (`user_name`,`password`) values ('{$name}','{$password}')";
$stmt=$dbh->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "注册成功";
    header("refresh:2,url='/login.html'");die;

