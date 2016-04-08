<html lang="zh">
<?php
include "head.php";
?>
<?php
session_start(); //启用session
if($_SESSION['duser']){ // 检查用户是否登陆
}
else{
    header("location: index.php"); // 如果用户未登录则调用主页
}
$user = $_SESSION['duser']; //读取用户
echo "你已经登录：".$user;
?>